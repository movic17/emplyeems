<?php

namespace App\Models;

use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    use HasFactory;

    protected $table = 'locations';

    protected $fillable = [
        'location_name',
        'location_address',
    ];

    public function orderDetails(): HasMany
    {
        return $this->hasMany(Warehouse::class);
    }
}
