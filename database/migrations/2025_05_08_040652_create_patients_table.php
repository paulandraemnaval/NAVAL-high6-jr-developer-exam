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


        Schema::create('patients', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->foreignId('brgy_id')->constrained('brgys')->onDelete('restrict');
            $table->string('number')->unique();
            $table->string('email')->nullable()->unique();
            $table->string('case_type')->default(null);
            $table->string('coronavirus_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
