<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Customer;
class Bill extends Model
{
    use HasFactory;
    protected $table = 'bills';


   
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'id_customer', 'id');
    }
    public function billDetails()
    {
        return $this->hasMany(BillDetail::class, 'id_bill', 'id'); // Replace with actual relationship method and model
    }
}
