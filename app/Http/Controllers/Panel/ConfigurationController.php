<?php
/**
 * @package    Controller
 * @author     Tiago Teixeira de Sousa <tiagoteixeira2214@gmail.com>
 * @date       27/02/2021 03:49:31
 */

declare(strict_types=1);

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Api\ApiBaseController;
use App\Http\Requests\ConfigurationStoreRequest;
use App\Http\Requests\ConfigurationUpdateRequest;
use App\Models\Configuration;
use App\Services\ConfigurationService;
use App\Traits\LogActivity;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use JsValidator;

class ConfigurationController extends ApiBaseController
{
    use LogActivity;

    private $service;
    private $label;

    public function __construct(ConfigurationService $service)
    {
        $this->service = $service;
        $this->label = 'Configuração';
    }

    public function index(): View
    {

        $this->log(__METHOD__);

        $this->authorize('viewAny', Configuration::class);

        $data = $this->service->paginate(20);

        return view('panel.configuration.index')
            ->with([
                'data' => $data,
                'label' => $this->label,
            ]);
    }

    public function create(): View
    {

        $this->log(__METHOD__);

        $this->authorize('create', Configuration::class);

        $validatorRequest = new ConfigurationStoreRequest();
        $validator = JsValidator::make($validatorRequest->rules(), $validatorRequest->messages());

        return view('panel.configuration.form')
            ->with([
                'validator' => $validator,
                'label' => $this->label,
            ]);
    }

    public function store(ConfigurationStoreRequest $configurationStoreRequest)
    {

        $this->service->create($configurationStoreRequest->all());

        return redirect()->route('configuration.' . request('routeTo'))
            ->with([
                'message' => 'Criado com sucesso',
                'messageType' => 's',
            ]);
    }

    public function edit(Configuration $configuration): View
    {
        $this->log(__METHOD__);
        $this->authorize('update', $configuration);

        $validatorRequest = new ConfigurationUpdateRequest();
        $validator = JsValidator::make($validatorRequest->rules(), $validatorRequest->messages());

        #dd($validatorRequest->rules());

        return view('panel.configuration.form')
            ->with([
                'item' => $configuration,
                'label' => $this->label,
                'validator' => $validator,
            ]);
    }

    public function update(ConfigurationUpdateRequest $request, Configuration $configuration): RedirectResponse
    {
        //SOMENTE ADMIN PODE ALTERAR
        $this->log(__METHOD__);

        $config = $this->service->update($request->all(), $configuration);

        return redirect()->route('configuration.edit', $config->id)
            ->with([
                'message' => 'Atualizado com sucesso',
                'messageType' => 's',
            ]);
    }

    public function destroy(Configuration $configuration): JsonResponse
    {

        $this->log(__METHOD__);

        try {

            if (!\Auth::user()->can('delete', $configuration)) {

                return $this->sendUnauthorized();
            }

            $this->service->delete($configuration);

            return $this->sendResponse([]);

        } catch (Exception $exception) {

            return $this->sendError('Server Error.', $exception);
        }
    }

    public function show(Configuration $configuration): JsonResponse
    {

        $this->log(__METHOD__);
        $this->authorize('update', $configuration);

        return response()->json($configuration, 200, [], JSON_PRETTY_PRINT);
    }
}
