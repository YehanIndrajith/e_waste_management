<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChildCategory extends Model
{
    protected $table = 'child_categories'; // Ensure this points to the correct table
    protected $fillable = ['category_id', 'sub_category_id', 'name', 'slug', 'status'];

    /**
     * Relation to Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relation to Subcategory
     */
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

   
}
