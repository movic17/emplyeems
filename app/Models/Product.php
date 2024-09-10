<?php

namespace App\Models;

use App\Models\OrderDetail;
use App\Models\Transfer;
use App\Models\DeliveryDetail;
use App\Models\Inventory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'category_id',
        'product_code',
        'barcode',
        'product_name',
        'product_description',
        'reorder_qty',
        'packed_weight',
        'packed_height',
        'packed_width',
        'packed_depth',
        'order_qty',
        'refrigerated',
    ];

    protected $casts = [
        'refrigerated' => 'boolean',
    ];

    public function orderDetails(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function transfers(): HasMany
    {
        return $this->hasMany(Transfer::class);
    }

    public function deliveryDetails(): HasMany
    {
        return $this->hasMany(DeliveryDetail::class);
    }

    public function inventories(): HasMany
    {
        return $this->hasMany(Inventory::class);
    }
}
