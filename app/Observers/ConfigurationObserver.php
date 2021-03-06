<?php
/**
 * @package    Observers
 * @author     Tiago Teixeira de Sousa <tiagoteixeira2214@gmail.com>
 * @date       27/02/2021 03:49:31
 */

declare(strict_types=1);

namespace App\Observers;

use App\Models\Configuration;

class ConfigurationObserver
{

    /**
     * Handle the configuration "creating" event.
     *
     * @param  \App\Models\Configuration  $configuration
     * @return void
     */
    public function creating(Configuration $configuration)
    {

        $configuration->user_creator_id = \Auth::id();
        //$configuration->user_updater_id = \Auth::id();
    }


    /**
     * Handle the configuration "updating" event.
     *
     * @param  \App\Models\Configuration  $configuration
     * @return void
     */
    public function updating(Configuration $configuration)
    {

        $configuration->user_updater_id = \Auth::id();
    }


    /**
     * Handle the configuration "deleting" event.
     *
     * @param  \App\Models\Configuration  $configuration
     * @return void
     */
    public function deleting(Configuration $configuration)
    {

        $configuration->user_eraser_id = \Auth::id();
        $configuration->timestamps = false;
        $configuration->save();
    }
}
