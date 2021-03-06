<?php
/**
 * @package    Seeder
 * @author     Tiago Teixeira de Sousa <tiagoteixeira2214@gmail.com>
 * @date       27/02/2021 03:49:31
 */

use Illuminate\Database\Seeder;

class ConfigurationSeeder extends Seeder
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

            \App\Models\Configuration::create($item);
        }
    }
}
		