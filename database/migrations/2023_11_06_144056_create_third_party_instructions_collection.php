<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Jenssegers\Mongodb\Schema\Blueprint;

class CreateThirdPartyInstructionsCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mongodb')->create('third_party_instructions', function (Blueprint $collection) {
            // Field Definitions
            $collection->string('instructionType');
            $collection->array('linkTo');
            $collection->string('attentionOf');
            $collection->string('invoiceTo');
            $collection->string('assignedVendor');
            $collection->string('vendorAddress');
            $collection->string('vendorQuotationNo');
            $collection->string('customer');
            $collection->string('NoCustomerPO');
            $collection->string('status');

            // Cost Detail Subdocument
            $collection->embedsMany('costDetail', function (Blueprint $embed) {
                $embed->embedsMany('costItem', function (Blueprint $embed) {
                    $embed->string('description');
                    $embed->float('QTY');
                    $embed->string('UOM');
                    $embed->float('unitPrice');
                    $embed->float('GST');
                    $embed->string('currency');
                    $embed->float('vatAmount');
                    $embed->float('subTotal');
                    $embed->float('total');
                });
                $embed->embedsMany('grandTotal', function (Blueprint $embed) {
                    $embed->string('currency');
                    $embed->float('vatAmount');
                    $embed->float('subTotal');
                    $embed->float('total');
                });
                $embed->string('notes');
            });

            // Attachment Field
            $collection->array('Attachment');

            // Index Definitions
            $collection->index('instructionType');
            $collection->index('assignedVendor');
            $collection->index('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mongodb')->dropIfExists('third_party_instructions');
    }
}
