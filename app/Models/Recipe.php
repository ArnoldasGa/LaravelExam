<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Recipe extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'category_id',
        'description',
        'image',
        'is_active',
    ];

    protected $attributes = [
        'is_active' => 0
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class , 'category_id');
    }

    public function ingredients() : BelongsToMany
    {
        return $this->belongsToMany(Ingredient::class);
    }
}
