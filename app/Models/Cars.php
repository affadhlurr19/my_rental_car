<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cars extends Model
{
    use HasFactory;

    protected $table = 'cars';
    protected $primaryKey = 'cars_id';
    protected $fillable = [
        'cars_id',
        'brand',
        'model',
        'number_plate',
        'car_photo',
        'price_per_day',
        'description'
    ];   

    protected $guarded=[];
}
