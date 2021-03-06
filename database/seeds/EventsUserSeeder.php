<?php
/**
 * @package    Seeder
 * @author     Tiago Teixeira de Sousa <tiagoteixeira2214@gmail.com>
 * @date       05/03/2021 03:01:12
 */

use Illuminate\Database\Seeder;

class EventsUserSeeder extends Seeder
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

            \App\Models\EventsUser::create($item);
        }
    }
}
		