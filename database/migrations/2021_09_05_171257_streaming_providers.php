<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StreamingProviders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('streaming_providers', function (Blueprint $table) {
            $table->string('user_id');
            $table->boolean('Netflix');
            $table->boolean('Amazon_Prime_Video');
            $table->boolean('Disney_Plus');
            $table->boolean('HBO');
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
        //
    }
}
