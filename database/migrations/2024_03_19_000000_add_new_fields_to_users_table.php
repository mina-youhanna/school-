<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('full_name')->after('id');
            $table->string('phone')->nullable()->after('full_name');
            $table->string('whatsapp')->after('phone');
            $table->string('relative_phone')->after('whatsapp');
            $table->string('address')->after('relative_phone');
            $table->string('confession_father')->after('address');
            $table->date('dob')->after('confession_father');
            $table->enum('gender', ['ذكر', 'أنثى'])->after('dob');
            $table->enum('role', ['خادم', 'مخدوم'])->after('gender');
            $table->json('serving_classes')->nullable()->after('role');
            $table->string('my_class')->after('serving_classes');
            $table->boolean('is_deacon')->default(false)->after('my_class');
            $table->date('ordination_date')->nullable()->after('is_deacon');
            $table->string('ordination_bishop')->nullable()->after('ordination_date');
            $table->string('deacon_rank')->nullable()->after('ordination_bishop');
            $table->string('code')->unique()->after('deacon_rank');
            $table->string('profile_image')->nullable()->after('code');
            
            // حذف العمود القديم
            $table->dropColumn('name');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name')->after('id');
            
            $table->dropColumn([
                'full_name',
                'phone',
                'whatsapp',
                'relative_phone',
                'address',
                'confession_father',
                'dob',
                'gender',
                'role',
                'serving_classes',
                'my_class',
                'is_deacon',
                'ordination_date',
                'ordination_bishop',
                'deacon_rank',
                'code',
                'profile_image'
            ]);
        });
    }
}; 