<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('t_s_y_s_ingenious_import_order_queue_bckp', function (Blueprint $table) {
            $table->bigIncrements('anID');

            $table->unsignedBigInteger('anIDQueue')->nullable();
            $table->foreign('anIDQueue')
                ->references('anID')
                ->on('t_s_y_s_ingenious_import_order_queue')
                ->onDelete('cascade');

            $table->string('acOID');
            $table->string('acDokumentenNr');
            $table->integer('anIDStatus');
            $table->integer('anPriority');
            $table->string('acError');
            
            $table->timestamp('addateInserted');
            $table->timestamp('addateUpdated');

            $table->integer('anIDTaskType');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_s_y_s_ingenious_import_order_queue_bckp');
    }
};
