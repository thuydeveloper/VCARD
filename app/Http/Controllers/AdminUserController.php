<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\MultiTenant;
use App\Models\Role;
use App\Models\User;
use App\Models\Vcard;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

class AdminUserController extends AppBaseController
{
    /**
     * UserController constructor.
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepo = $userRepository;
    }

    public function index(): \Illuminate\View\View
    {
        return view('admin_users.index');
    }

    /**
     * @return Application|Factory|View
     */
    public function show($id): \Illuminate\View\View
    {
        $user = User::find($id);

        if (! empty($user) && $user->getRoleNames()[0] == 'super_admin') {
            return view('admin_users.show', compact('user'));
        }
        abort(404);
    }

    /**
     * @return Application|Factory|View
     */
    public function create(): \Illuminate\View\View
    {
        return view('admin_users.create');
    }

    /**
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateUserRequest $request): RedirectResponse
    {
        $input = $request->all();
        $input['role'] = Role::ROLE_SUPER_ADMIN;
        $this->userRepo->store($input);

        Flash::success(__('messages.admin.admin_created_successfully'));

        return redirect(route('admins.index'));
    }

    /**
     * @return Application|Factory|View
     */
    public function edit($id): \Illuminate\View\View
    {
        $user = User::find($id);

        return view('admin_users.edit', compact('user'));
    }

    /**
     * @return Application|RedirectResponse|Redirector
     */
    public function update(UpdateUserRequest $request, $id): RedirectResponse
    {
        $user = User::findOrFail($id);

        $this->userRepo->update($request->all(), $user);

        Flash::success(__('messages.admin.admin_updated_successfully'));

        return redirect(route('admins.index'));
    }

    /**
     * @param  User  $user
     * @return mixed
     */
    public function destroy(User $admin)
    {
        $adminDate = $admin->created_at;
        $loggedInAdminDate = Auth::user()->created_at;

        if ($loggedInAdminDate > $adminDate) {
            return $this->sendError(__('messages.admin.not_allowed_to_access'));
        }
        Vcard::where('tenant_id', $admin->tenant_id)->delete();
        MultiTenant::where('id', $admin->tenant_id)->delete();
        $admin->delete();

        return $this->sendSuccess(__('messages.admin.admin_delete_successfully'));
    }
}
