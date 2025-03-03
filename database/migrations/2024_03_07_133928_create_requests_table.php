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
            $table->string('tracking_code')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('verified_email_id')->nullable();
            $table->decimal('price', 8, 2)->default(0);
            $table->enum('payment_type', ['Walk in', 'Online'])->default('Walk in');
            $table->dateTime('appointment_date');
            $table->dateTime('canceled_at')->nullable();
            $table->dateTime('approved_at')->nullable();
            $table->dateTime('completed_at')->nullable();
            $table->dateTime('claimed_at')->nullable();
            $table->dateTime('paid_at')->nullable();
            $table->enum('status', ['Pending Approval', 'In Progress', 'Payment Approval', 'Awaiting Payment', 'Ready for Collection', 'Completed', 'Canceled'])->default('Pending Approval');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('verified_email_id')->references('id')->on('verified_emails')->onDelete('cascade');

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
