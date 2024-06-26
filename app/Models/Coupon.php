<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $table='coupons';
    protected $fillable = [
        'code', 'discount_percent', 'valid_from', 'valid_to',
    ];
}
