<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

// Une commande a plusieurs produits
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)
            ->withPivot('total_quantity','total_price');
    }
}
