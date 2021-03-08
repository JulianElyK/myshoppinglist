<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShoppinglistdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shoppinglistdetails', function (Blueprint $table) {
            $table->foreignId('shoppinglist_id')->constrained()->onDelete('cascade');
            $table->integer('number');
            $table->string('itemname');
            $table->unsignedInteger('amount')->default(1);
            $table->string('unit')->default('');
            $table->string('memo')->nullable();
            $table->timestamps();

            $table->primary(array('shoppinglist_id', 'number'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shoppinglistdetails');
    }
}
