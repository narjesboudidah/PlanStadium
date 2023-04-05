<?php
namespace Database\Seeders;

use App\Models\User;
//use Dotenv\Util\Str;
use Illuminate\Support\Str;
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
        //User::factory(1)->create();


        /*  DB::table('users')->delete();

        DB::table('users')->insert(array (
        0 =>
        array (
        'id' => 1,
        'nom' => 'Admin',
        'prenom' => 'Admin',
        'telephone' => '66666666',
        'adresse' => 'Admin',
        'email' => 'admin@admin.com',
        'email_verified_at' => NULL,
        'password' => bcrypt('password'),
        'remember_token' => Null,
        'created_at' => NULL,
        'updated_at' => NULL,
        'deleted_at' => NULL,
        'notify_token' => NULL,
        ),
        1 =>
        array (
        'id' => 2,
        'nom' => 'Admin',
        'prenom' => 'equipe',
        'telephone' => '77777777',
        'adresse' => 'kairouan',
        'email' => 'admin.equipe@admin.com',
        'email_verified_at' => NULL,
        'password' =>  bcrypt('password'),
        'remember_token' => Null,
        'created_at' => NULL,
        'updated_at' => NULL,
        'deleted_at' => NULL,
        'notify_token' => NULL,
        ),
        2 =>
        array (
        'id' => 2,
        'nom' => 'Admin',
        'prenom' => 'ste',
        'telephone' => '77777888',
        'adresse' => 'kairouan',
        'email' => 'admin.ste@admin.com',
        'email_verified_at' => NULL,
        'password' =>  bcrypt('password'),
        'remember_token' => Null,
        'created_at' => NULL,
        'updated_at' => NULL,
        'deleted_at' => NULL,
        'notify_token' => NULL,
        ),
        /*1 =>
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
        ));**/

        User::create([
            'nom' => 'Balghouthi',
            'prenom' => 'Sirine',
            'telephone' => '29701966',
            'adresse' => 'kairouan',
            'email' => 'balghouthisirine90@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('sirine123#'),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => NULL,
            //'notify_token' => NULL,
        ]);
        User::create([
            'nom' => 'test',
            'prenom' => 'test',
            'telephone' => '29788966',
            'adresse' => 'kairouan',
            'email' => 'test@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('test123'),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => NULL,
            //'notify_token' => NULL,
        ]);

        User::create([
            'nom' => 'boudidah',
            'prenom' => 'narjes',
            'telephone' => '27223246',
            'adresse' => 'kairouan',
            'email' => 'narjes.boudidah.73@gmail.com',
            'email_verified_at' => NULL,
            'password' => bcrypt('boudidah'),
            'remember_token' => Null,
            'created_at' => NULL,
            'updated_at' => NULL,
            'deleted_at' => NULL,
            //'notify_token' => NULL,
        ]);
        User::create([
            'nom' => 'balghouthi',
            'prenom' => 'sirine',
            'telephone' => '28701966',
            'adresse' => 'kairouan',
            'email' => 'sirinebalghouthi59@gmail.com',
            'email_verified_at' => NULL,
            'password' => bcrypt('password'),
            'remember_token' => Null,
            'created_at' => NULL,
            'updated_at' => NULL,
            'deleted_at' => NULL,
            //'notify_token' => NULL,
        ]);

    }
}
