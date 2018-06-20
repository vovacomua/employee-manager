<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;

class TreeController extends Controller
{
    //

    public function index()

	{
    	return view('tree');
	}


	public function showTree()

	{
		$tree = Employee::selectRaw('*, CONCAT(full_name, ", ",  position) AS text')->get()->toHierarchy();

		$tree = $this->formatForTreeJs($tree);

		return $tree;

	}

	private function formatForTreeJs($data) 

	{
		$temp = [];
		foreach ($data as $id => $value) {
			$temp[] = $value;
		}

		return $temp;
	}

}
