<?php
/**
 * @package    Controller
 * @author     Tiago Teixeira de Sousa <tiagoteixeira2214@gmail.com>
 * @date       05/02/2021 21:38:30
 */

declare(strict_types=1);

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Api\ApiBaseController;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Services\UserService;
use App\Traits\LogActivity;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use JsValidator;

class ProfileController extends ApiBaseController
{
    use LogActivity;

    private $service;
    private $label;

    public function __construct(UserService $service)
    {

        $this->service = $service;
        $this->label = 'Perfil';
    }

    public function edit(): View
    {
        $this->log(__METHOD__);

        $user = Auth::user();

        $this->authorize('update', $user);

        $validatorRequest = new UserUpdateRequest();
        $validator = JsValidator::make($validatorRequest->rules(), $validatorRequest->messages());

        return view('panel.users.form')
            ->with([
                'item' => $user,
                'label' => $this->label,
                'validator' => $validator,
            ]);
    }

    public function update(UserUpdateRequest $request, User $user): RedirectResponse
    {
        $this->log(__METHOD__);

        $data = $request->all();
        $data['first_access'] = 0;
        $this->service->update($data, $user);

        return redirect()->route('profile')
            ->with([
                'message' => 'Atualizado com sucesso',
                'messageType' => 's',
            ]);
    }

    public function show(User $user): JsonResponse
    {

        $this->log(__METHOD__);
        $this->authorize('update', $user);

        return response()->json($user, 200, [], JSON_PRETTY_PRINT);
    }
}
