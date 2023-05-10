<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name' , 'slug' , 'quantity' , 'image' , 'details' , 'subcategory_id'
    ];

    public static function rules($id = 0){

        return [
            'name' => "required|min:3|max:255|unique:products,name,$id",
            'details' => "required|min:5|max:1000",
            'quantity' => 'required|numeric|max:255',
            'image' => "nullable|mimetypes:image/png,image/jpg,image/jpeg|max:1048576",
            'subcategory_id' => 'required|numeric|exists:subcategories,id',
        ];
    }
}
