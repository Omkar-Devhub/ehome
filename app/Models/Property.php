<?php

namespace App\Models;

use App\Models\BER;
use App\Models\Area;
use App\Models\User;
use App\Models\AdType;
use App\Models\County;
use App\Models\Favorite;
use App\Models\PropertyType;
use App\Models\PropertyImage;
use App\Models\PropertyNearBy;
use App\Models\PropertyCategory;
use App\Models\PropertyFacility;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $guarded = [];

    public function images()
    {
        return $this->hasMany(PropertyImage::class);
    }

    public function nearBy()
    {
        return $this->hasMany(PropertyNearBy::class);
    }

    public function firstImage()
    {
        return $this->hasOne(PropertyImage::class)->oldest();
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function county()
    {
        return $this->belongsTo(County::class);
    }

    public function propertyable()
    {
        return $this->morphTo();
    }

    public function adType()
    {
        return $this->belongsTo(AdType::class);
    }

    public function category()
    {
        return $this->belongsTo(PropertyCategory::class, 'property_category_id');
    }

    public function type()
    {
        return $this->belongsTo(PropertyType::class, 'property_type_id');
    }

    public function ber()
    {
        return $this->belongsTo(BER::class);
    }

    public function facilities()
    {
        return $this->hasMany(PropertyFacility::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites', 'property_id', 'user_id');
    }

    public function isFavoritedBy(User $user)
    {
        return $this->favorites()->where('user_id', $user->id)->exists();
    }
}
