<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Attribute;
use App\Models\Size;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'name','image','price','price_sale','sku','shorts','description','cate_id','slug','status','brand','thumbnail1','thumbnail2','thumbnail3'
    ];
//    public function attribute(){
//        return $this->belongsToMany(Attribute::class,'pro_attribute','pro_id','attr_id');
//    }
    public function category(){
        return $this->belongsTo(Category::class,'cate_id');
    }
    public function stars(){
        return $this->hasMany(Comment::class,'pro_id');
    }
    public function quantity(){
        return DB::table('products')->
        select(
            "products.id as pro_id",
            "products.name as product_name",
            "products.image as product_image",
            "sizes.id as size_id",
            "sizes.size as size_name",
            "colors.id as color_id",
            "colors.color as color_name",
            "attribute.amount as amount"
        )
        ->join('attribute', 'attribute.pro_id', '=', 'products.id')
        ->join('colors', 'attribute.color_id', '=', 'colors.id')
        ->join('sizes', 'attribute.size_id', '=', 'sizes.id')
        ->where('products.id', $this->id)
        ->get()
        ->toArray();
    }


}
