<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnInstituteFollowupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('institute_followups', function (Blueprint $table) {
            $table->date('coe_receiving_date')->nullable()->after('course_name');
            $table->date('coe_applied_date')->nullable()->after('coe_receiving_date');
            $table->boolean('is_sent')->nullable()->after('coe_applied_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('institute_followups', function (Blueprint $table) {
            $table->dropColumn('coe_receiving_date');
            $table->dropColumn('coe_applied_date');
            $table->dropColumn('is_sent');
        });
    }
}
