<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Mf;
class Car extends Model
{
    
    use HasFactory;
    protected $table='cars';
    public function mf(): BelongsTo
    {
        return $this->belongsTo(Mf::class,'mf_id','id');
    }
}
