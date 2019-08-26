<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserUploadedFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_uploaded_files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->string('folder', 300);
            $table->string('name', 200)->index();
            $table->string('type', 50);
            $table->bigInteger('size')->unsigned();
            $table->string('icon', 300);
            $table->string('customer_name', 100)->index();
            $table->string('customer_number', 100)->index();
            $table->string('invoice_number', 100)->index();
            $table->date('invoice_date');
            $table->string('service_type', 50)->index();
            $table->bigInteger('amount');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->unique(['folder', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_uploaded_files');
    }
}
