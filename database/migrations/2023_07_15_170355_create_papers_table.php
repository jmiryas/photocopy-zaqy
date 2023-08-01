<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('papers', function (Blueprint $table) {
            $table->id();
            $table->foreignId("merk_id")->constrained();
            $table->foreignId("supplier_id")->constrained();
            $table->foreignId("paper_size_id")->constrained();
            $table->integer("paper_rim");
            $table->integer("paper_sheet");
            $table->double("sell_price_rim")->default(0);
            $table->double("sell_price_partials")->default(0);
            $table->boolean("is_available")->default(true);
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
        Schema::dropIfExists('papers');
    }
};
