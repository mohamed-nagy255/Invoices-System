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
        Schema::create('invoice_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id') -> references('id') -> on('invoices')  -> onUpdate('cascade')
            -> onDelete('cascade');
            $table->string('invoice_number', 50);
            $table->string('product', 50);
            $table->string('Section');
            $table->string('Status', 50);
            $table->integer('Value_Status') -> comment ('0=>paid, 1=>Unpaid, 2=>partially');
            $table->date('Payment_Date')->nullable();
            $table->text('note')->nullable();
            $table->string('user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_details');
    }
};
