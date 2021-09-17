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
                'code' => '',
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
                'code' => '',
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
                'code' => '',
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
                'code' => '',
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
                'code' => '',
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
                'code' => '',
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
                'code' => '',
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
                'code' => '',
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
                'code' => '',
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
                'code' => '',
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
                'code' => '',
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
                'code' => '',
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
                'code' => '',
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
                'code' => '',
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
                'code' => '',
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
                'code' => '',
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
                'code' => '',
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
                'code' => '',
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
                'code' => '',
                'dzo_name'=> '',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'19',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],

            // Commercial Studies 
            [
                'id' => 'c14eddcc-de9b-11eb-9029-e89eb413ce43',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'Commercial Studies',
                'code' => '',
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
                'code' => '',
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
                'aca_sub_category_id' => 'b8d29a44-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'Health and Physical Education',
                'code' => '',
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
                'aca_sub_category_id' => 'b8d29a44-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'Values Education',
                'code' => '',
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
                'code' => '',
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
                'code' => '',
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
                'code' => '',
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
                'code' => '',
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
                'code' => '',
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
                'code' => '',
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
                'code' => '',
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
                'code' => '',
                'dzo_name'=>'རྫོང་ཁ ༢ པ།',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'4',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],

            //Rigzhung Elective 
            [
                'id' => 'd6d2410a-cefc-11eb-8c53-e89eb413ce43',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'Rigzhung',
                'code' => '',
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
                'code' => '',
                'dzo_name'=> '',
                'assessed_by_class_teacher' => '1',
                'display_order'=>'29',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],

             //Lekshe Jon Wang
             [
                'id' => '619fe69a-dec1-11eb-9029-e89eb413ce43',
                'aca_sub_category_id' => 'b8d29a44-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'Lekshe Jon Wang',
                'code' => '',
                'dzo_name'=> 'ལེགས་བཤད་ལྗོན་དབང་།',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'30',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],
             //Ngadroen
             [
                'id' => '7d36c907-dec1-11eb-9029-e89eb413ce43',
                'aca_sub_category_id' => 'b8d29a44-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'Ngadroen',
                'code' => '',
                'dzo_name'=> 'ངག་སྒྲོན།',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'31',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],
            
             //Chu Dang Shing Gi Ten chey
             [
                'id' => '772478db-dec6-11eb-9029-e89eb413ce43',
                'aca_sub_category_id' => 'b8d29a44-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'Chu Dang Shing Gi Ten chey',
                'code' => '',
                'dzo_name'=> 'ཆུ་དང་ཤིང་གི་བསྟན་བཅོས།',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'32',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],

            //Nyen-ngag
            [
                'id' => '41f56c70-cefc-11eb-8c53-e89eb413ce43',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'Nyen-ngag',
                'code' => '',
                'dzo_name'=> 'སྙན་ངག།',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'33',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],

            //Nencha
            [
                'id' => '5d35b1ef-d02c-11eb-a9e6-e89eb413ce43',
                'aca_sub_category_id' => 'b8d29a44-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'Nencha',
                'code' => '',
                'dzo_name'=> 'སྙན་ཆ།',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'34',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],

            // Tsi
            [
                'id' => '7d7f112a-cefd-11eb-8c53-e89eb413ce43',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'Tsi',
                'code' => '',
                'dzo_name'=> 'སྩིས།',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'35',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],


             //Lhari
             [
                'id' => 'b01d3198-dec6-11eb-9029-e89eb413ce43',
                'aca_sub_category_id' => 'b8d29a44-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'Lhari',
                'code' => '',
                'dzo_name'=> '',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'36',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],

             //Ngon Ja
            [
                'id' => '69a4c327-decb-11eb-9029-e89eb413ce43',
                'aca_sub_category_id' => 'b8d29a44-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'Ngon Ja',
                'code' => '',
                'dzo_name'=> 'མངོན་བརྗོད།',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'37',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],

            //Sumtag Didom
            [
                'id' => 'e87ba5db-dec9-11eb-9029-e89eb413ce43',
                'aca_sub_category_id' => 'b8d29a44-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'Sumtag Didom',
                'code' => '',
                'dzo_name'=> 'སུམ་རྟགས་སྡུད་སྡོམ།',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'38',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],

            //Gyalrab 
            [
                'id' => '58994546-cefd-11eb-8c53-e89eb413ce43',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'Gyalrab',
                'code' => '',
                'dzo_name'=> 'རྒྱལ་རབས།',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'39',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],
           
            //Chenju
            [
                'id' => '30c668c2-decc-11eb-9029-e89eb413ce43',
                'aca_sub_category_id' => 'b8d29a44-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'Chenju',
                'code' => '',
                'dzo_name'=> 'སྤྱོད་འཇུག།',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'40',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],

            //Ngadroen Sumtag
            [
                'id' => '9dd9405d-decc-11eb-9029-e89eb413ce43',
                'aca_sub_category_id' => 'b8d29a44-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'Ngadroen Sumtag',
                'code' => '',
                'dzo_name'=> 'ངག་སྒྲོན་སུམ་རྟགས།',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'41',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],

            // Jungrab
            [
                'id' => 'f6e28e34-decc-11eb-9029-e89eb413ce43',
                'aca_sub_category_id' => 'b8d29a44-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'Jungrab',
                'code' => '',
                'dzo_name'=> 'འབྱུང་རབས།',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'42',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],

              // Ngadroen Dang Tagijupa
            [
                'id' => '67ef35a1-decd-11eb-9029-e89eb413ce43',
                'aca_sub_category_id' => 'b8d29a44-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'Ngadroen Dang Tagijupa',
                'code' => '',
                'dzo_name'=> 'ངག་སྒྲོན་དང་རྟགས་ཀྱི་འཇུག་པ།',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'43',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],
            // Dreklam
            [
                'id' => '86a6dcc7-e0ab-11eb-bd8c-e89eb413ce43',
                'aca_sub_category_id' => 'b8d29a44-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'Dreklam',
                'code' => '',
                'dzo_name'=> 'སྒྲིག་ལམ།',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'44',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],
           

        ]);
    }
}
