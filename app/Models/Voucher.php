<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\User;


class Voucher extends Model
{
    use HasFactory;
    protected $table = "voucher";
    protected $fillable = ['name','status'];

    public function username(){
        return $this->belongsToMany(User::class,'attr_voucher','voucher_id','user_id');
    }
    public function voucher(){
        return DB::table('voucher')->
        select(
            "voucher.id as voucher_id",
            "voucher.name as voucher_name",
            "users.id as user_id",
            "users.name as user_name",
            "users.email as email",
            "users.image as image",
            "attr_voucher.status as attr_status"
        )
            ->join('attr_voucher', 'attr_voucher.voucher_id', '=', 'voucher.id')
            ->join('users', 'attr_voucher.user_id', '=', 'users.id')
            ->where('voucher.id', $this->id)
            ->get()
            ->toArray();
    }
}
