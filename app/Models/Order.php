<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'product_id', // Tambahkan ini
        'tanggal_pemesanan', // Tambahkan ini
        'merchant_ref',
        'total_amount',
        'status',
        'tripay_reference',
        'payment_method',
        'payment_code',
        'payment_url',
    ];
}
