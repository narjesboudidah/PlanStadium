<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        DB::table('users')->delete();
        
        DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'email_verified_at' => NULL,
                'password' =>  bcrypt('password'),
                'remember_token' => Null,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'plateform_app' => NULL,
                'notify_token' => NULL,
                'firstname' => NULL,
                'lastname' => NULL,
                'phone' => NULL,
                'birth_date' => NULL,
                'state' => NULL,
                'country' => NULL,
                'level' => NULL,
                'etoiles' => NULL,
                'badge' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'ben zouari intissar',
                'email' => 'ben.zouari.intissar@gmail.com',
                'email_verified_at' => NULL,
                'password' => bcrypt('123456'),
                'remember_token' => NULL,
                'created_at' => '2021-03-16 15:07:42',
                'updated_at' => '2021-04-01 13:29:01',
                'deleted_at' => NULL,
                'plateform_app' => 'android',
                'notify_token' => 'null',
                'firstname' => 'intissar',
                'lastname' => 'ben zouari',
                'phone' => NULL,
                'birth_date' => '1989-07-20',
                'state' => NULL,
                'country' => NULL,
                'level' => NULL,
                'etoiles' => 20,
                'badge' => NULL,
            ),

        ));
        
        
    }
}