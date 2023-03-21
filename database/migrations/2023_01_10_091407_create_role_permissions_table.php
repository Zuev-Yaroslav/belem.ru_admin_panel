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
        Schema::create('role_permissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id')->nullable();
            $table->unsignedBigInteger('permission_id')->nullable();
            $table->timestamps();

            $table->index('role_id', 'role_permission_role_idx');
            $table->index('permission_id', 'role_permission_permission_idx');

            $table->foreign('role_id', 'role_permission_role_fk')->on('roles')->references('id');
            $table->foreign('permission_id', 'role_permission_permission_fk')->on('permissions')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_permissions');
    }
};
