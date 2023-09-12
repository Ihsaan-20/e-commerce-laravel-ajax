<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Models\{Category, TempImage};

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
   public function index(Request $request)
   {
        $category = Category::latest();
        if(!empty($request->get('keyword'))){
            $category->where('category_name', 'like','%'.$request->get('keyword').'%');
        }
        $category = $category->paginate(10);
        return view('admin.category.category', compact('category'));
   }//end method;

   public function create()
   {
        return view('admin.category.create');
   }//end method;

   public function store(Request $request)
   {
    $validator = Validator::make($request->all(),[
        'category_name' => 'required',
        'slug' => 'required|unique:categories'
    ]);
    if($validator->passes()){

        $cate = new Category();
        $cate->category_name = $request->category_name;
        $cate->slug = $request->slug;
        $cate->status = $request->status;
        $cate->show = $request->show;
        $cate->save();

        // Save image;
        if( !empty($request->image_id)){
            $tempImage = TempImage::find($request->image_id);
            $extArray = explode('.',$tempImage->name);
            $ext = last($extArray);

            $newImageName = $cate->id.'.'.$ext;
            $sourcePath = public_path().'/temp/'.$tempImage->name;
            $destinationPath = public_path().'/uploads/category/'.$newImageName;
            File::copy($sourcePath,$destinationPath);

            // Generate image thumbnail
            $d_path = public_path().'/uploads/category/thumb/'.$newImageName;
            $img = Image::make($sourcePath);
            // $img->resize(300, 200);
            $img->fit(450, 600, function ($constraint) {
                $constraint->upsize();
            });
            $img->save($d_path);


            $cate->image = $newImageName;
            $cate->save();
        }

        Session::flash('success', 'Category added successfully');

        return response()->json(['status' => true, 'message' => 'Category added successfully']);

    }else{
        return response()->json([
            'status' => false,
            'errors' => $validator->errors()
        ]);

    }
   }//end method;

   public function edit($id, Request $request)
   {
        $category = Category::find($id);
        if(empty($category))
        {
            return redirect()->route('admin.category.index');
        }
        return view('admin.category.edit', compact('category'));

   }//end method;

   public function update($id, Request $request)
   {
        $cate = Category::find($id);

        if(empty($cate))
        {
            Session::flash('error', 'Category not found');
            return response()->json(['status' => true, 'notFound' => true, 'message' => 'Category not found']);
        }

        $validator = Validator::make($request->all(),[
            'category_name' => 'required',
            'slug' => 'required|unique:categories,slug,'.$cate->id.',id'
        ]); 

        if($validator->passes())
        {
            $cate->category_name = $request->category_name;
            $cate->slug = $request->slug;
            $cate->status = $request->status;
            $cate->show = $request->show;
            $cate->save();
            
            $oldImage = $cate->image;

            // Save image;
            if( !empty($request->image_id))
            {
                $tempImage = TempImage::find($request->image_id);
                $extArray = explode('.',$tempImage->name);
                $ext = last($extArray);
    
                $newImageName = $cate->id.'-'.time().'.'.$ext;
                $sourcePath = public_path().'/temp/'.$tempImage->name;
                $destinationPath = public_path().'/uploads/category/'.$newImageName;
                File::copy($sourcePath,$destinationPath);
    
                // Generate image thumbnail
                $d_path = public_path().'/uploads/category/thumb/'.$newImageName;
                $img = Image::make($sourcePath);
                // $img->resize(300, 200);
                $img->fit(450, 600, function ($constraint) {
                    $constraint->upsize();
                });
                $img->save($d_path);
    
                $cate->image = $newImageName;
                $cate->save();

                // delete old image;
                File::delete(public_path().'/uploads/category/thumb/'.$oldImage);
                File::delete(public_path().'/uploads/category/'.$oldImage);
            }
    
            Session::flash('success', 'Category updated successfully');
    
            return response()->json(['status' => true, 'message' => 'Category updated successfully']);
    
        }else{
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
    
        }


   }//end method;

   public function destory($id, Request $request)
   {
        $category = Category::find($id);

        if(empty($category))
        {   
            Session::flash('error', 'Oops! category not found');
            return response()->json(['status' => false, 'notFound' => true]);

        }

        // delete image;
        File::delete(public_path().'/uploads/category/thumb/'.$category->image);
        File::delete(public_path().'/uploads/category/'.$category->image);

        $category->delete();
        Session::flash('success', 'Category deleted successfully');
        return response()->json(['status' => true, 'message' => 'Category deleted successfully']);

   }//end method;



}
