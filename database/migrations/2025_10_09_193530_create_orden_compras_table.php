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
    Schema::create('orden_compras', function (Blueprint $table) {
        $table->id();
        $table->date('fecha');
        $table->string('proveedor');
        $table->string('lugar');
        $table->string('solicitado_por');
        $table->decimal('subtotal', 10, 2)->default(0);
        $table->decimal('descuento', 10, 2)->default(0);
        $table->decimal('impuesto', 10, 2)->default(0);
        $table->decimal('total', 10, 2)->default(0);
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orden_compras');
    }
};
