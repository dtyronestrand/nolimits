<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('t_k_d_applications', function (Blueprint $table) {
            // this will create an id, a "published" column, and soft delete and timestamps columns
            createDefaultTableFields($table);
            
            // feel free to modify the name of this column, but title is supported by default (you would need to specify the name of the column Twill should consider as your "title" column in your module controller if you change it)
            $table->string('class_type', 200)->nullable();

            // your generated model and form include a description field, to get you started, but feel free to get rid of it if you don't need it

            $table->boolean('waiver')->default(false);
            $table->text('signature')->nullable();
            $table->timestamp('signed_at')->nullable();
            $table->integer('position')->unsigned()->nullable();
            $table->boolean('experience')->default(false);
            $table->text('present_level')->nullable();
            $table->integer('age')->unsigned()->nullable();
            $table->json('emergency_contact')->nullable();
       
            
            
            // add those 2 columns to enable publication timeframe fields (you can use publish_start_date only if you don't need to provide the ability to specify an end date)
            // $table->timestamp('publish_start_date')->nullable();
            // $table->timestamp('publish_end_date')->nullable();
        });

        Schema::create('t_k_d_application_revisions', function (Blueprint $table) {
            createDefaultRevisionsTableFields($table, 't_k_d_application');
        });
    }

    public function down()
    {
        Schema::dropIfExists('t_k_d_application_revisions');
        Schema::dropIfExists('t_k_d_applications');
    }
};
