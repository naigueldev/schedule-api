<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnsFromSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('schedules', function (Blueprint $table) {
            $table->datetime('start_date')->nullable(false)->change();
            $table->datetime('due_date')->nullable(false)->change();
        });
    }

}
