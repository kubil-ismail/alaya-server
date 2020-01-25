<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranch extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(255);
        Schema::create('branchs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('branch_name');
            $table->longText('address');
            $table->string('phone');
            $table->string('map_url');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('open_hour');
            $table->string('closing_time');
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
        Schema::dropIfExists('branch');
    }
}
