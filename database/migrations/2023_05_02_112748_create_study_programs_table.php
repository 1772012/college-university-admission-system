<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudyProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('study_programs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('faculties_id')->references('id')->on('faculties')->onDelete('cascade');
            $table->string('code', 50);
            $table->string('name', 50);
            $table->string('alias', 50);
            $table->set('level', [
                'D3',
                'S1',
                'S2',
                'PF',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('study_programs');
    }
}
