<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Rfc;
use Kodeine\Acl\Models\Eloquent\Role;

class ClientController extends Controller
{
    private $status_list = [
        'Malo' => 'Malo',
        'Regular' => 'Regular',
        'Bueno' => 'Bueno',
        'Excelente' => 'Excelente'
    ];

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
        return view('clients.form', ['title' => 'Nuevo Cliente', 'submitText' => 'Crear', 'status_list' => $this->status_list]);
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
            'email' => 'email',
            'status' => 'required|in:Malo,Regular,Bueno,Excelente'
        ];

        $this->validate($request, $validation);

        $client = Client::findOrNew($id);
        $client->fill([
            'name' => $request['name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'status' => $request['status'],
            'comments' => $request['comments'],
        ]);
        $client->save();


        // If rfc has non empty fields we save it
        $rfc_info = $request->get('rfc');
        if (array_filter($rfc_info)) {
            $rfc = new Rfc;
            $rfc->fill(array_merge($rfc_info, ['client_id' => $client->id]));
            $rfc->save();
        }

        return redirect('clients');
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
    public function detail($id)
    {
        $client = Client::find($id);
        return view('clients.form',
            ['client' => $client, 'title' => 'Detalle de cliente', 'submitText' => 'Actualizar', 'status_list' => $this->status_list]
        );
    }
}
