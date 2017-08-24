<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Kodeine\Acl\Models\Eloquent\Role;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Shows the form for creating a new user
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('users.create', array('roles' => $roles));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function save(request $request, $id = 0)
    {
        $validation = [
            'name' => 'required|max:255',
            'username' => 'required|unique:users,username,'.$id.'|min:6|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$id,
        ];

        if (!$id) {
            $validation['password'] = 'required|min:6|confirmed';
        }

        $this->validate($request, $validation);

        $user = User::findOrNew($id);
        $fields = [
            'name' => $request['name'],
            'username' => $request['username'],
            'email' => $request['email']
        ];

        if ($request['password']) {
            $fields['password'] = bcrypt($request['password']);
        }

        $user->fill($fields);
        $user->save();

        // Delete actual roles if any and save the roles provided
        $user->syncRoles($request['roles']);

        return redirect('users');
    }

    /**
     * Shows the user listing for searching and editing system users
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $users = User::all();
        return view('users.list', array('users' => $users));
    }

    /**
     * Shows the detail of the user and allows to edit it
     *
     * @return \Illuminate\Http\Response
     */
    public function detail(User $user)
    {
        $roles = Role::all();

        return view('users.detail', ['roles' => $roles])->with('user', $user);
    }

    /**
     * Shows interface for updating logged user password
     *
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request)
    {
        $message = '';
        return view('users.update-password', ['message' => $message]);
    }

    /**
     * Validates and saves the new password
     *
     * @return \Illuminate\Http\Response
     */
    public function updatePasswordSave(Request $request)
    {
        $validation['new_password'] = 'required|min:6|confirmed';
        $this->validate($request, $validation);

        $user = Auth::user();
        $user->fill(['password' => bcrypt($request['new_password'])]);
        $user->save();

        $message = 'El password ha sido actualizado';
        return view('users.update-password', ['message' => $message]);
    }
}
