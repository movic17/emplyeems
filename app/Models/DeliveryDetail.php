<?php

namespace App\Models;

use App\Models\Delivery;
use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DeliveryDetail extends Model
{
    use HasFactory;

    protected $table = 'delivery_details';

    protected $fillable = [
        'delivery_id',
        'product_id',
        'warehouse_id',
        'delivery_qty',
        'expected_date',
        'actual_date',
    ];

    protected $casts = [
        'expected_date' => 'date',
        'actual_date' => 'date',
    ];

    public function delivery(): BelongsTo
    {
        return $this->belongsTo(Delivery::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }
}
