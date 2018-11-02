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
			$request->session()->regenerate();
			$request->session()->put('ts', $this->getLastUpdateTimestamp());

			return $this->lazyLoadFirstLevel();
		}

	}

	private function lazyLoadFirstLevel()
	{
		$tree = Employee::limitDepth(2)->get()->toHierarchy();
		$tree = $tree->values();

		foreach ($tree->chunk(50) as $chunk) {
			foreach ($chunk as $id => $value) {

				foreach ($value->children->chunk(50) as $chunk2) {
					foreach ($chunk2 as $id2 => $value2) { 

						if (count($value2->children) > 0){	
								unset($value2->children);
								$value2->children = true;
							} else {
								unset($value2->children);
							}
						
					}
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

	public function rebaseTree(Request $request)

	{

		$session_ts = $request->session()->get('ts');

		//check to see if employees tree has already been modified by another user
		if ($this->getLastUpdateTimestamp() == $session_ts){
			$employee = Employee::find($request->id);

			if ($request->parent_id > 0){
				$boss = Employee::find($request->parent_id);

	                    $employee->makeChildOf($boss);

			} else {
				$employee->makeRoot();
			}

			$request->session()->put('ts', $this->getLastUpdateTimestamp());
			return response()->json([
				'status' => 'success', 
				'message' => 'OK'
			]);	

		} else {

			return response()->json([
				'status' => 'error', 
				'message' => 'Somebody has already modified employees tree. Refresh this page and try again.'
			]);
		}

	}

	private function getLastUpdateTimestamp()

	{
		$edited = Employee::latest('updated_at')->first();
		$timestamp = $edited->updated_at->getTimestamp();

		return $timestamp;
	}

}
