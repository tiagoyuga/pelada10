<?php
/**
 * @package    Controller
 * @author     Tiago Teixeira de Sousa <tiagoteixeira2214@gmail.com>
 * @date       05/02/2021 21:38:30
 */

declare(strict_types=1);

namespace App\Models;

#use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Collection;


#class User extends Model
class User extends Authenticatable
{

    use Notifiable, SoftDeletes;

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
        'birth',
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

    protected $hidden = ['password', 'remember_token',];

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
    protected $dates = ['birth'];

    # Query Scopes

    # Relationships

    # Accessors & Mutators

    public function canAuthInPanel()
    {
        return collect(['1', '2']);
    }

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

        if ($this->created_at != $this->updated_at && $this->user_updater_id) {

            $info[] = 'Atualizado por ' . $this->updater->name . ' em ' . $this->updated_at->format('d/m/Y H:i');
        }

        return $info;
    }

    #evento selecionado
    public function selectedEvent()
    {
        return $this->belongsTo(Event::class, 'selected_event', 'id');
    }

    #todas os eventos que o usuário participa
    public function eventsUser()
    {
        #return $this->hasOne(EventsUser::class, 'event_id', 'selected_event');
        return $this->belongsTo(EventsUser::class, 'id', 'user_id');
    }

    #lista com todos os eventos que o usuário participa
    public function eventsList()
    {
        $eventsUser = $this->eventsUser()->get();
        foreach ($eventsUser as $eUser) {
            $eUser->event = $eUser->event;
        }

        return $eventsUser;
    }

    #configuracao do evento selecionado
    public function selectedEventConfig()
    {
        return $this->hasOne(EventsUser::class, 'event_id', 'selected_event');
    }

    public function isAdminOfSelectedEvent()
    {
        $eventsUser = $this->belongsTo(EventsUser::class, 'selected_event', 'event_id');

        return ($eventsUser->whereUserId($this->id)->whereIsAdmin(1)->count() > 0);
    }

    public function isDev()
    {
        return ($this->is_dev);
    }

}
