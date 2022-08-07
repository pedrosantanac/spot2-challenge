<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET SESSION sql_require_primary_key=0');
        Schema::create('cadastres', function (Blueprint $table) {
            $table->id();
            $table->integer('fid')->nullable();
            $table->longText('geo_shape')->nullable();
            $table->string('call_numero')->nullable();
            $table->string('codigo_postal')->nullable();
            $table->string('colonia_predio')->nullable();
            $table->decimal('superficie_terreno', 12, 2)->nullable()->default(0);
            $table->decimal('superficie_construccion')->nullable()->default(0);
            $table->string('uso_construccion')->nullable();
            $table->integer('clave_rango_nivel')->nullable();
            $table->integer('anio_construccion')->nullable();
            $table->string('instalaciones_especiales')->nullable();
            $table->decimal('valor_unitario_suelo')->nullable()->default(0);
            $table->decimal('valor_suelo', 16, 2)->nullable()->default(0);
            $table->string('clave_valor_unitario_suelo')->nullable();
            $table->string('colonia_cumpliemiento')->nullable();
            $table->string('alcaldia_cumplimiento')->nullable();
            $table->decimal('subsidio')->nullable()->default(0);
            $table->timestamps();

            $table->index(['codigo_postal', 'uso_construccion']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cadastres');
    }
};
