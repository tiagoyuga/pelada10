<?php
/**
 * @package    Controller
 * @author     Tiago Teixeira de Sousa <tiagoteixeira2214@gmail.com>
 * @date       09/03/2021 02:54:27
 */

declare(strict_types=1);

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Api\ApiBaseController;
use App\Http\Requests\GamesDayStoreRequest;
use App\Http\Requests\GamesDayUpdateRequest;
use App\Models\GamesDay;
use App\Services\GamesDayService;
use App\Traits\LogActivity;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use JsValidator;

class GamesDayController extends ApiBaseController
{
    use LogActivity;

    private $service;
    private $label;

    public function __construct(GamesDayService $service)
    {

        $this->service = $service;
        $this->label = 'Dias dos Jogos';
    }

    public function index(): View
    {

        $this->log(__METHOD__);

        $this->authorize('viewAny', GamesDay::class);

        $data = $this->service->paginate(20);

        return view('panel.games_days.index')
            ->with([
                'data' => $data,
                'label' => $this->label,
            ]);
    }

    public function create(): View
    {

        $this->log(__METHOD__);

        $this->authorize('create', GamesDay::class);

        $validatorRequest = new GamesDayStoreRequest();
        $validator = JsValidator::make($validatorRequest->rules(), $validatorRequest->messages());

        return view('panel.games_days.form')
            ->with([
                'validator' => $validator,
                'label' => $this->label,
            ]);
    }

    public function store(GamesDayStoreRequest $gamesDayStoreRequest)
    {

        $this->service->create($gamesDayStoreRequest->all());

        return redirect()->route('games_days.' . request('routeTo'))
            ->with([
                'message' => 'Criado com sucesso',
                'messageType' => 's',
            ]);
    }

    public function edit(GamesDay $gamesDay): View
    {

        $this->log(__METHOD__);

        $this->authorize('update', $gamesDay);

        $validatorRequest = new GamesDayUpdateRequest();
        $validator = JsValidator::make($validatorRequest->rules(), $validatorRequest->messages());

        return view('panel.games_days.form')
            ->with([
                'item' => $gamesDay,
                'label' => $this->label,
                'validator' => $validator,
            ]);
    }

    public function update(GamesDayUpdateRequest $request, GamesDay $gamesDay): RedirectResponse
    {
dd('asda');
        $this->log(__METHOD__);

        $this->service->update($request->all(), $gamesDay);

        return redirect()->route('games_days.index')
            ->with([
                'message' => 'Atualizado com sucesso',
                'messageType' => 's',
            ]);
    }

    public function destroy(GamesDay $gamesDay): JsonResponse
    {

        $this->log(__METHOD__);

        try {

            if (!\Auth::user()->can('delete', $gamesDay)) {

                return $this->sendUnauthorized();
            }

            $this->service->delete($gamesDay);

            return $this->sendResponse([]);

        } catch (Exception $exception) {

            return $this->sendError('Server Error.', $exception);
        }
    }

    public function show(GamesDay $gamesDay): JsonResponse
    {

        $this->log(__METHOD__);
        $this->authorize('update', $gamesDay);

        return response()->json($gamesDay, 200, [], JSON_PRETTY_PRINT);
    }
}
