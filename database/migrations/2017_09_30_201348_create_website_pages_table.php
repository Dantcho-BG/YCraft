<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebsitePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('website_pages', function (Blueprint $table) {
            $table->increments('page_id');
            $table->string('page_slug');
            $table->string('page_title');
            $table->string('page_content')->default('text_module');
            $table->timestamps();
        });

        // Insert some stuff
        DB::table('website_pages')->insert(
            array(
                'page_title' => 'Home',
                'page_slug' => '/'
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
        Schema::dropIfExists('website_pages');
    }
}
