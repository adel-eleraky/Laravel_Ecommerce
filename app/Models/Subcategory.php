<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;


    protected $fillable = [
        'name' , 'details' , 'image' , 'slug' , 'category_id'
    ];


    public static function  rules( $id = 0)
    {
        return [
            'name' => "required|min:3|max:255|unique:subcategories,name,$id",
            'details' => "required|min:5|max:1000",
            'image' => "nullable|mimetypes:image/png,image/jpg,image/jpeg|max:1048576",
            'category_id' => 'required|numeric|exists:categories,id',
        ];
    }
}