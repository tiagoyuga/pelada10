<?php
/**
 * @package    Seeder
 * @author     Rupert Brasil Lustosa <rupertlustosa@gmail.com>
 * @date       05/02/2021 21:38:30
 */

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $itens = [];

        foreach ($itens as $item) {

            \App\Models\User::create($item);
        }
    }
}
		