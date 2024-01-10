<?php
/**
 * @package    Controller
 * @author     Tiago Teixeira de Sousa <tiagoteixeira2214@gmail.com>
 * @date       27/04/2021 01:27:44
 */

declare(strict_types=1);

namespace App\Models;

use App\Traits\CreationDataTrait;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
class PlayersListDay extends Model
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
    protected $table = 'players_list_day';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'games_day_id',
        'user_id',
        'order',
        'active',
        'goals',
        'payment',
        'user_creator_id',
        'user_updater_id',
        'user_eraser_id',
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    /*protected $guarded = [
        'games_day_id',
        'user_id',
        'order',
        'active',
        'goals',
        'payment',
        'user_creator_id',
        'user_updater_id',
        'user_eraser_id',
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
}
