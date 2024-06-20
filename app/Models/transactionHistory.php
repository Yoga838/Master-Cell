<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transactionHistory extends Model
{
    protected $table = 'transaction_history';

    protected $fillable = [
        'transaction_id',
        'action',
    ];

    public function transaction(){
        return $this->belongsTo(transaction::class, 'transaction_id');
    }

}
