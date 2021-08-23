<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Invoice extends Model
{
    use HasFactory;
    protected $table = 'invoices';
    protected $fillable = [
        'name','email','sum','total','city','address','payment_id','phone','user_id','voucher_id','ship','town','sum',
        'voucher_sale',
    ];
    public function get_user(){
       return $this->belongsTo(User::class,'user_id');
    }
    public function get_payments(){
        return $this->belongsTo(Payment::class,'payment_id');
    }
    public function product(){
        return DB::table('invoices')->select(
            "invoices.id as invoice_id",
            "invoices.total as total",
            "invoice_product.id as invoice_product_id",
            "invoice_product.name as invoice_product_name",
            "invoice_product.image as invoice_product_image",
            "invoice_product.size as invoice_product_size",
            "invoice_product.color as invoice_product_color",
            "invoice_product.amount as invoice_product_amount",
            "invoice_product.price as invoice_product_price",
            "invoice_product.total as invoice_product_total",
            "invoice_product.pro_id as invoice_product_proid",
            "invoice_product.stock as invoice_product_stock",
            "attr_invoice.invoice_id as attr_invoice_invoice_id",
            "attr_invoice.invoice_product_id as attr_invoice_invoice_product_id"
        )->join('attr_invoice','attr_invoice.invoice_id','=','invoices.id')
            ->join('invoice_product','attr_invoice.invoice_product_id','=','invoice_product.id')->where('invoices.id', $this->id)
            ->get()
            ->toArray();
    }
}
