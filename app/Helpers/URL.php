<?php

namespace App\Helpers;
use Illuminate\Support\Str;

class URL{
    public static function linkCategory($categoryID, $categoryName){
        return route('category/index', ['category_id' => $categoryID, 'category_name' => Str::slug($categoryName)]);
    }

    public static function linkArticle($articleID, $articleName){
        return route('article/index', ['article_id' => $articleID, 'article_name' => Str::slug($articleName)]);
    }

}
