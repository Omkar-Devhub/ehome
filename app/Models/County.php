<?php

namespace App\Models;

use App\Models\Property;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class County extends Model
{
    use HasFactory;
    protected $guarded = [];

    // Ensure name is stored in lowercase for consistency
    public static function boot() {
        parent::boot();
        static::saving(function ($county) {
            $county->name = strtolower($county->name);
        });
    }

    public function activeProperties()
{
    return $this->hasMany(Property::class)->where('status', '1');
}
}
