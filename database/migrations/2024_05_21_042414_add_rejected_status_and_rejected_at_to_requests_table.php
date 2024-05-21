<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('requests', function (Blueprint $table) {
            $table->enum('status', [
                'Pending Approval', 
                'In Progress', 
                'Payment Approval', 
                'Awaiting Payment', 
                'Ready for Collection', 
                'Completed', 
                'Canceled', 
                'Rejected'
            ])->default('Pending Approval')->change();

            $table->dateTime('rejected_at')->nullable()->before('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('requests')
            ->where('status', 'Rejected')
            ->update(['status' => 'Canceled']);
        Schema::table('requests', function (Blueprint $table) {
            $table->enum('status', [
                'Pending Approval', 
                'In Progress', 
                'Payment Approval', 
                'Awaiting Payment', 
                'Ready for Collection', 
                'Completed', 
                'Canceled'
            ])->default('Pending Approval')->change();

            $table->dropColumn('rejected_at');
        });
    }
};
