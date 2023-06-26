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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('cat_id')->nullable();
            $table->unsignedBigInteger('sub_cat_id')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('depot_id');
            $table->string('title');
            $table->longText('notes')->nullable();
            $table->double('price');
            $table->double('qty')->nullable();
            $table->double('allowed_qty')->nullable();
            $table->string('file')->nullable();
            $table->enum('status', ['new', 'used', 'expired']);
            $table->boolean('deleted')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
