<?php namespace Algad\Bootstrap\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateAlgadBootstrapEvents extends Migration
{
    public function up()
    {
        Schema::create('algad_bootstrap_events', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->dateTime('date');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('algad_bootstrap_events');
    }
}
