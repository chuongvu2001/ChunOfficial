<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attr_Invoice extends Model
{
    use HasFactory;
    protected $table = "attr_invoice";
    protected $fillable = [
        "invoice_id","invoice_product_id",
    ];
    public $timestamps = false;
}
