<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('agentCode');
            $table->string('control_no');
            $table->string('processIdentifier');

            $table->foreignId('nation_id');

            $table->string('senderName');
            $table->string('senderPhone');
            $table->string('senderIdType');
            $table->string('senderId');

            $table->string('relation');
            $table->string('purpose');
            $table->string('sourceOfFund');

            $table->string('recipentName');
            $table->string('recipentPhone');
            $table->string('recipentIdType');
            $table->string('recipentId');

            $table->string('paymentName');
            $table->string('paymentNumber');

            // $table->string('sendingAmount');
            // $table->string('sendingCurrency');
            $table->string('sendingCountry');

            $table->string('receivingAmount');
            $table->string('receivingCurrency');
            $table->string('receivingCountry');

            $table->string('forexSession');
            $table->string('exRate');

            $table->boolean('state');
            $table->boolean('isApproved');

            $table->boolean('isCancel')->default(false);
            $table->string('cancelReason')->nullable();

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
        Schema::dropIfExists('transactions');
    }
};
