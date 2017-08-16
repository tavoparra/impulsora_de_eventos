<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use Kodeine\Acl\Models\Eloquent\Role;

class ClientController extends Controller
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
        return view('clients.create');
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
        $user->fill([
            'name' => $request['name'],
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
        ]);
        $user->save();

        return redirect('users');
    }

    /**
     * Shows the user listing for searching and editing system users
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $clients = Client::all();
        return view('clients.list', array('clients' => $clients));
    }

    /**
     * Shows the detail of the user and allows to edit it
     *
     * @return \Illuminate\Http\Response
     */
    public function detail(Client $client)
    {
        return view('clients.detail')->with('client', $client);
    }
}
