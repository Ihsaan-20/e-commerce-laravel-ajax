<?php

namespace App\Http\Controllers;

use App\Models\brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\subCategory;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request, $categorySlug = null, $subCategorySlug = null)
        {
            // dd($categorySlug, $subCategorySlug);

            $categorySelected = '';
            $subCategorySelected = '';
            $brandsArray = [];

            

            // fetch categories with subcategories from the database
            $categories = Category::orderBy('category_name', 'ASC')
                ->latest()
                ->with(['getSubCategory' => function ($query) {
                    $query->where('status', 'active')->where('show', 'yes')->latest();
                }])
                ->where('categories.status', 'active')
                ->where('categories.show', 'yes')
                ->get();

            // fetch brands from the database
            $brands = Brand::orderBy('brand_name','ASC')->where('status','active')->get();

            // fetch products with product images from the database
            $products = Product::where('status','active');

            // Apply filter for categories if categorySlug is provided
            if (!is_null($categorySlug)) {
                $category = Category::where('slug', $categorySlug)->first();
        
                // Check if $category is not null
                if ($category) {
                    $products = $products->where('category_id', $category->id);
                    $categorySelected = $category->id;
                }
            }

            // Apply filter for subcategories if subCategorySlug is provided
            if (!is_null($subCategorySlug)) {
                $subcategory = subCategory::where('slug', $subCategorySlug)->first();
        
                // Check if $subcategory is not null
                if ($subcategory) {
                    $products = $products->where('sub_category_id', $subcategory->id);
                    $subCategorySelected = $subcategory->id;
                }
            }

            // Apply filter on checkbox;
            if(!empty($request->get('brand'))){
                $brandsArray = explode(',', $request->get('brand'));
                $products = $products->whereIn('brand_id', $brandsArray);
            }

            // Apply filders on price range with ion-ranger-slider;
            if ($request->get('price_max') != '' && $request->get('price_min') != ''){
                if($request->get('price_max') == 1000 ){
                    $products = $products->whereBetween('price', [intval($request->get('price_min')),1000000]);
                }else{
                    $products = $products->whereBetween('price', [intval($request->get('price_min')), intval($request->get('price_max'))]);
                }
            }
            
            $priceMax = (intval($request->get('price_max')) == 0 ) ? 1000 : $request->get('price_max');
            $priceMin = intval($request->get('price_min'));
            
            // sort by filter
            // if ($request->get('sort') != ''){
            //     if ($request->get('sort') == 'latest'){
            //         $products = $products->orderBy('id', 'DESC');
            //     }else if($request->get('sort') == 'price_asc'){
            //         $products = $products->orderBy('price', 'ASC');
            //     }else{
            //         $products = $products->orderBy('price', 'DESC');
            //     }
            // }else{
            //     $products = $products->orderBy('id', 'DESC');
            // }
            
            $sort = $request->get('sort');

            switch ($sort) {
                case 'latest':
                    $products = $products->orderBy('id', 'DESC');
                    break;
                case 'price_asc':
                    $products = $products->orderBy('price', 'ASC'); // Change 'id' to the actual column for price
                    break;
                default:
                    $products = $products->orderBy('price', 'DESC');
                    break;
            }


            $products = $products->orderBy('id','DESC');
            $products = $products->paginate(6);

            return view('front.shop', compact('categories', 'brands', 'products','categorySelected','subCategorySelected','brandsArray','priceMax','priceMin','sort'));

        }//end index method;

    public function productslug($slug){
            // dd($slug);
            $products = Product::where('slug', $slug)->with('product_images')->first();
            if($products == NULL){
                abort(404);
            }

            return view('front.product', compact('products'));

    }//end method;

}
