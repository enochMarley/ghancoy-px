<?php

use App\Enum\SaleType;
use App\Models\Personnel;
use App\Models\Stock;
use Faker\Provider\ar_EG\Person;
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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Stock::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Personnel::class)->nullable()->constrained()->nullOnDelete();
            $table->integer('quantity')->default(1);
            $table->enum('sale_type', SaleType::cases())->default(SaleType::CASH);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
