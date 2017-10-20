<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebsiteSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('website_settings', function (Blueprint $table) {
            $table->increments('setting_id');
            $table->string('setting_name');
            $table->string('setting_value');
            $table->timestamps();
        });
        
        // Insert some stuff
        DB::table('website_settings')->insert(
            array(
                'setting_name' => 'pages_amount',
                'setting_value' => '1'
            )
        );
    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('website_settings');
    }
}
