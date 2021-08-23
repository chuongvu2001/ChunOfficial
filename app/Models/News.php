<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $table = 'news';
    protected $fillable = [
        'title','image','image2','content','view','like','cate_id','user_id','slug'
    ];
    public function get_cate(){
        return $this->belongsTo(CategoryNew::class,'cate_id');
    }
    public function get_user(){
        return $this->belongsTo(User::class,'user_id');
    }

}
