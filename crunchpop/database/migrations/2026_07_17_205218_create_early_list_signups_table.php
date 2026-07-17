<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('early_list_signups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->json('interests')->nullable(); // candy, preparedness, custom_freeze_drying, fundraisers, wholesale, local_updates
            $table->string('source')->nullable();  // which page/form the signup came from
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('early_list_signups');
    }
};
