<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\brand;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        $brands = brand::latest();

        if(!empty($request->get('keyword'))){
            $brands->where('brand_name', 'like','%'.$request->get('keyword').'%');
        }

        $brands = $brands->paginate(10);

        return view('admin.brand.brand', compact('brands'));

    }//end method

    public function create()
    {
        return view('admin.brand.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'brand_name' => 'required',
            'slug'       => 'required|unique:brands',
        ]);

        if($validator->passes()){
            $brand = new Brand();
            $brand->brand_name = $request->brand_name;
            $brand->slug = $request->slug;
            $brand->status = $request->status;
            $brand->save();

            Session::flash('success', 'Brand created successfully');
            return response()->json(['status' => true, 'message' => 'Brand created successfully']);
    

        }else{
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
    
        }
    }

    public function edit($id)
    {
        $brands = brand::find($id);

        if (!$brands) {
            Session::flash('error', 'Record not found');
            return redirect()->route('brand.index');
        }

        return view('admin.brand.edit', compact('brands'));
    }

    public function update($id, Request $request)
    {
        $brand = brand::find($id);
        if (!$brand) {
            Session::flash('error', 'Brand not found');
            return response()->json(['status' => true, 'notFound' => true, 'message' => 'Brand not found']);
        }

        $validator = Validator::make($request->all(),[
            'brand_name' => 'required',
            'slug'          => 'required|unique:brands,slug,'.$brand->id.',id',
            'status'        => 'required'
        ]);

        if($validator->passes())
        {
            $brand->brand_name = $request->brand_name;
            $brand->slug = $request->slug;
            $brand->status = $request->status;
            $brand->save();

            Session::flash('success','Brand updated successfully');
            return response()->json([
                'status' => true,
                'message' => 'Brand updated successfully'
            ]);

        }else
        {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }//end method

    public function destory($id)
   {
        $brand = brand::find($id);

        if(empty($brand))
        {   
            Session::flash('error', 'Oops! Brand not found');
            return response()->json(['status' => false, 'notFound' => true]);
        }

        $brand->delete();
        Session::flash('success', 'Brand deleted successfully');
        return response()->json(['status' => true, 'message' => 'Brand deleted successfully']);

   }//end method;

}
