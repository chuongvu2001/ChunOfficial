<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'Category';
    public $fillable = [
        'name','role','status'
    ];
    public function child(){
        return $this->hasmany(Category::class,'role');
    }

    public function products(){
        return $this->hasMany(Product::class,'cate_id');
    }
}
