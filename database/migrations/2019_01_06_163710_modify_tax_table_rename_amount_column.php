<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyTaxTableRenameAmountColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::table('taxes', function (Blueprint $table) {
		    $table->renameColumn('amount', 'rate');
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::table('taxes', function (Blueprint $table) {
		    $table->renameColumn('rate', 'amount');
	    });
    }
}
