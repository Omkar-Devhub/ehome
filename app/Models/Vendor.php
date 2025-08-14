<?php

namespace App\Models;

use App\Models\Area;
use App\Models\County;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Vendor extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'company_name',
        'phone',
        'address',
        'latitude',
        'longitude',
        'description',
        'email_verified_at',
        'show_phone_number',
        'county_id',
        'area_id',
        'eircode',
        'tax_id',
        'password',
        'status',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function county()
    {
        return $this->belongsTo(County::class);
    }
}
