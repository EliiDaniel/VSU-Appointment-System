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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->decimal('price', 8, 2)->default(0);
            $table->enum('payment_type', ['Walk in', 'Online'])->default('Walk in');
            $table->timestamp('appointment_date');
            $table->timestamp('canceled_at')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamp('claimed_at')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->enum('status', ['Pending Approval', 'In Progress', 'Awaiting Payment', 'Ready for Collection', 'Completed', 'Canceled'])->default('Pending Approval');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
