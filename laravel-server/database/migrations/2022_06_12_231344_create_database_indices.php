<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatabaseIndices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table('users', function (Blueprint $table) {
            $table->index('email');
            $table->index('role_name');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->index('product_name');
            $table->index('category_id');
        });

        Schema::table('likes', function (Blueprint $table) {
            $table->index('user_id');
            $table->index('product_id');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->index('category_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
    }
}
