<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Custom\Authenticate;
use App\Producto;
use App\DetalleOrden;
use Session;
use Redirect;
use App\User;


class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authenticate  = Authenticate::encryption(255);
        $listProduct   = Producto::listProductAll()->get();
        $deleted       = Producto::whereNotNull('deleted_at')->get();
        $sales         = DetalleOrden::whereDate('created_at', date('Y-m-d'))->get()->sum('granTotal');
        $Yesterday     = DetalleOrden::whereDate('created_at', strtotime(date('Y-m-d') . "- 1 week"))->get()->sum('granTotal');
        return view('home', compact('authenticate', 'listProduct', 'deleted', 'sales', 'Yesterday'));
    }
    public function  modifyDataAdmin(Request $request)
    {
        $rules = array(
            'name'                  => 'required|string|max:255',
            'password'              => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            Session::flash('alert_error', 'Hay problemas con los datos,  modifíquelos por favor!');
            $this->validate($request, $rules);
        } else {
            $result           = new User;
            $result           = User::find($request->id);
            $result->name     = $request->input('name');
            $result->email    = $request->input('email');
            $result->password = Hash::make($request->input('password'));
            $result->save();
            Auth::logout();
            Session::flush();
            return Redirect::to('login');
        }
    }
}
