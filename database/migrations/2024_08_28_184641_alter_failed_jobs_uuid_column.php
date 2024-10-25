<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterFailedJobsUuidColumn extends Migration
{
    public function up()
    {
        Schema::table('failed_jobs', function (Blueprint $table) {
            $table->char('uuid', 36)->change();
        });
    }

    public function down()
    {
        Schema::table('failed_jobs', function (Blueprint $table) {
            // Revert the change if needed
            $table->string('uuid')->change();
        });
    }
}
