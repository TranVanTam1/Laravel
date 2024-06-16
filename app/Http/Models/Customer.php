<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Bill;
class Customer extends Model
{
    use HasFactory;
    protected $table = 'customer';
  public function bills(): BelongsTo
    {
        return $this->belongsTo(Bill::class,'id','id_customer');
    }
}
