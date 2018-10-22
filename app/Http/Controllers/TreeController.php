<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;

class TreeController extends Controller
{
    //

    public function index()

	{
    	return view('tree.tree');
	}


	public function showTree(Request $request)

	{
		if ($request->id > 0){
			return $this->lazyLoadSecondLevel($request->id);
		} else {
			return $this->lazyLoadFirstLevel();
		}

	}

	private function lazyLoadFirstLevel()
	{
		$tree = Employee::limitDepth(2)->get()->toHierarchy();
		$tree = $tree->values();

		foreach ($tree as $id => $value) {
			foreach ($value->children as $id2 => $value2) {
				if (count($value2->children) > 0){	
						unset($value2->children);
						$value2->children = true;
					} else {
						unset($value2->children);
					}
				
			}
		}

		return $tree;

	}

	private function lazyLoadSecondLevel($id)
	{
		$boss = Employee::find($id);
		$tree = $boss->getDescendants()->toHierarchy();
		$tree = $tree->values();
		return $tree;

	}

}
