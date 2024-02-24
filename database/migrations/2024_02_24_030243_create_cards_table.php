<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up() {
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->foreignId('pipeline_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });        
    }

    public function down() {
        Schema::dropIfExists('cards');
    }
};
