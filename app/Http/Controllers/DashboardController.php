<?php

namespace App\Http\Controllers;

use App\Departement as Departements;
use App\User as Users;

class DashboardController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('privilege:Dashboard');

    }

    public function index()
    {

        $data['users'] = Users::paginate(5);
        $data['page_title'] = 'Dashboard';
        $data['departements'] = Departements::all();

        return view('dashboard.index', $data);
    }
}
