<?php
/**
 * @package    Controller
 * @author     Tiago Teixeira de Sousa <tiagoteixeira2214@gmail.com>
 * @date       09/03/2021 02:54:27
 */

declare(strict_types=1);

namespace App\Models;

use App\Traits\CreationDataTrait;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class GamesDay extends Model
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
    protected $table = 'games_days';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'event_id',
        'game_day',
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
        'event_id',
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
    protected $dates = ['game_day'];

    # Query Scopes

    # Relationships

    # Accessors & Mutators
}
