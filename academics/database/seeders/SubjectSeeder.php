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

            //Dzongkha subject
            [
                'id' => '19979f9d-b8cc-11eb-b80d-b07b2586b8c6',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'Dzongkha',
                'dzo_name'=> 'རྫོང་ཁ།',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'1',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],

            //English subject
            [
                'id' => '04956ce3-b8cc-11eb-b80d-b07b2586b8c6',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'English',
                'dzo_name'=> '',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'2',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],

            //Mathematics subject
            [
                'id' => 'e11febf6-b8cb-11eb-b80d-b07b2586b8c6',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'Mathematics',
                'dzo_name'=> '',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'3',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],

            // Science subject 
            [
                'id' => 'c00d93b6-b8cb-11eb-b80d-b07b2586b8c6',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'Science',
                'dzo_name'=> '',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'4',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],

            // General Science subject 
            [
                'id' => '6a7a26d1-de97-11eb-9029-e89eb413ce43',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'General Science',
                'dzo_name'=> '',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'5',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],

            //Socail Studies
            [
                'id' => '2f733141-d029-11eb-a9e6-e89eb413ce43',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'Social Studies',
                'dzo_name'=> '',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'6',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],
            //History subject
            [
                'id' => '0bc3a3dc-b8ca-11eb-b80d-b07b2586b8c6',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'History',
                'dzo_name'=> '',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'7',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],

            //Geography subject
            [
                'id' => 'ec491ebe-de97-11eb-9029-e89eb413ce43',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'Geography',
                'dzo_name'=> '',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'8',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],

            // Science (Physics,Chemistry,Biology)
            [
                'id' => '9bb96ba6-de98-11eb-9029-e89eb413ce43',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'Science (Physics,Chemistry,Biology)',
                'dzo_name'=> '',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'9',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],
              //Commerce
              [
                'id' => 'b1204e8f-cefd-11eb-8c53-e89eb413ce43',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'Commerce',
                'dzo_name'=> '',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'10',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],

            //Accountancy
            [
                'id' => 'fd9b9ca3-cefd-11eb-8c53-e89eb413ce43',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'Accountancy',
                'dzo_name'=> '',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'11',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],

            //Business Mathematics
            [
                'id' => '470ed853-de9c-11eb-9029-e89eb413ce43',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'Business Mathematics',
                'dzo_name'=> '',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'12',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],

            // History and Civics
            [
                'id' => '7d7bcfc7-de99-11eb-9029-e89eb413ce43',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'History and Civics',
                'dzo_name'=> '',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'13',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],

            // Economics subject
            [
                'id' => '514070b5-cef8-11eb-8c53-e89eb413ce43',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'Economics',
                'dzo_name'=> '',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'14',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],

            //Business and Enterpreneurship
            [
                'id' => '9e60a1ef-de9c-11eb-9029-e89eb413ce43',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'Business and Enterpreneurship',
                'dzo_name'=> '',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'15',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],

            // Media Studies subject
            [
                'id' => '8d762e53-cef8-11eb-8c53-e89eb413ce43',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'Media Studies',
                'dzo_name'=> '',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'16',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],

            // TVET Orientation subject
            [
                'id' => '0a734b20-cef8-11eb-8c53-e89eb413ce43',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'Technical and Vocational Education Training',
                'dzo_name'=> '',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'17',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],

            //Environment Science subject
            [
                'id' => '029773c2-cef4-11eb-8c53-e89eb413ce43',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'Environment Science',
                'dzo_name'=> '',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'18',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],

            // Agriculture for Food Security
            [
                'id' => 'b1a51a08-de9b-11eb-9029-e89eb413ce43',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'Agriculture for Food Security',
                'dzo_name'=> '',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'19',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],

            //Commercial Studies
            [
                'id' => 'c14eddcc-de9b-11eb-9029-e89eb413ce43',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'Commercial Studies',
                'dzo_name'=> '',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'20',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],

            // ICT subject is Compulsory but not Graded
            [
                'id' => '75eedb73-cef6-11eb-8c53-e89eb413ce43',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'Information and Communication Technology',
                'dzo_name'=> '',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'21',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],

             //HPE subject is Compulsory but not Graded
             [
                'id' => '3f846f32-cef5-11eb-8c53-e89eb413ce43',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'Health and Physical Education',
                'dzo_name'=> '',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'22',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],

            //Values Education is Compulsory but not Graded
            [
                'id' => '9b864903-cef5-11eb-8c53-e89eb413ce43',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'Values Education',
                'dzo_name'=> '',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'23',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],

            //Arts Education is Compulsory but not Graded
            [
                'id' => '059f0cc6-cef6-11eb-8c53-e89eb413ce43',
                'aca_sub_category_id' => 'b8d29a44-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'Arts Education',
                'dzo_name'=> '',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'24',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],

            //science(Physics) subject
            [
                'id' => '3ce9cdb1-b8c9-11eb-b80d-b07b2586b8c6',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'Physics',
                'dzo_name'=> '',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'25',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],

            //science(Chemistry) subject
            [
                'id' => '7b5a4b19-b8c9-11eb-b80d-b07b2586b8c6',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'Chemistry',
                'dzo_name'=> '',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'26',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],

            //science(Biology) subject
            [
                'id' => 'e8600895-b8c9-11eb-b80d-b07b2586b8c6',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'Biology',
                'dzo_name'=> '',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'27',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],


            //English Subject for class IX, X, XI and XII
            [
                'id' => '72a65ede-b8ca-11eb-b80d-b07b2586b8c6',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => '04956ce3-b8cc-11eb-b80d-b07b2586b8c6',
                'name' => 'English I',
                'dzo_name'=> '',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'1',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => '9f37c505-b8ca-11eb-b80d-b07b2586b8c6',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => '04956ce3-b8cc-11eb-b80d-b07b2586b8c6',
                'name' => 'English II',
                'dzo_name'=> '',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'2',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],
            //Dzongkha subject for class IX, X, XI and XII
            [
                'id' => '01a8a4f5-b8cb-11eb-b80d-b07b2586b8c6',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => '19979f9d-b8cc-11eb-b80d-b07b2586b8c6',
                'name' => 'Dzongkha I',
                'dzo_name'=>'རྫོང་ཁ ༡ པ།',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'3',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => '2cbfa8b5-b8cb-11eb-b80d-b07b2586b8c6',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => '19979f9d-b8cc-11eb-b80d-b07b2586b8c6',
                'name' => 'Dzongkha II',
                'dzo_name'=>'རྫོང་ཁ ༢ པ།',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'4',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],

            //Rigzhung
            [
                'id' => 'd6d2410a-cefc-11eb-8c53-e89eb413ce43',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'Rigzhung',
                'dzo_name'=> '',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'28',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],


            //Personal Characteristics 

            [
                'id' => 'bbf1c5d8-b8d2-11eb-b80d-b07b2586b8c6',
                'aca_sub_category_id' => 'b8d29a44-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'Personal Characteristics',
                'dzo_name'=> '',
                'assessed_by_class_teacher' => '1',
                'display_order'=>'29',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],

        ]);
    }
}
