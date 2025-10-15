<?php

use App\Enum\PersonnelGender;
use App\Enum\PersonnelType;
use App\Models\Rank;
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
        Schema::create('personnels', function (Blueprint $table) {
            $table->id();
            $table->string('service_number')->unique();
            $table->foreignIdFor(Rank::class)->constrained()->cascadeOnDelete();
            $table->string('last_name');
            $table->string('other_names');
            $table->enum('gender', PersonnelGender::cases())->default(PersonnelGender::MALE);
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->enum('type', PersonnelType::cases())->default(PersonnelType::OFFICER);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personnels');
    }
};