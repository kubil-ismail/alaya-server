<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTreatment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(255);
        
        Schema::create('treatments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('treatment_name');
            $table->longText('treatment_desc');
            $table->timestamps();
        });
        
        Schema::create('treatment_price', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('treatment_id');
            $table->string('treatment_duration');
            $table->string('treatment_price');
            $table->timestamps();
        });
        
        Schema::create('treatment_history', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->bigInteger('treatment_id');
            $table->bigInteger('branch_id');
            $table->bigInteger('treatment_price_id');
            $table->string('history_duration');
            $table->string('treatment_time');
            $table->string('treatment_end');
            $table->string('treatment_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('treatment');
        Schema::dropIfExists('treatment_price');
        Schema::dropIfExists('treatment_history');
    }


    // trigger
    // CREATE DEFINER=`root`@`localhost` TRIGGER `treatment_delete_price` AFTER DELETE ON `treatments` FOR EACH ROW BEGIN DELETE FROM `treatment_price` WHERE `treatment_price`.`treatment_id` = old.id; END
    // CREATE DEFINER=`root`@`localhost` TRIGGER `treatment_price_add` AFTER INSERT ON `treatments` FOR EACH ROW BEGIN INSERT INTO `treatment_price` (`id`, `treatment_id`, `treatment_duration`, `treatment_price`, `created_at`, `updated_at`) VALUES (NULL, new.id, '0', '0', NULL, NULL); END
}
