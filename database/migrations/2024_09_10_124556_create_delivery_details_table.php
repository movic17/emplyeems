<?php

use App\Models\Delivery;
use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('delivery_details', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Delivery::class);
            $table->foreignIdFor(Product::class);
            $table->foreignIdFor(Warehouse::class);
            $table->integer('delivery_qty');
            $table->date('expected_date');
            $table->date('actual_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_details');
    }
};
