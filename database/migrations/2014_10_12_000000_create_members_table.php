<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();

            // business profile
            $table->string('business_name');
            $table->enum('business_category', ['kuliner kering', 'kuliner basah', 'fashion', 'jasa', 'craft', 'drink', 'beauty', 'furniture']);
            $table->string('business_duration');
            $table->string('owner_name');
            $table->string('email');
            $table->string('phone_number');

            // business location
            $table->string('province');
            $table->string('city');
            $table->string('sub_district');
            $table->string('village');

            // documentation
            $table->string('id_card_number')->nullable();
            $table->string('id_card_photo')->nullable();
            $table->string('id_card_selfie')->nullable();
            // $table->string('product_photo');

            // bank acoount
            $table->string('bank_name')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('bank_holders_name')->nullable();

            // business cluster
            $table->boolean('legality')->default(false);
            $table->string('nib_license')->nullable();
            $table->string('halal_license')->nullable();
            $table->string('pirt_license')->nullable();
            $table->string('bpom_license')->nullable();
            $table->string('hki_license')->nullable();
            $table->string('nutrition_test_license')->nullable();
            $table->string('haccp_license')->nullable();

            // token
            // $table->string()

            // role
            $table->enum('role', ['admin', 'user'])->default('user');
            // $table->enum('registration_status', [
            //     'start',
            //     'asking_business_name',
            //     'asking_business_category',
            //     'asking_business_duration',
            //     'asking_owner_name',
            //     'asking_email',
            //     'asking_phone',
            //     'asking_province',
            //     'asking_city',
            //     'asking_sub_district',
            //     'asking_village',
            //     'asking_id_card_number',
            //     'asking_id_card_photo',
            //     'asking_id_card_selfie',
            //     'asking_product_photo',
            //     'asking_bank_name',
            //     'asking_bank_account_number',
            //     'asking_bank_holders_name',
            //     'asking_legality',
            //     'asking_nib_license',
            //     'asking_halal_license',
            //     'asking_pirt_license',
            //     'asking_bpom_license',
            //     'asking_hki_license',
            //     'asking_nutrition_test_license',
            //     'asking_haccp_license',
            //     'verification',
            //     'complete'
            // ])->default('start');
            // $table->boolean('message_sent')->default(false);
            // $table->boolean('request_activation')->default(false);
            // $table->string('payment_proof')->default('');
            // $table->boolean('request_verification')->default(false);
            // $table->string('verification');
            // $table->string('qr_code_path');
            // $table->boolean('is_verified')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
