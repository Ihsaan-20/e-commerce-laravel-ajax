<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\subCategory;
use Illuminate\Http\Request;

class ProductSubCategoryController extends Controller
{
    public function index(Request $request){

        if(!empty($request->category_id))
        {
            $subCategories = subCategory::where('category_id',$request->category_id)
                            ->orderBy('sub_cate_name')->get();
                            
            return response()->json([
                'status' => true,
                'subCategories' => $subCategories
            ]);

        }else{
            return response()->json([
                'status' => true,
                'subCategories' => []
            ]);
        }
    
    
    }//end method;
}
