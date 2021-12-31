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
        Schema::table('shortens', function (Blueprint $table) {
            $table->unsignedInteger('count')->default(0)->after('external');
            $table->unsignedInteger('real_count')->default(0)->after('count');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shortens', function (Blueprint $table) {
            $table->dropColumn([
                'count',
                'real_count',
            ]);
        });
    }
};
