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
                $products = $products->where('category_id',$category->id);
                $categorySelected = $category->id;
            }

            // Apply filter for subcategories if subCategorySlug is provided
            if (!is_null($subCategorySlug)) {
                $subcategory = subCategory::where('slug', $subCategorySlug)->first();
                $products = $products->where('sub_category_id',$subcategory->id);
                $subCategorySelected = $subcategory->id;
            }

            if(!empty($request->get('brand'))){
                $brandsArray = explode(',', $request->get('brand'));
            }
            
            $products = $products->orderBy('id','DESC')->get();
            // $products = $products;

            return view('front.shop', compact('categories', 'brands', 'products','categorySelected','subCategorySelected','brandsArray'));

        }//end index method;

}
