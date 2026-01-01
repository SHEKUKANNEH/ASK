<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sneaker extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'brand',
        'model',
        'price',
        'description',
        'image_path',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
        ];
    }

    /**
     * Get the orders for the sneaker.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
