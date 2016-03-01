<?php namespace Algad\Bootstrap\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAlgadBootstrapEvents extends Migration
{
    public function up()
    {
        Schema::table('algad_bootstrap_events', function($table)
        {
            $table->string('slug')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('algad_bootstrap_events', function($table)
        {
            $table->dropColumn('slug');
        });
    }
}
