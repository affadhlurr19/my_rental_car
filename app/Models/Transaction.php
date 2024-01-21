<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transaction';
    protected $primaryKey = 'transaction_id';
    protected $fillable = [
        'users_id',
        'cars_id',
        'start_date',
        'end_date',
        'total_price',
        'payment_status',
        'tracking_status',
        'admin_check'
    ];

    protected $guarded = [];
}
