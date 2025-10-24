<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTransactionDetail extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'product_id',
        'fk_detail_header',
        'qty'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function detail() {
        return $this->belongsTo(ProductTransactionHeader::class, 'product_transaction_header_id');
    }
}
