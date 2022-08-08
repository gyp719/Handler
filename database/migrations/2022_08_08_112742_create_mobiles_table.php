<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Jialeo\LaravelSchemaExtend\Schema;
use App\Models\Mobile;

class CreateMobilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobiles', function (Blueprint $table) {
            $table->comment = '手机号';
            $table->id();
            $table->string('type')->default(Mobile::TYPE_RANDOM)->comment('类型');
            $table->string('mobile')->comment('手机号');
            $table->integer('send_number')->default(0)->comment('发送次数');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mobiles');
    }
}
