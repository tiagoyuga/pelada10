<?php
/**
 * @package    Controller
 * @author     Tiago Teixeira de Sousa <tiagoteixeira2214@gmail.com>
 * @date       05/03/2021 03:01:12
 */

declare(strict_types=1);

namespace App\Models;

use App\Traits\CreationDataTrait;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
class EventsUser extends Model
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
    protected $table = 'events_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'event_id',
        'is_admin',
        'owner_id',
        'updated_user_id',
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
        'user_id',
        'event_id',
        'is_admin',
        'owner_id',
        'updated_user_id',
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

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id', 'id');
    }

    public function config()
    {
        return $this->belongsTo(Configuration::class, 'event_id', 'event_id');
    }
}
