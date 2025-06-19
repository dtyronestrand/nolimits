<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            // this will create an id, a "published" column, and soft delete and timestamps columns
            createDefaultTableFields($table);
            
            
            
            // add those 2 columns to enable publication timeframe fields (you can use publish_start_date only if you don't need to provide the ability to specify an end date)
            // $table->timestamp('publish_start_date')->nullable();
            // $table->timestamp('publish_end_date')->nullable();

            // this will create the required columns to support nesting for this module
            $table->nestedSet();
        });
        Schema::table('pages', function(Blueprint $table){
            $table->after('id', function($table){
                $table->integer('position')->unsigned()->nullable();
            });
        
        Schema::create('page_translations', function (Blueprint $table) {
            createDefaultTranslationsTableFields($table, 'page');
        });

        Schema::table('page_translations', function(Blueprint $table){
            $table->after('page_id', function($table){
                $table->string('title', 200)->nullable();
                $table->string('meta_title', 200)->nullable();
                $table->string('meta_description', 200)->nullable();
            });
        });

        Schema::create('page_slugs', function (Blueprint $table) {
            createDefaultSlugsTableFields($table, 'page');
        });

        Schema::create('page_revisions', function (Blueprint $table) {
            createDefaultRevisionsTableFields($table, 'page');
        });
    });
    }

    public function down()
    {
        Schema::dropIfExists('page_revisions');
        Schema::dropIfExists('page_translations');
        Schema::dropIfExists('page_slugs');
        Schema::dropIfExists('pages');
    }
};
