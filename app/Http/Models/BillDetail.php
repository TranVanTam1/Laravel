<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Bill;
use App\Models\Product;
class BillDetail extends Model
{
    use HasFactory;
    protected $table = 'bill_detail';

    // public function bill(): BelongsTo
    // {
    //     return $this->belongsTo(Bill::class,'id_bill','id');
    // }
    public function bill(): BelongsTo
    {
        return $this->belongsTo(Bill::class, 'id_bill', 'id');
    }
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'id_product', 'id');
    }
}
