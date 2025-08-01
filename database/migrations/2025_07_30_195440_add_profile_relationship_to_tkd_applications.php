<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('t_k_d_applications', function (Blueprint $table) {
            $table->unsignedBigInteger('profile_id')->nullable()->after('id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->string('phone')->nullable();
            
            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('t_k_d_applications', function (Blueprint $table) {
            $table->dropForeign(['profile_id']);
            $table->dropColumn([
                'profile_id',
                'first_name',
                'last_name',
                'email',
                'address',
                'city',
                'state',
                'zip',
                'phone'
            ]);
        });
    }
};