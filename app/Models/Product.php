<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'manufacturing_date',
        'expiration_date',
        'quantity',
    ];

    protected $casts = [
        'manufacturing_date' => 'date',
        'expiration_date' => 'date',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function getManufacturingDateAttribute($value)
    {
        return date('d-m-Y', strtotime($value));
    }

    public function getExpirationDateAttribute($value)
    {
        return date('d-m-Y', strtotime($value));
    }

    public function category()
    {
        return $this->belongsTo(category::class);
    }
}
