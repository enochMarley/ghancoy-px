<?php

use App\Enum\QuantityType;
use App\Enum\StockCategory;
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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('description')->nullable();
            $table->decimal('unit_cost_price', 12, 2);
            $table->decimal('unit_selling_price', 12, 2);
            $table->integer('quantity')->default(0);
            $table->enum('quantity_type', QuantityType::cases())->default(QuantityType::OTHER);
            $table->enum('category', StockCategory::cases())->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
