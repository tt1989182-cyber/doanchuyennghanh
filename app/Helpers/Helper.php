<?php

namespace App\Helpers;

use App\Models\Category;

class Helper
{
    public static function getAllCategory()
    {
        return Category::where('status', 'active')->get();
    }
}
