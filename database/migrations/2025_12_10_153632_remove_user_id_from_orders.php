<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // For SQLite, we'll handle the column removal differently
        // First, get all orders data
        $orders = DB::table('orders')->get();

        // Drop the table and recreate it without user_id
        Schema::dropIfExists('orders');

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default('pending');
            $table->decimal('subtotal', 8, 2)->default(0.00);
            $table->decimal('tax', 8, 2)->default(0.00);
            $table->decimal('total', 8, 2)->default(0.00);
            $table->timestamps();
        });

        // Re-insert the data without user_id
        foreach ($orders as $order) {
            DB::table('orders')->insert([
                'id' => $order->id,
                'status' => $order->status,
                'subtotal' => $order->subtotal,
                'tax' => $order->tax,
                'total' => $order->total,
                'created_at' => $order->created_at,
                'updated_at' => $order->updated_at,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable(); // Add back the column
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Add foreign key back
        });
    }
};
