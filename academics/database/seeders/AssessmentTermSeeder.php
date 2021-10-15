<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssessmentTermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::statement("INSERT INTO `aca_assessment_term` (`id`, `aca_assmt_frequency_id`, `term_number`, `name`, `dzo_name`, `display_text`, `from_month`, `to_month`, `from_date`, `to_date`, `display_order`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
            ('0147ff87-b8c1-11eb-b80d-b07b2586b8c6', 'e3cc5557-b8c0-11eb-b80d-b07b2586b8c6', 1, 'First Term', 'སློབ་དུས་ ༡ པ།', '', 2, 6, 1, 15, 1, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-10-04 10:13:47', NULL),
            ('5f1bf047-b8c1-11eb-b80d-b07b2586b8c6', 'e3cc5557-b8c0-11eb-b80d-b07b2586b8c6', 2, 'Second Term', 'སློབ་དུས་ ༢ པ།', '', 7, 12, 1, 30, 2, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-10-04 10:13:47', NULL),
            ('7d662b7d-b8c1-11eb-b80d-b07b2586b8c6', 'c5815af7-b8c0-11eb-b80d-b07b2586b8c6', 1, 'Quarter I', 'བཞི་དཔྱ་ ༡ པ།', 'February - Mid April', 2, 4, 1, 15, 1, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-10-04 10:13:47', NULL),
            ('a3e65b7b-b8c1-11eb-b80d-b07b2586b8c6', 'c5815af7-b8c0-11eb-b80d-b07b2586b8c6', 2, 'Quarter II', 'བཞི་དཔྱ་ ༢ པ།', 'Mid April - June', 4, 6, 16, 30, 2, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-10-04 10:13:47', NULL),
            ('c6e9a293-b8c1-11eb-b80d-b07b2586b8c6', 'c5815af7-b8c0-11eb-b80d-b07b2586b8c6', 3, 'Quarter III', 'བཞི་དཔྱ་ ༣ པ།', 'July - Mid October', 7, 10, 1, 15, 3, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-10-04 10:13:47', NULL),
            ('e8274e75-b8c1-11eb-b80d-b07b2586b8c6', 'c5815af7-b8c0-11eb-b80d-b07b2586b8c6', 4, 'Quarter IV', 'བཞི་དཔྱ་ ༤ པ།', 'Mid October - December', 10, 12, 16, 30, 4, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-10-04 10:13:47', NULL)
       ");
    }
}
