<?php
/**
 * @package    Controller
 * @author     Tiago Teixeira de Sousa <tiagoteixeira2214@gmail.com>
 * @date       27/02/2021 03:15:01
 */

declare(strict_types=1);

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Api\ApiBaseController;
use App\Http\Requests\EventStoreRequest;
use App\Http\Requests\EventUpdateRequest;
use App\Models\Event;
use App\Services\EventService;
use App\Traits\LogActivity;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use JsValidator;

class EventController extends ApiBaseController
{
    use LogActivity;

    private $service;
    private $label;

    public function __construct(EventService $service)
    {
        $this->service = $service;
        $this->label = 'Eventos';
    }

    public function index(): View
    {

        $this->log(__METHOD__);

        $this->authorize('viewAny', Event::class);

        $data = $this->service->paginate(20);

        return view('panel.events.index')
            ->with([
                'data' => $data,
                'label' => $this->label,
            ]);
    }

    public function create(): View
    {

        $this->log(__METHOD__);

        $this->authorize('create', Event::class);

        $validatorRequest = new EventStoreRequest();
        $validator = JsValidator::make($validatorRequest->rules(), $validatorRequest->messages());

        return view('panel.events.form')
            ->with([
                'validator' => $validator,
                'label' => $this->label,
            ]);
    }

    public function store(EventStoreRequest $eventStoreRequest)
    {

        $this->service->create($eventStoreRequest->all());

        return redirect()->route('events.' . request('routeTo'))
            ->with([
                'message' => 'Criado com sucesso',
                'messageType' => 's',
            ]);
    }

    public function edit(Event $event): View
    {

        $this->log(__METHOD__);

        $this->authorize('update', $event);

        $validatorRequest = new EventUpdateRequest();
        $validator = JsValidator::make($validatorRequest->rules(), $validatorRequest->messages());

        return view('panel.events.form')
            ->with([
                'item' => $event,
                'label' => $this->label,
                'validator' => $validator,
            ]);
    }

    public function update(EventUpdateRequest $request, Event $event): RedirectResponse
    {

        $this->log(__METHOD__);

        $this->service->update($request->all(), $event);

        return redirect()->route('events.index')
            ->with([
                'message' => 'Atualizado com sucesso',
                'messageType' => 's',
            ]);
    }

    public function destroy(Event $event): JsonResponse
    {

        $this->log(__METHOD__);

        try {

            if (!\Auth::user()->can('delete', $event)) {

                return $this->sendUnauthorized();
            }

            $this->service->delete($event);

            return $this->sendResponse([]);

        } catch (Exception $exception) {

            return $this->sendError('Server Error.', $exception);
        }
    }

    public function show(Event $event): JsonResponse
    {

        $this->log(__METHOD__);
        $this->authorize('update', $event);

        return response()->json($event, 200, [], JSON_PRETTY_PRINT);
    }
}
