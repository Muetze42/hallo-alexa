<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('link_counts', function (Blueprint $table) {
            $table->dropColumn('ip');
        });
        Schema::table('link_real_counts', function (Blueprint $table) {
            $table->dropColumn('ip');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('link_counts', function (Blueprint $table) {
            $table->text('ip')->after('client');
        });
        Schema::table('link_real_counts', function (Blueprint $table) {
            $table->text('ip')->after('client');
        });
    }
};
