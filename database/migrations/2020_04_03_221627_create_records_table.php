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
            $table->string('temperature', 700);
            $table->string('has_cough', 700);
            $table->string('has_hard_breath', 700);
            $table->string('has_sore_throat', 700);
            $table->string('has_diarrhea', 700);
            $table->string('has_tiredness', 700);
            $table->timestamp('seen_at')->nullable();
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
            $table->index('seen_at');
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
