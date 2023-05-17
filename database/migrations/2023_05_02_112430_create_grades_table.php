<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('subjects_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->foreignUuid('users_id')->references('id')->on('users')->onDelete('cascade');
            $table->double('kkm');
            $table->double('value');
            $table->set('semester', [
                'Ganjil',
                'Genap',
            ]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grades');
    }
}
