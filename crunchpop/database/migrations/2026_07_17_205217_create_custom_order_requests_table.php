<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('custom_order_requests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('organization')->nullable();
            $table->string('event_type')->nullable();
            $table->date('event_date')->nullable();
            $table->string('guest_count')->nullable();
            $table->string('candy_type')->nullable();
            $table->string('bag_size')->nullable();
            $table->string('budget_range')->nullable();
            $table->string('fulfillment_preference')->nullable(); // pickup | shipping
            $table->text('message')->nullable();
            $table->string('status')->default('new'); // new, contacted, quoted, closed
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('custom_order_requests');
    }
};
