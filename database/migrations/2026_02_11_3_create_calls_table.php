<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('calls', function (Blueprint $table) {
            $table->id();

            $table->foreignId('lead_id')
                ->constrained('leads')
                ->cascadeOnDelete();

            $table->unsignedInteger('duration'); // секунди

            $table->string('result');

            $table->timestamp('created_at')
                ->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('calls');
    }
};