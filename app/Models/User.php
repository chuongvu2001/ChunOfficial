<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Traits\HasPermissions;


class User extends Authenticatable implements MustVerifyEmail
{

    use HasFactory, Notifiable, HasRoles,HasPermissions;
    protected $table = "users";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'image',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function voucher(){
        return DB::table('users')->
        select(
            "users.id as user_id",
            "users.name as user_name",
            "voucher.id as voucher_id",
            "voucher.name as voucher_name",
            "attr_voucher.status as attr_status"
        )
            ->join('attr_voucher', 'attr_voucher.user_id', '=', 'users.id')
            ->join('voucher', 'attr_voucher.voucher_id', '=', 'voucher.id')
            ->where('users.id', $this->id)
            ->get()
            ->toArray();
    }
}
