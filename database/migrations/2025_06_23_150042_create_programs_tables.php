<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('programs', function (Blueprint $table) {
            // this will create an id, a "published" column, and soft delete and timestamps columns
            createDefaultTableFields($table);
            
            $table->integer('position')->unsigned()->nullable();
            
            // add those 2 columns to enable publication timeframe fields (you can use publish_start_date only if you don't need to provide the ability to specify an end date)
            // $table->timestamp('publish_start_date')->nullable();
            // $table->timestamp('publish_end_date')->nullable();

            // this will create the required columns to support nesting for this module
            $table->nestedSet();
        });

        Schema::create('program_translations', function (Blueprint $table) {
            createDefaultTranslationsTableFields($table, 'program');
            $table->string('title', 200)->nullable();
            $table->text('tagline')->nullable();
        });

        Schema::create('program_slugs', function (Blueprint $table) {
            createDefaultSlugsTableFields($table, 'program');
        });

        Schema::create('program_revisions', function (Blueprint $table) {
            createDefaultRevisionsTableFields($table, 'program');
        });
    }

    public function down()
    {
        Schema::dropIfExists('program_revisions');
        Schema::dropIfExists('program_translations');
        Schema::dropIfExists('program_slugs');
        Schema::dropIfExists('programs');
    }
};
