<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThirdPartyInstructionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('third_party_instructions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('instructionID');
            $table->json('linkTo');
            $table->string('instructionType');
            $table->string('assignedVendor');
            $table->string('attentionOf');
            $table->integer('quotationNo')->nullable();
            $table->string('invoiceTo');
            $table->string('customerContract');
            $table->string('vendorAddress');
            $table->string('customerPO')->nullable();
            $table->string('status');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('third_party_instructions');
    }
}