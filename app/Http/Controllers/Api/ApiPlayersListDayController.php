<?php
/**
 * @package    Api
 * @author     Tiago Teixeira de Sousa <tiagoteixeira2214@gmail.com>
 * @date       27/04/2021 01:27:44
 */

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Requests\PlayersListDayStoreRequest;
use App\Http\Requests\PlayersListDayUpdateRequest;
use App\Http\Resources\PlayersListDayCollection;
use App\Http\Resources\PlayersListDayResource;
use App\Services\PlayersListDayService;
use Illuminate\Http\JsonResponse;
use Validator;

class ApiPlayersListDayController extends ApiBaseController
{

    private $service;

    /**
     * Create a new controller instance.
     *
     * @param PlayersListDayService $service
     */
    public function __construct(PlayersListDayService $service)
    {

        $this->middleware('jwt.auth');
        $this->service = $service;
    }

    /**
     * Paginate.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {

        try {

            $limit = (int)(request('limit') ?? 20);
            $data = $this->service->paginate($limit);

            return $this->sendPaginate(new PlayersListDayCollection($data));

        } catch (\Exception $e) {

            return $this->sendError('Server Error.', $e);

        }
    }

    /**
     * return all.
     *
     * @return JsonResponse
     */
    public function all(): JsonResponse
    {

        try {

            $data = $this->service->all();

            return $this->sendResource(PlayersListDayResource::collection($data));

        } catch (\Exception $e) {

            return $this->sendError('Server Error.', $e);
        }
    }

    /**
     * Find detail using id.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {

        try {

            $item = $this->service->find($id);
            if ($item === null) {

                return $this->sendNotFound();
            }

            return $this->sendResource(new PlayersListDayResource($item));

        } catch (\Exception $e) {

            return $this->sendError('Server Error.', $e);

        }
    }

    /**
     * Store.
     *
     * @return JsonResponse
     */
    public function store()
    {
        try {

            if (!\Auth::user()->can('create', PlayersListDay::class)) {

                return $this->sendUnauthorized();
            }

            $storeRequest = new PlayersListDayStoreRequest();
            $validator = Validator::make(request()->all(), $storeRequest->rules());

            if ($validator->fails()) {

                return $this->sendBadRequest('Validation Error.', $validator->errors()->toArray());
            }

            $item = $this->service->create(request()->all());

            return $this->sendResponse($item->toArray());

        } catch (\Exception $e) {

            return $this->sendError('Server Error.', $e);

        }
    }

    /**
     * Update.
     *
     * @return JsonResponse
     */
    public function update()
    {
        try {

            $item = $this->service->find($id);
            if ($item === null) {

                return $this->sendNotFound();
            }

            if (!\Auth::user()->can('update', PlayersListDay::class)) {

                return $this->sendUnauthorized();
            }

            $updateRequest = new PlayersListDayUpdateRequest();
            $validator = Validator::make(request()->all(), $updateRequest->rules());

            if ($validator->fails()) {

                return $this->sendBadRequest('Validation Error.', $validator->errors()->toArray());
            }

            $item = $this->service->update(request()->all(), $item);

            return $this->sendResponse($item->toArray());

        } catch (\Exception $e) {

            return $this->sendError('Server Error.', $e);

        }
    }
}
