<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationStudyProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_study_programs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('applications_id')->references('id')->on('applications')->onDelete('cascade');
            $table->foreignUuid('study_programs_id')->references('id')->on('study_programs')->onDelete('cascade');
            $table->boolean('is_accepted')->nullable();
            $table->boolean('is_processed');
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
        Schema::dropIfExists('application_study_programs');
    }
}
