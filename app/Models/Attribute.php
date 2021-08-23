<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;
    protected $table = 'attribute';
    public $fillable = [
        'color_id','size_id','amount','pro_id','option_id'
    ];
    public function products(){
        return $this->belongsTo(Product::class,'pro_id');
    }
}
