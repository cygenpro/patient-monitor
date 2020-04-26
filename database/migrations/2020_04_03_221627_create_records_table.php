<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('from_id');
            $table->unsignedBigInteger('to_id');
            $table->float('temperature');
            $table->boolean('has_cough')->default(false);
            $table->boolean('has_hard_breath')->default(false);
            $table->boolean('has_sore_throat')->default(false);
            $table->boolean('has_diarrhea')->default(false);
            $table->boolean('has_tiredness')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('from_id')
                ->references('id')->on('users');

            $table->foreign('to_id')
                ->references('id')->on('users');

            $table->index('from_id');
            $table->index('to_id');
            $table->index('temperature');
            $table->index('has_cough');
            $table->index('has_hard_breath');
            $table->index('has_sore_throat');
            $table->index('has_diarrhea');
            $table->index('has_tiredness');
            $table->index('created_at');
            $table->index('updated_at');
            $table->index('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('records');
    }
}
