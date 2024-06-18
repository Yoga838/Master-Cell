<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cartItem extends Model
{
    protected $table = 'cartItem';

    protected $fillable = [
        'cart_id',
        'barang_model_id',
        'quantity',
    ];

    public function cart()
    {
        return $this->belongsTo(cart::class, 'cart_id');
    }

    public function barangModel()
    {
        return $this->belongsTo(barangModel::class, 'barang_model_id');
    }
}
