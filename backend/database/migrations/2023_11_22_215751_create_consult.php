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
        Schema::create('consult', function (Blueprint $table) {
            $table->id();
            $table->string("voornaam");
            $table->string("tussenvoegsel");
            $table->string("achternaam");
            $table->time("btijd");
            $table->time("etijd");
            $table->date("datum");
            $table->string("doctor");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consult');
    }
};
