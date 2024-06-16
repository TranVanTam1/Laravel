<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Type;
class Product extends Model
{
    use HasFactory;
    protected $table='products';
    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class,'id_type','id');
    }
    public function getTypeNameAttribute(): string
    {
        return $this->type->name;
    }
}
