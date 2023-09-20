<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\subCategory;
use App\Models\TempImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;




class ProductController extends Controller
{
    public function oky(){
        return "working";
    }
    public function index(Request $request){
        // return "working"; exit();
        // get products table data with relation product images table [ hasMany relationship ];
        $products = Product::latest()->with('product_images');

        // this is search box query, to search data with product title;
        if(!empty($request->get('keyword'))){
            $products->where('products.title', 'like','%'.$request->get('keyword').'%');
        }

        //this is for pagination;
        $products = $products->paginate(10);

        return view('admin.product.product', compact('products'));
    }//end method;

   public function create()
   {
    $categories = Category::orderBy('category_name','ASC')->get();
    $brands = Brand::orderBy('brand_name','ASC')->get();
    return view('admin.product.create', compact('brands', 'categories'));
   }//end method;

   public function store(Request $request){
    // dd($request->image_array);

    $rules = [
        'title'         => 'required',
        'description'   =>  'required',
        'slug'          => 'required|unique:products',
        'price'         => 'required|numeric',
        'sku'           => 'required|unique:products',
        'track_qty'     => 'required|in:yes,no',
        'category'      => 'required|numeric',
        'is_featured'   => 'required|in:yes,no',
    ];

    if(!empty($request->track_qty) && $request->track_qty == 'yes'){
        $rules['qty'] = 'required|numeric';
    }
    
    $validator = Validator::make($request->all(), $rules);
    if($validator->passes()){
        $product = new Product();
        $product->category_id = $request->category;
        $product->sub_category_id = $request->sub_category;
        $product->brand_id = $request->brand;
        $product->title  = $request->title ;
        $product->slug = $request->slug;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->compare_price = $request->compare_price;
        $product->is_featured = $request->is_featured;
        $product->sku = $request->sku;
        $product->barcode = $request->barcode;
        $product->track_qty = $request->track_qty;
        $product->qty = $request->qty;
        $product->status = $request->status;
        $product->short_description = $request->short_description;
        $product->shipping_return = $request->shipping_return;
        $product->save();

        // Save Gallary pics;
        if (!empty($request->image_array)){

            foreach($request->image_array as $temp_image_id){

               $tempImageInfo = TempImage::find($temp_image_id);
               $extArray = explode('.',$tempImageInfo->name);
               $ext = last($extArray);

               $productImage = new ProductImage();
               $productImage->product_id = $product->id;
               $productImage->image = 'NULL';
               $productImage->save();

               $imageName = $product->id.'-'.$productImage->id.'-'.time().'.'.$ext;
               $productImage->image = $imageName;
               $productImage->save();

                //Generate Product Thumbnails;
                //large image 1400x;
                $sourcePath = public_path().'/temp/'.$tempImageInfo->name;
                $destPath = public_path().'/uploads/product/large/'.$imageName;
                $image = Image::make($sourcePath);
                $image->resize(1400, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $image->save($destPath);
                // small image 300x;
                $destPath = public_path().'/uploads/product/small/'.$imageName;
                $image = Image::make($sourcePath);
                $image->fit(300, 300);
                $image->save($destPath);               
               
            }//foreach end

        }// if end

        Session::flash('success', 'Product added successfully');
        return response()->json(['status' => true, 'message' => 'Product added successfully']);
    }else{
        return response()->json([
            'status' => false,
            'errors' => $validator->errors()
        ]);
    }

   }//end methods;


   public function edit($id, Request $request){
    // get data from product table through id;
    $products = Product::find($id);

        // Check if the product exists
        if (!$products) {
            // Handle the case where the product does not exist, e.g., redirect or show an error message.
            // You can return a view or redirect to an error page.
            Session::flash('error','Product not found');
            return redirect()->route('product.index')->with('error', 'Product not found');
        }

        // get products image from ProductImages table; 
        $productImages = ProductImage::where('product_id',$products->id)->get();
        // get data from subcategories table through product id;
        $subcategories = subCategory::where('category_id',$products->category_id)->get();
        // get data from categories table;
        $categories = Category::orderBy('category_name','ASC')->get();

        // get data from brands table
        $brands = Brand::orderBy('brand_name','ASC')->get();

        return view('admin.product.edit', compact('categories', 'brands','products','subcategories','productImages'));
    }


   public function update($id, Request $request){

        $product = Product::find($id);

        $rules = [
            'title'         => 'required',
            'slug'          => 'required|unique:products,slug,'.$product->id.',id',
            'price'         => 'required|numeric',
            'sku'           => 'required|unique:products,sku,'.$product->id.',id',
            'track_qty'     => 'required|in:yes,no',
            'category'      => 'required|numeric',
            'is_featured'   => 'required|in:yes,no',
        ];

        if(!empty($request->track_qty) && $request->track_qty == 'yes'){
            $rules['qty'] = 'required|numeric';
        }
        
        $validator = Validator::make($request->all(), $rules);
        if($validator->passes()){

            $product->category_id = $request->category;
            $product->sub_category_id = $request->sub_category;
            $product->brand_id = $request->brand;
            $product->title  = $request->title ;
            $product->slug = $request->slug;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->compare_price = $request->compare_price;
            $product->is_featured = $request->is_featured;
            $product->sku = $request->sku;
            $product->barcode = $request->barcode;
            $product->track_qty = $request->track_qty;
            $product->qty = $request->qty;
            $product->status = $request->status;
            $product->short_description = $request->short_description;
            $product->shipping_return = $request->shipping_return;
            $product->save();

            Session::flash('success', 'Product updated successfully');
            return response()->json(['status' => true, 'message' => 'Product updated successfully']);
        }else{
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

   }//end method;

   public function destory($id){
    
        $product = Product::find($id);

        if(empty($product)){
            Session::flash('error', 'Product not found');
            return response()->json([
                'status'    => false,
                'notFound'  => true
            ]);
        }

        $productImages = ProductImage::where('product_id', $id)->get();

        if (!empty($productImages)){
            foreach($productImages as $productImage){
                File::delete(public_path('uploads/product/large/'.$productImage->image));
                File::delete(public_path('uploads/product/small/'.$productImage->image));
            }

            ProductImage::where('product_id', $id)->delete();
        }
        $product->delete();

        Session::flash('success', 'Product deleted successfully');
            return response()->json([
                'status'    => true,
                'message'  => 'Product deleted successfully'
            ]);

   }//end method;

}
