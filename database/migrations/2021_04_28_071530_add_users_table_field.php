<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUsersTableField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('mobile')->nullable()->after('password');
            $table->string('add')->nullable()->after('mobile');
            $table->string('gender')->nullable()->after('add');
            $table->string('img')->nullable()->after('gender');
            $table->tinyInteger('status')->nullable()->after('img');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('mobile');
            $table->dropColumn('add');
            $table->dropColumn('gender');
            $table->dropColumn('img');
            $table->dropColumn('status');
        });
    }
}
