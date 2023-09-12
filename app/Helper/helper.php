<?php

use App\Models\Category;

function get_categories(){
//    return  Category::orderBy('category_name', 'ASC')
//             ->with('getSubCategory')
//             ->where('categories.status','active')
//             ->where('categories.show','yes')
//             // ->where('getSubCategory.status','active')
//             // ->where('getSubCategory.show','yes')
//             ->get();
    return Category::orderBy('category_name', 'ASC')->latest()
                    ->with(['getSubCategory' => function ($query){
                        $query->where('status', 'active')->where('show', 'yes')->latest();
                    }])
                    ->where('categories.status', 'active')
                    ->where('categories.show', 'yes')
                    ->get();

}

?>