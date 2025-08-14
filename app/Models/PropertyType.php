<?php

namespace App\Models;

use App\Models\AdType;
use App\Models\PropertyCategory;
use Illuminate\Database\Eloquent\Model;

class PropertyType extends Model
{
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(PropertyCategory::class, 'property_category_id');
    }

    public function adTypes()
    {
        return $this->belongsToMany(AdType::class, 'ad_type_property_type');
    }
}
