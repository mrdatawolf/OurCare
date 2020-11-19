<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildrenParentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('children_parents', function (Blueprint $table) {
            $table->integer('children_id')->unsigned()->index();
            $table->foreign('children_id')->references('id')->on('children')->onDelete('cascade');
            $table->integer('parents_id')->unsigned()->index();
            $table->foreign('parents_id')->references('id')->on('parents')->onDelete('cascade');
            $table->primary(['children_id', 'parents_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('children_parents');
    }
}
