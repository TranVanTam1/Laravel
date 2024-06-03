<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Product;
class Type extends Model
{
    use HasFactory;
    protected $table='type_products';
    
    /**
     * Get the comments for the blog post.
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class,'id_type','id');
    }
}
