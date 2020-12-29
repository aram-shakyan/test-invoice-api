<?php

use App\Models\Invoice;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('school_name');
            $table->text('description');
            $table->float('amount');
            $table->unsignedBigInteger('payed_by')->nullable();
            $table->foreign('payed_by')->references('id')->on('users')->onDelete('SET NULL');
            $table->timestamp('payed_at')->nullable();
            $table->smallInteger('status')->default(Invoice::PENDING);
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
        Schema::dropIfExists('invoices');
    }
}
