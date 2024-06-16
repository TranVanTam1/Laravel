<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Car;
class Mf extends Model
{
    use HasFactory;
    protected $table='mfs';
    
    /**
     * Get the comments for the blog post.
     */
    public function cars(): HasMany
    {
        return $this->hasMany(Car::class,'mf_id','id');
    }
}
