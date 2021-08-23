<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice_Product extends Model
{
    use HasFactory;
    protected $table = "invoice_product";
    protected $fillable = [
        "name","image","size",'color','amount','price','total','pro_id','stock'
    ];
}
