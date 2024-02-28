<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('enrolls', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('mobile');
            $table->foreignId('batch_id')->constrained();
            $table->enum('payment_method', ['bkash', 'offline']);
            $table->string('transaction')->nullable();
            $table->string('token')->nullable();
            $table->integer('amount')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('enrolls');
    }
};
