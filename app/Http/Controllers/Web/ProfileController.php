<?php
/**
 * @package    Controller
 * @author
 * @date
 */

declare(strict_types=1);

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Api\ApiBaseController;
#use App\Http\Requests\ClientStoreRequest;
#use App\Http\Requests\ClientUpdateRequest;
use App\Models\User;
use App\Services\CityService;
#use App\Services\ClientService;
use App\Traits\ImageCrop;
use App\Traits\LogActivity;
#use Auth;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use JsValidator;

class ProfileController extends ApiBaseController
{
    use LogActivity, ImageCrop;

    private $service;
    private $label;
    private $cropModule;

    public function __construct(/*ClientService $service*/)
    {

        #$this->service = $service;
        $this->label = 'Perfil';
        $this->cropModule = "web";
    }

    public function index(): View
    {

        $this->log(__METHOD__);

        // list or card
        $showStyle = request("show_style") ? request("show_style") : "list";

        $this->authorize('viewAny', User::class);
        $limit = $showStyle == 'list' ? 20 : 10;

        $data = $this->service->paginate($limit);

        return view('panel.clients.index')
            ->with([
                'data' => $data,
                'label' => $this->label,
                'showStyle' => $showStyle,
            ]);
    }

    public function create(CityService $cityService): View
    {

        $this->log(__METHOD__);

        $this->authorize('create', User::class);

        $validatorRequest = new ClientStoreRequest();
        $validator = JsValidator::make($validatorRequest->rules(), $validatorRequest->messages());

        return view('panel.clients.form')
            ->with([
                'validator' => $validator,
                'label' => $this->label,
                'cityList' => $cityService->findList(),
            ]);
    }

    public function store(ClientStoreRequest $clientStoreRequest)
    {

        $this->service->create($clientStoreRequest->all());

        return redirect()->route('clients.' . request('routeTo'))
            ->with([
                'message' => 'Criado com sucesso',
                'messageType' => 's',
            ]);
    }

    public function edit(User $client, CityService $cityService): View
    {

        $this->log(__METHOD__);

        $this->authorize('update', $client);

        $validatorRequest = new ClientUpdateRequest();
        $validator = JsValidator::make($validatorRequest->rules(), $validatorRequest->messages());

        return view('panel.clients.form')
            ->with([
                'item' => $client,
                'label' => $this->label,
                'validator' => $validator,
                'cityList' => $cityService->findList(),
            ]);
    }

    public function update(ClientUpdateRequest $request, User $client): RedirectResponse
    {

        $this->log(__METHOD__);

        $this->service->update($request->all(), $client);

        return redirect()->route('clients.index')
            ->with([
                'message' => 'Atualizado com sucesso',
                'messageType' => 's',
            ]);
    }

    public function destroy(User $client): JsonResponse
    {

        $this->log(__METHOD__);

        try {

            if (!Auth::user()->can('delete', $client)) {

                return $this->sendUnauthorized();
            }

            $this->service->delete($client);

            return $this->sendResponse([]);

        } catch (Exception $exception) {

            return $this->sendError('Server Error.', $exception);
        }
    }

    public function show(User $client): JsonResponse
    {

        $this->log(__METHOD__);
        $this->authorize('update', $client);

        return response()->json($client, 200, [], JSON_PRETTY_PRINT);
    }

    //find clients
    public function find()
    {
        return $this->service->findList();
    }

}
