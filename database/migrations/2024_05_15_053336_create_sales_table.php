<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_employees')->constrained()->references('id')->on('employees');
            $table->foreignId('id_item')->constrained()->references('id')->on('items');
            $table->string("kode_nota");
            $table->integer("jumlah")->default(1);
            $table->integer("harga");
            $table->integer("diskon")->default(0);
            $table->integer("total");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
