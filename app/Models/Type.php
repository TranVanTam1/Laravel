<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\Product;
use App\Models\Cartegory;
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
     // Khai báo mối quan hệ với Category
     public function cartegory(): BelongsTo
            {
                return $this->belongsTo(Cartegory::class, 'cartegory_id','id');
            }

}
