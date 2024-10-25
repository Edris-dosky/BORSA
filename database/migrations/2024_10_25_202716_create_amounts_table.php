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
        Schema::create('amounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('currency_id')->nullable()->constrained('currencies')->onDelete('set null');
            $table->double('amount');
            $table->double('fees')->nullable();
            $table->double('constraint')->nullable();
            $table->double('tottal')->nullable();
            $table->string('pay_method')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('amounts');
    }
};
