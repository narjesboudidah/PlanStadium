<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class UserSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
       // societe_maintenances::truncate(); //is used to delete all the records from a database table and reset the auto-incrementing ID to 1.
        
        User::create([
            'nom'=>'sirine',
            'prenom'=>'balghouthi',
            'telephone'=>'29701966',
            'email'=>'sirine@gmail.com',
            'adresse'=>'xxxxxx',
            'password'=>'123',
        ]);
        User::create([
            'nom'=>'narjes',
            'prenom'=>'boudidah',
            'telephone'=>'77777777',
            'email'=>'narjes@gmail.com',
            'adresse'=>'xxxxxxxx',
            'password'=>'321',
        ]);
    }
}