<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('pipelines', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->foreignId('previous_id')->nullable()->constrained('pipelines')->onDelete('set null');
            $table->foreignId('next_id')->nullable()->constrained('pipelines')->onDelete('set null');
            $table->timestamps();
        });
        
    }

    public function down() {
        Schema::dropIfExists('pipelines');
    }
};
