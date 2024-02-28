<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('batches', function (Blueprint $table) {
            $table->id();
            $table->integer('batch');
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable()->unique();
            $table->string('mobile')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('image')->nullable();
            $table->timestamp('last_seen')->nullable();
            $table->foreignId('role_id')->constrained();
            $table->foreignId('batch_id')->nullable()->constrained();
            $table->rememberToken();
            $table->timestamps();
        });

        $roles = [
            'Super Admin',
            'Admin',
            'Batch Admin',
        ];

        foreach ($roles as $role) {
            DB::table('roles')->insert([
                'name' => $role
            ]);
        }

        $batches = [
            2010,
            2011,
            2012,
            2013,
            2014,
            2015,
            2016,
            2017,
            2018,
            2019,
            2020,
            2021,
            2022,
            2023
        ];

        foreach ($batches as $batch) {
            DB::table('batches')->insert([
                'batch' => $batch
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('users');
        Schema::dropIfExists('roles');
    }
};
