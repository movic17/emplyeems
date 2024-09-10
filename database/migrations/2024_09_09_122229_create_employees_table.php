<?php

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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
			$table->foreignId('department_id')->constrained()->cascadeOnDelete();
			$table->foreignId('designation_id')->constrained()->cascadeOnDelete();
			$table->string('first_name');
			$table->string('last_name');
			$table->date('dob');
			$table->enum('gender', ['male', 'female']);
			$table->date('join_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
