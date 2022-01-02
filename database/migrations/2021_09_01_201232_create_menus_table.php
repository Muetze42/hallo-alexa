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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->boolean('active')->default(false);
            $table->boolean('external')->default(false);
            $table->foreignId('page_id')->references('id')->on('pages')->onDelete('cascade');
            $table->string('route')->nullable();
            $table->string('icon')->nullable();
            $table->string('text')->nullable();
            $table->unsignedInteger('order')->default(99999);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
};
