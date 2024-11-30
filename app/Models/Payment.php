<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table="payments";
    protected $fillable = [
        'razorpay_payment_id',
        'amount',
        'name',
        'email',
        'mobile',
        'pin_code',
        'country',
        'pay_for',
        'remark',
     ];
}
