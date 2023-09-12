<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\subCategory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;



class subCategoryController extends Controller
{
    public function index(Request $request)
    {
        $subCategories = subCategory::select('sub_categories.*', 'categories.category_name AS category_name')
                                        ->latest('sub_categories.id')
                                        ->leftJoin('categories', 'categories.id', '=', 'sub_categories.category_id');

        if(!empty($request->get('keyword'))){
            $subCategories->where('sub_categories.sub_cate_name', 'like','%'.$request->get('keyword').'%');
            $subCategories->orWhere('categories.category_name', 'like','%'.$request->get('keyword').'%');
        }

        $subCategories = $subCategories->paginate(10);

        return view('admin.sub-category.sub_category', compact('subCategories'));

    }//end method

    public function create(){
        $category = Category::orderBy('category_name', 'ASC')->get();
        return view('admin.sub-category.create', compact('category'));
    }//end method

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'sub_cate_name' => 'required',
            'slug'          => 'required|unique:sub_categories',
            'category'      => 'required',
            'status'        => 'required'
        ]);

        if($validator->passes())
        {
            $subCategory = new subCategory();
            $subCategory->sub_cate_name = $request->sub_cate_name;
            $subCategory->slug = $request->slug;
            $subCategory->category_id = $request->category;
            $subCategory->status = $request->status;
            $subCategory->show = $request->show;
            $subCategory->save();

            Session::flash('success','Subcategory created successfully');
            return response()->json([
                'status' => true,
                'message' => 'Subcategory created successfully'
            ]);

        }else
        {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
       
    }//end method

    public function edit($id, Request $request)
    {
        $subCategory = subCategory::find($id);

        if (!$subCategory) {
            Session::flash('error', 'Record not found');
            return redirect()->route('sub-category.index');
        }

        $categories = Category::orderBy('category_name', 'ASC')->get();

        return view('admin.sub-category.edit', compact('subCategory', 'categories'));
    
    }


    public function update($id, Request $request)
    {
        $subCategory = subCategory::find($id);
        if (!$subCategory) {
            Session::flash('error', 'Record not found');
            return response()->json(['status' => true, 'notFound' => true, 'message' => 'Sub category not found']);
        }

        $validator = Validator::make($request->all(),[
            'sub_cate_name' => 'required',
            'slug'          => 'required|unique:sub_categories,slug,'.$subCategory->id.',id',
            'category'      => 'required',
            'status'        => 'required'
        ]);

        if($validator->passes())
        {
            $subCategory->sub_cate_name = $request->sub_cate_name;
            $subCategory->slug = $request->slug;
            $subCategory->category_id = $request->category;
            $subCategory->status = $request->status;
            $subCategory->show = $request->show;
            $subCategory->save();

            Session::flash('success','Sub category updated successfully');
            return response()->json([
                'status' => true,
                'message' => 'Sub category updated successfully'
            ]);

        }else
        {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }//end method

    public function destory($id, Request $request)
   {
        $subCategory = subCategory::find($id);

        if(empty($subCategory))
        {   
            Session::flash('error', 'Oops! sub category not found');
            return response()->json(['status' => false, 'notFound' => true]);
        }

        $subCategory->delete();
        Session::flash('success', 'Sub category deleted successfully');
        return response()->json(['status' => true, 'message' => 'Sub category deleted successfully']);

   }//end method;




    

    
}
