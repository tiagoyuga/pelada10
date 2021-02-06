<?php
/**
 * @package    Seeder
 * @author     Tiago Teixeira de Sousa <tiagoteixeira2214@gmail.com>
 * @date       05/02/2021 21:38:30
 */

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Schema::disableForeignKeyConstraints();

        $table = 'users';

        if ('pgsql' == \DB::connection()->getConfig('driver'))
            \DB::statement('TRUNCATE TABLE ' . $table . ' CASCADE;');
        else \DB::table($table)->truncate();

        $users = array(
            array(
                'id' => '1',
                'name' => 'TIAGO TEIXEIRA',
                'email' => 'tiagoteixeira2214@gmail.com',
                'email_verified_at' => NULL,
                'nickname' => 'Tiago Yuga',
                'shirt_number' => '80',
                'phone1' => '86994259624',
                'phone2' => '86981390951',
                'whatsapp' => '86994259624',
                'image' => '',
                #'login' => 'tiagoteixeira2214@gmail.com',
                #'password' => Hash::make('12345678'),
                'birth' => '1994-05-04',
                'first_access' => '1',
                'active' => '1',
                'is_dev' => '1',
                'selected_event' => NULL,
            ),
        );

        $password = \Hash::make('123456');

        foreach ($users as $item) {
            $item['password'] = $password;

            User::create($item);
        }

        \Schema::enableForeignKeyConstraints();
    }
}
