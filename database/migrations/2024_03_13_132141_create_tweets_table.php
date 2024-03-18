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
        //Hier definiere ich die Struktur der Tabelle
        Schema::create('tweets', function (Blueprint $table) {
            $table->id();
            $table->text('firstname');
            $table->text('lastname');
            $table->string('title');
            $table->text('tweet');
            $table->timestamps();
        });
    }

   
    public function down(): void
    {
        Schema::dropIfExists('tweets');
    }
};
