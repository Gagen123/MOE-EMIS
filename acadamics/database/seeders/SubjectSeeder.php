<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('aca_subject')->insert([
            //science subject for class IX, X, XI and XII
            [
                'id' => '3ce9cdb1-b8c9-11eb-b80d-b07b2586b8c6',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_group_id' => 'de4c45a0-b8c7-11eb-b80d-b07b2586b8c6',
                'name' => 'Physics',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'1',
                'status' => '1',
                'created_by' => 'd77d1e56-2b24-4b16-bc18-2b947d62018f',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => '7b5a4b19-b8c9-11eb-b80d-b07b2586b8c6',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_group_id' => 'de4c45a0-b8c7-11eb-b80d-b07b2586b8c6',
                'name' => 'Chemistry',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'2',
                'status' => '1',
                'created_by' => 'd77d1e56-2b24-4b16-bc18-2b947d62018f',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 'e8600895-b8c9-11eb-b80d-b07b2586b8c6',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_group_id' => 'de4c45a0-b8c7-11eb-b80d-b07b2586b8c6',
                'name' => 'Biology',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'3',
                'status' => '1',
                'created_by' => 'd77d1e56-2b24-4b16-bc18-2b947d62018f',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => '0bc3a3dc-b8ca-11eb-b80d-b07b2586b8c6',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_group_id' => 'de4c45a0-b8c7-11eb-b80d-b07b2586b8c6',
                'name' => 'Mathematics II',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'4',
                'status' => '1',
                'created_by' => 'd77d1e56-2b24-4b16-bc18-2b947d62018f',
                'created_at' => Carbon::now(),
            ],
            //English Subject for class IX, X, XI and XII
            [
                'id' => '72a65ede-b8ca-11eb-b80d-b07b2586b8c6',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_group_id' => 'ec56c881-b8c7-11eb-b80d-b07b2586b8c6',
                'name' => 'English I',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'5',
                'status' => '1',
                'created_by' => 'd77d1e56-2b24-4b16-bc18-2b947d62018f',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => '9f37c505-b8ca-11eb-b80d-b07b2586b8c6',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_group_id' => 'ec56c881-b8c7-11eb-b80d-b07b2586b8c6',
                'name' => 'English II',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'6',
                'status' => '1',
                'created_by' => 'd77d1e56-2b24-4b16-bc18-2b947d62018f',
                'created_at' => Carbon::now(),
            ],
            //Dzongkha subject for class IX, X, XI and XII
            [
                'id' => '01a8a4f5-b8cb-11eb-b80d-b07b2586b8c6',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_group_id' => 'f4610935-b8c7-11eb-b80d-b07b2586b8c6',
                'name' => 'Dzongkha I',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'7',
                'status' => '1',
                'created_by' => 'd77d1e56-2b24-4b16-bc18-2b947d62018f',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => '2cbfa8b5-b8cb-11eb-b80d-b07b2586b8c6',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_group_id' => 'f4610935-b8c7-11eb-b80d-b07b2586b8c6',
                'name' => 'Dzongkha II',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'8',
                'status' => '1',
                'created_by' => 'd77d1e56-2b24-4b16-bc18-2b947d62018f',
                'created_at' => Carbon::now(),
            ],
            // science subject 
            [
                'id' => 'c00d93b6-b8cb-11eb-b80d-b07b2586b8c6',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_group_id' => null,
                'name' => 'Science',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'9',
                'status' => '1',
                'created_by' => 'd77d1e56-2b24-4b16-bc18-2b947d62018f',
                'created_at' => Carbon::now(),
            ],

            // maths subject

            [
                'id' => 'e11febf6-b8cb-11eb-b80d-b07b2586b8c6',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_group_id' => null,
                'name' => 'Mathematics I',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'10',
                'status' => '1',
                'created_by' => 'd77d1e56-2b24-4b16-bc18-2b947d62018f',
                'created_at' => Carbon::now(),
            ],
            //English subject
            [
                'id' => '04956ce3-b8cc-11eb-b80d-b07b2586b8c6',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_group_id' => null,
                'name' => 'English',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'11',
                'status' => '1',
                'created_by' => 'd77d1e56-2b24-4b16-bc18-2b947d62018f',
                'created_at' => Carbon::now(),
            ],
            //Dzongkha subject

            [
                'id' => '19979f9d-b8cc-11eb-b80d-b07b2586b8c6',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_group_id' => null,
                'name' => 'Dzongkha',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'12',
                'status' => '1',
                'created_by' => 'd77d1e56-2b24-4b16-bc18-2b947d62018f',
                'created_at' => Carbon::now(),
            ],

            //Personal Characteristics 

            [
                'id' => 'bbf1c5d8-b8d2-11eb-b80d-b07b2586b8c6',
                'aca_sub_category_id' => 'b8d29a44-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_group_id' => null,
                'name' => 'Personal Characteristics',
                'assessed_by_class_teacher' => '1',
                'display_order'=>'13',
                'status' => '1',
                'created_by' => 'd77d1e56-2b24-4b16-bc18-2b947d62018f',
                'created_at' => Carbon::now(),
            ],

           
           
        ]);
    }
}
