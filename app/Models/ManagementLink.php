<?php
/**
 * @package    Controller
 * @author     Tiago Teixeira de Sousa <tiagoteixeira2214@gmail.com>
 * @date       22/07/2019 19:52:03
 */

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ManagementLink extends Model
{
    use SoftDeletes;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'management_links';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'owner_user_id',
        'user_id',
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    /*protected $guarded = [
        'uid',
        'name',
    ];*/

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $hidden = [];

    /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [];

    # Query Scopes

    # Relationships

    # Accessors & Mutators

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
