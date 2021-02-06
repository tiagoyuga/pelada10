<?php
/**
 * @package    Controller
 * @author     Rupert Brasil Lustosa <rupertlustosa@gmail.com>
 * @date       05/02/2021 21:38:30
 */

declare(strict_types=1);

namespace App\Models;

use App\Traits\CreationDataTrait;
use Illuminate\Database\Eloquent\Model;


class User extends Model
{


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
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'nickname',
        'shirt_number',
        'phone1',
        'phone2',
        'whatsapp',
        'image',
        'first_access',
        'active',
        'is_dev',
        'selected_event',
        'remember_token',
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    /*protected $guarded = [
        'name',
        'email',
        'password',
        'nickname',
        'shirt_number',
        'phone1',
        'phone2',
        'whatsapp',
        'image',
        'first_access',
        'active',
        'is_dev',
        'selected_event',
        'remember_token',
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
