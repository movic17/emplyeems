<?php

use App\Models\Category;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Category::class);
            $table->string('product_code', 100);
            $table->string('barcode', 100);
            $table->string('product_name', 100);
            $table->text('product_description', 2000);
            $table->integer('reorder_qty');
            $table->decimal('packed_weight', 10, 2);
            $table->decimal('packed_height', 10, 2);
            $table->decimal('packed_width', 10, 2);
            $table->decimal('packed_depth', 10, 2);
            $table->integer('order_qty');
            $table->boolean('refrigerated')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
