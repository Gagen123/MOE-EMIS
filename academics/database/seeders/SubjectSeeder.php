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

            //Environment Studies subject
            [
                'id' => '029773c2-cef4-11eb-8c53-e89eb413ce43',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'Environment Studies',
                'dzo_name'=> '',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'4',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],
            //HPE subject is Compulsory but not Graded
            [
                'id' => '3f846f32-cef5-11eb-8c53-e89eb413ce43',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'HPE',
                'dzo_name'=> '',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'5',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],

            //Moral/Values/Civic/Buddist Education subject is Compulsory but not Graded
            [
                'id' => '9b864903-cef5-11eb-8c53-e89eb413ce43',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'Moral/Values/Civic/Buddist Education',
                'dzo_name'=> '',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'6',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],

             //Arts subject is Compulsory but not Graded
             [
                'id' => '059f0cc6-cef6-11eb-8c53-e89eb413ce43',
                'aca_sub_category_id' => 'b8d29a44-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'Arts',
                'dzo_name'=> '',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'7',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],

            //Music subject is Compulsory but not Graded
            [
                'id' => 'e2caf47d-d02b-11eb-a9e6-e89eb413ce43',
                'aca_sub_category_id' => 'b8d29a44-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'Music',
                'dzo_name'=> '',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'8',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],
            // ICT subject is Compulsory but not Graded
            [
                'id' => '75eedb73-cef6-11eb-8c53-e89eb413ce43',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'ICT',
                'dzo_name'=> '',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'9',
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
                'display_order'=>'10',
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
                'display_order'=>'11',
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
                'display_order'=>'12',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],

            //History and Civics subject
            [
                'id' => '0bc3a3dc-b8ca-11eb-b80d-b07b2586b8c6',
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
          
             //Visual Arts 
             [
                'id' => '91ca4ff8-cef7-11eb-8c53-e89eb413ce43',
                'aca_sub_category_id' => 'b8d29a44-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'Visual Arts',
                'dzo_name'=> '',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'14',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],

            // TVET Orientation subject
            [
                'id' => '0a734b20-cef8-11eb-8c53-e89eb413ce43',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'TVET Orientation',
                'dzo_name'=> '',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'15',
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
                'display_order'=>'16',
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
                'display_order'=>'17',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],

            // International Languages Subjects 
            [
                'id' => '2fdced1d-cef9-11eb-8c53-e89eb413ce43',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'International Languages',
                'dzo_name'=> '',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'18',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],

            // Environmental Science Subjects 
            [
                'id' => '7002696b-cef9-11eb-8c53-e89eb413ce43',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'Environmental Science',
                'dzo_name'=> '',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'19',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],

            // Buddhiest Studies Subjects 
            [
                'id' => '9357dc91-cef9-11eb-8c53-e89eb413ce43',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'Buddhist Studies',
                'dzo_name'=> '',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'20',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],

            //Law plus Subjects introduced from time to time as deemed necesarry
            [
                'id' => 'c553b2fd-cef9-11eb-8c53-e89eb413ce43',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'Law plus Subjects introduced from time to time as deemed necesarry',
                'dzo_name'=> '',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'21',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],

             //English/Khordey Lam Sum 
             [
                'id' => 'ebdf7030-cef9-11eb-8c53-e89eb413ce43',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'English/Khordey Lam Sum',
                'dzo_name'=> '',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'22',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],

            //Ngagdroen 
            [
                'id' => '1682377e-cefa-11eb-8c53-e89eb413ce43',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'Ngagdroen',
                'dzo_name'=> '',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'23',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],
                 
            //Nyer-Khoi-Nam-Shed
            [
                'id' => '40647ac5-cefa-11eb-8c53-e89eb413ce43',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'Nyer-Khoi-Nam-Shed',
                'dzo_name'=> '',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'24',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],

            //Ka-Ned Selwai Melong under Rigzhung
            [
                'id' => 'edbe1880-cefa-11eb-8c53-e89eb413ce43',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'Ka-Ned Selwai Melong',
                'dzo_name'=> '',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'25',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],
            
            //Chenju
            [
                'id' => 'eba8a994-cefb-11eb-8c53-e89eb413ce43',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'Chenju',
                'dzo_name'=> '',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'26',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],

             //Sumtag
             [
                'id' => '036a7330-cefc-11eb-8c53-e89eb413ce43',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'Sumtag',
                'dzo_name'=> '',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'27',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],

            //Dajur
            [
                'id' => '1f0eec91-cefc-11eb-8c53-e89eb413ce43',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'Dajur',
                'dzo_name'=> '',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'28',
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
                'dzo_name'=> '',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'29',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],


            [
                'id' => '27fde268-cefb-11eb-8c53-e89eb413ce43',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'TVET Subjects',
                'dzo_name'=> '',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'30',
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
            // Science subject 
            [
                'id' => 'c00d93b6-b8cb-11eb-b80d-b07b2586b8c6',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'Science(Physics,Chemistry,Biology)',
                'dzo_name'=> '',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'31',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],

            // Business  Mathemetics subject

            [
                'id' => 'a5c26370-cefc-11eb-8c53-e89eb413ce43',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'Business  Mathemetics',
                'dzo_name'=> '',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'32',
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
                'display_order'=>'33',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],

            //Entrepreneurship Education
            [
                'id' => '0c7dacdb-cefd-11eb-8c53-e89eb413ce43',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'Entrepreneurship Education',
                'dzo_name'=> '',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'34',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],

             //Law
            [
                'id' => '3e54db87-cefd-11eb-8c53-e89eb413ce43',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => 'Law',
                'dzo_name'=> '',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'35',
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
                'dzo_name'=> '',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'36',
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
                'dzo_name'=> '',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'36',
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
                'dzo_name'=> '',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'38',
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
                'display_order'=>'39',
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
                'display_order'=>'40',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],

            // 2 subjects from a pool of TVE subjects
            [
                'id' => '4c534a62-cefe-11eb-8c53-e89eb413ce43',
                'aca_sub_category_id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_sub_id' => null,
                'name' => '2 subjects from a pool of TVE subjects',
                'dzo_name'=> '',
                'assessed_by_class_teacher' => '0',
                'display_order'=>'41',
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
                'display_order'=>'42',
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
                'display_order'=>'43',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],


           
           
        ]);
    }
}
