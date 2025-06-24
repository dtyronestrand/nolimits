<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            // this will create an id, a "published" column, and soft delete and timestamps columns
            createDefaultTableFields($table);

            $table->string('name', 200)->nullable();
            $table->string('first_name', 100)->nullable();
            $table->string('last_name', 100)->nullable();
            $table->text('bio')->nullable();
            $table->string('email', 150)->nullable();
            $table->integer('program_user_id')->unsigned()->nullable();
            $table->integer('role_user_id')->unsigned()->nullable();
            $table->string('address', 255)->nullable();
            $table->string('city', 100)->nullable();
            $table->string('state', 100)->nullable();
            $table->string('zip', 20)->nullable();
            $table->foreignId('user_id')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');

        });

        Schema::create('profile_translations', function (Blueprint $table) {
            createDefaultTranslationsTableFields($table, 'profile');

        });

        Schema::create('profile_slugs', function (Blueprint $table) {
            createDefaultSlugsTableFields($table, 'profile');
        });


    }

    public function down()
    {

        Schema::dropIfExists('profile_translations');
        Schema::dropIfExists('profile_slugs');
        Schema::dropIfExists('profiles');
    }
};
