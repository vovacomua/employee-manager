<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;

class ListController extends Controller
{

    public function __construct()

    {
        $this->middleware('auth');
    }

    public function index(Request $request)

	{
		$input = $request->all();
        
		//set default values
        $field = $request->input('field', 'id');
        $order = $request->input('order', 'asc');

        $employees = Employee::orderBy($field, $order)->get();

        return view('list.list', compact('employees'));

	}

}
