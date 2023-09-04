<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeclarationUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('declaration_uploads', function (Blueprint $table) {
            $table->id();
            $table->string("file")->nullable();
            $table->string("type")->nullable();
            $table->string("status")->nullable();
            $table->integer("draft_user_id")->constrained()->nullable();
            $table->integer("proofed_user_id")->constrained()->nullable();
            $table->integer("final_proofed_user_id")->constrained()->nullable();
            $table->timestamp("proofed_at")->nullable();
            $table->timestamp("final_proofed_at")->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('declaration_uploads');
    }
}
