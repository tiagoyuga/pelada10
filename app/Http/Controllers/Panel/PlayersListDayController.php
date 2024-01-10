<?php
/**
 * @package    Controller
 * @author     Tiago Teixeira de Sousa <tiagoteixeira2214@gmail.com>
 * @date       27/04/2021 01:27:44
 */

declare(strict_types=1);

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Api\ApiBaseController;
use App\Http\Requests\PlayersListDayStoreRequest;
use App\Http\Requests\PlayersListDayUpdateRequest;
use App\Models\PlayersListDay;
use App\Services\GamesDayService;
use App\Services\PlayersListDayService;
use App\Traits\LogActivity;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use JsValidator;

class PlayersListDayController extends ApiBaseController
{
    use LogActivity;

    private $service;
    private $label;

    public function __construct(PlayersListDayService $service)
    {

        $this->service = $service;
        $this->label = 'Lista de Atletas';
    }

    public function index(): View
    {

        $this->log(__METHOD__);

        $this->authorize('viewAny', PlayersListDay::class);

        $eventsDays = (new GamesDayService())->getAllLinkedEvent();

        return view('panel.players_list_day.index')
            ->with([
                'eventsDays' => $eventsDays,
                'label' => $this->label,
            ]);
    }

    public function create(): View
    {

        $this->log(__METHOD__);

        $this->authorize('create', PlayersListDay::class);

        $validatorRequest = new PlayersListDayStoreRequest();
        $validator = JsValidator::make($validatorRequest->rules(), $validatorRequest->messages());

        return view('panel.players_list_day.form')
            ->with([
                'validator' => $validator,
                'label' => $this->label,
            ]);
    }

    public function store(PlayersListDayStoreRequest $playersListDayStoreRequest)
    {

        $this->service->create($playersListDayStoreRequest->all());

        return redirect()->route('players_list_day.' . request('routeTo'))
            ->with([
                'message' => 'Criado com sucesso',
                'messageType' => 's',
            ]);
    }

    public function edit(PlayersListDay $playersListDay): View
    {

        $this->log(__METHOD__);

        $this->authorize('update', $playersListDay);

        $validatorRequest = new PlayersListDayUpdateRequest();
        $validator = JsValidator::make($validatorRequest->rules(), $validatorRequest->messages());

        return view('panel.players_list_day.form')
            ->with([
                'item' => $playersListDay,
                'label' => $this->label,
                'validator' => $validator,
            ]);
    }

    public function update(PlayersListDayUpdateRequest $request, PlayersListDay $playersListDay): RedirectResponse
    {

        $this->log(__METHOD__);

        $this->service->update($request->all(), $playersListDay);

        return redirect()->route('players_list_day.index')
            ->with([
                'message' => 'Atualizado com sucesso',
                'messageType' => 's',
            ]);
    }

    public function destroy(PlayersListDay $playersListDay): JsonResponse
    {

        $this->log(__METHOD__);

        try {

            if (!\Auth::user()->can('delete', $playersListDay)) {

                return $this->sendUnauthorized();
            }

            $this->service->delete($playersListDay);

            return $this->sendResponse([]);

        } catch (Exception $exception) {

            return $this->sendError('Server Error.', $exception);
        }
    }

    public function show(PlayersListDay $playersListDay): JsonResponse
    {

        $this->log(__METHOD__);
        $this->authorize('update', $playersListDay);

        return response()->json($playersListDay, 200, [], JSON_PRETTY_PRINT);
    }
}
