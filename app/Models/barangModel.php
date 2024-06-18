<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barangModel extends Model
{
    protected $table = 'barang';

    protected $fillable = [
        'nama_barang',
        'Harga_ambil',
        'Harga_jual',
        'stok',
        'foto_produk',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
