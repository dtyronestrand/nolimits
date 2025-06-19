<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('homes', function (Blueprint $table) {
            // this will create an id, a "published" column, and soft delete and timestamps columns
            createDefaultTableFields($table, true, false);
            
            // add those 2 columns to enable publication timeframe fields (you can use publish_start_date only if you don't need to provide the ability to specify an end date)
            // $table->timestamp('publish_start_date')->nullable();
            // $table->timestamp('publish_end_date')->nullable();
        });

        Schema::create('home_translations', function (Blueprint $table) {
            createDefaultTranslationsTableFields($table, 'home');
        
        });
        Schema::table('home_translations', function(Blueprint $table){
            $table->after('home_id', function ($table){
                $table->string('title')->nullable();
            
                $table->string('meta_title')->nullable();
                $table->string('meta_description')->nullable();
            });
        });

        Schema::create('home_revisions', function (Blueprint $table) {
            createDefaultRevisionsTableFields($table, 'home');
        });
    }

    public function down()
    {
        Schema::dropIfExists('home_revisions');
        Schema::dropIfExists('home_translations');
        Schema::dropIfExists('homes');
    }
};
