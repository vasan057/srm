<?php

use Illuminate\Database\Seeder;
use App\Model\FacultyType;
class FacultyTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type = FacultyType::insert([
         [   'type_name'=>'admin',
            'description'=>'access all pages',
            'created_at' => date('Y-m-d')
        ],
        [
            'type_name' => 'manager',
            'description'=>'minimized access',
            'created_at' => date('Y-m-d')
        ],
        [
            'type_name' => 'desk operator',
            'description' => 'update students records',
            'created_at' => date('Y-m-d')
        ]
        ]);

    }
}
