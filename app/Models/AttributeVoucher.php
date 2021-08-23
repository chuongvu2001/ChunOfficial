<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeVoucher extends Model
{
    use HasFactory;
    protected $table = "attr_voucher";
    protected $fillable = [
        'user_id','voucher_id','status'
    ];
}
