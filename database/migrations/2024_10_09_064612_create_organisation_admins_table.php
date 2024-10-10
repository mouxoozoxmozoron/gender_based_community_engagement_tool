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
        Schema::create('organisation_admins', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('organisation_id');
            $table->string('position'); // 1 or 2
            $table->timestamps();
            $table->string('status')->default(0);
            $table->string('archive')->default(0);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organisation_admins');
    }
};
