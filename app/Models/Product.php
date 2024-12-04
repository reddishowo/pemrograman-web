<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * Attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'description', 'price', 'stock', 'image_url'];

    /**
     * Relationship: A product can be part of many orders.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
