<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    // use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'image_path',
        'name',
        'description',
        'amount',
        'price',
        'category_id'
    ];

    public function category(){
        return $this->belongsTo(ProductCategory::class);
    }

    public function isSelectedCategory(int $category_id):bool
    {
        return $this->hasCategory() && $this->category->id == $category_id;
    }

    public function hasCategory():bool
    {
        return !is_null($this->category);
    }
}