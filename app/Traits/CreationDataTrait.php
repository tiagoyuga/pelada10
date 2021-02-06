<?php

namespace App\Traits;

use App\Models\User;

trait CreationDataTrait
{

    public function creator()
    {

        return $this->belongsTo(User::class, 'user_creator_id')->select('id', 'name');
    }

    public function updater()
    {

        return $this->belongsTo(User::class, 'user_updater_id')->select('id', 'name');
    }

    public function creationData()
    {
        $info = [];

        if ($this->user_creator_id) {

            $info[] = 'Criado por ' . $this->creator->name . ' em ' . $this->created_at->format('d/m/Y H:i');
        }

        if ($this->user_updater_id) {

            $info[] = 'Atualizado por ' . $this->updater->name . ' em ' . $this->updated_at->format('d/m/Y H:i');
        }

        return $info;
    }
}
