<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Client;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
        $table->id();
        $table->string('voornaam');
        $table->string('tussenvoegels');
        $table->string('achternaam');
        $table->string('adres');
        $table->string('postcode');
        $table->string('woonplaats');
        $table->string('land');
        $table->string('telefoon');
        $table->string('bsn');
        $table->string('vezekering');
        $table->string('polisnummer');
        $table->enum('bloedtype', ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-', 'onbekend'])->default('onbekend');
        $table->enum('geslacht', ['Man', 'Vrouw']);
        $table->string('profielfoto')->nullable();
        $table->foreignId('user_id')->constrained();
        $table->softDeletes();
        $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
