<?php

namespace App\Models;

use App\Models\ServicesCategory;
use Illuminate\Database\Eloquent\Model;

class ServicesSubCategory extends Model
{
    protected $guarded = [];

    public function services_category()
    {
        return $this->belongsTo(ServicesCategory::class);
    }
}
