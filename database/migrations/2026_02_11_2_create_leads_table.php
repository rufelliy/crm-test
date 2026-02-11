<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone', 20);
            $table->enum('status', ['new', 'in_progress', 'won', 'lost'])
                ->default('new');

            $table->foreignId('manager_id')
                ->nullable()
                ->constrained('managers')
                ->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('leads');
    }
};