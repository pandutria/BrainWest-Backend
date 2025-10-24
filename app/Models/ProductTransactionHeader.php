<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTransactionHeader extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'buyer_id',
        'total',
        'address'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

}
