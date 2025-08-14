<?php

namespace App\Models;

use App\Models\PropertyType;
use Illuminate\Database\Eloquent\Model;

class PropertyCategory extends Model
{
    protected $guarded = [];

    public function propertyTypes()
    {
        return $this->hasMany(PropertyType::class);
    }
}
