<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medical extends Model
{
    use HasFactory;
    protected $fillable = [
        'barcode',
        'name_ar',
        'indication',
        'dosage',
        'name_en',
        'composistion',
        'strength',
        'company',
        'net',
        'public',
        'pregnancy',
    ];
}
