<?php
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'aliasgr216@gmail.com')->first();

        if (!$user) {

        User::create([

         'name'=> 'Ali Asghar',
         'email'=> 'aliasgr216@gmail.com',
         'role'=> 'admin',
         'password'=> Hash::make('aliasghar') // oooper path den password k liy

        ]);

        }
    }
}
