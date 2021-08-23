<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryNew extends Model
{
    use HasFactory;
    protected $table = 'category_news';
    protected $fillable = [
        'name','role','status','slug'
    ];
    public function child(){
        return $this->hasmany(CategoryNew::class,'role');
    }
}
