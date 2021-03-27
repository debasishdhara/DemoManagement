<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_details', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('course_check')->comment('1=>false,2=>true')->default(1)->nullable();
            $table->tinyInteger('category')->comment('1=>All,2=>General,3=>SC,4=>ST,5=>OBC')->nullable();
            $table->tinyInteger('education')->comment('1=>10th Pass,2=>12th Pass,3=>Diploma,4=>Post Graduation,5=>Graduation,6=>Masters')->nullable();
            $table->tinyInteger('gender')->comment('1=>Any,2=>Male,3=>Female')->nullable();
            $table->date('interview_date')->nullable();
            $table->longText('job_description')->nullable();
            $table->string('job_location')->nullable();
            $table->string('job_title')->nullable();
            $table->bigInteger('maxage')->nullable();
            $table->bigInteger('minage')->nullable();
            $table->bigInteger('minexp')->nullable();
            $table->bigInteger('opening_number')->nullable();
            $table->string('organizationname')->nullable();
            $table->bigInteger('percentage')->nullable();
            $table->tinyInteger('physicalcheck')->comment('1=>Any,2=>PWD,3=>Non PWD')->nullable();
            $table->bigInteger('position')->nullable();
            $table->tinyInteger('salary_range')->comment('1=> Below 50000,2=> 50000-60000,3=> 60000-70000,4=> 70000-80000,5=> 90000-100000,6=> 100000-120000')->nullable();
            $table->longText('servicetirm')->nullable();
            $table->string('url')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->engine = 'Innodb';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_details');
    }
}
