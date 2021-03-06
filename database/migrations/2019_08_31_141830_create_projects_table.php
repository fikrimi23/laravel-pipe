<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pipe_projects', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->unsignedBigInteger('credential_id');
            $table->smallInteger('repository');
            $table->string('host');
            $table->string('dir_deploy');
            $table->string('dir_workspace');
            $table->string('branch');
            $table->smallInteger('keep_build')->default(10);
            $table->json('commands');
            $table->smallInteger('timeout')->default(300);
            $table->text('namespace');
            $table->timestamps();

            $table->foreign('credential_id')->references('id')
                ->on('pipe_credentials')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfexists('pipe_projects');
    }
}
