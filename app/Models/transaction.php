<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    protected $table = 'transaction';

    protected $fillable = [
        'user_id',
        'barang_model_id',
        'quantity',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function barangItem(){
        return $this->hasMany(barangModel::class, 'barang_model_id');
    }
}
