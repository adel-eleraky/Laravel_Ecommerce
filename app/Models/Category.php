<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name' , 'slug' , 'details' , 'image'
    ];

    public static function rules($id = 0){

        return [
            'name' => "required|min:3|max:255|unique:categories,name,$id",
            'details' => 'required|min:5|max:1000',
            'image' => 'nullable|mimetypes:image/png,image/jpg,image/jpeg|max:1048576'
        ];
    }
}
