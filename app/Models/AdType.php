<?php

namespace App\Models;

use App\Models\PropertyCategory;
use Illuminate\Database\Eloquent\Model;

class AdType extends Model
{
    protected $guarded = [];
    public function propertyCategories()
    {
        return $this->belongsToMany(PropertyCategory::class, 'ad_type_category');
    }

    public function propertyTypes()
    {
        return $this->belongsToMany(PropertyType::class, 'ad_type_property_type');
    }
}
