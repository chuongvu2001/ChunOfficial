<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reply;
use App\Models\User;
use App\Models\Product;
class Comment extends Model
{
    use HasFactory;
    protected $table = 'comments';
    public $fillable = [
        'pro_id','user_id','comment','star'
    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function product(){
        return $this->belongsTo(Product::class,'pro_id');
    }
    public function comment()
    {
        return $this->hasMany(Comment::class,'parent_id');
    }
}
