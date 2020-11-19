<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildrenPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('children_payments', function (Blueprint $table) {
            $table->integer('children_id')->unsigned()->index();
            $table->foreign('children_id')->references('id')->on('children')->onDelete('cascade');
            $table->integer('payments_id')->unsigned()->index();
            $table->foreign('payments_id')->references('id')->on('payments')->onDelete('cascade');
            $table->primary(['children_id', 'payments_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('children_payments');
    }
}
