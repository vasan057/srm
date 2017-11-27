<?php

use Illuminate\Database\Seeder;
use App\Model\Faculty;
class FacultyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faculty = new Faculty;
        $faculty->staff_id = 'admin';
        $faculty->password = bcrypt('123');
        $faculty->first_name = 'admin';
        $faculty->email_id = 'boopal@dexelsolutions.com';
        $faculty->faculty_type = '1';
        $faculty->flag = 1;
        $faculty->save();
    }
}
