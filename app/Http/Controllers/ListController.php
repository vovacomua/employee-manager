<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Http\Requests\SearchRequest;

class ListController extends Controller
{

    public function __construct()

    {
        $this->middleware('auth');
    }

    public function index()

	{
        $employees = Employee::orderBy('id', 'asc')->get();

        return view('list.list', compact('employees'));
	}


    public function order(Request $request)

    {
        $input = $request->all();

        $this->validate(request(), [
            'field' => 'required|in:id,parent_id,full_name,position,start_date,salary',
            'order' => 'in:asc,desc'
        ]);

        $field = $request->input('field');
        $order = $request->input('order');
        
        $employees = Employee::orderBy($field, $order)->get(); 

        echo $this->renderOutput($employees);
    }


    public function search(SearchRequest $request)

    {
        $input = $request->all(); 
        
        $search_field = $request->input('search_field');
        $search_value = $request->input('search_value');
        $employees = Employee::where($search_field, '=', $search_value)->get(); 

        echo $this->renderOutput($employees);
    }

    private function renderOutput($collection)

    {

        $output = '';

        if ($collection->isNotEmpty()){

            foreach ($collection->chunk(50) as $chunk) {

                foreach ($chunk as $row) {
                   $output .= '
                    <tr>
                     <td>'.$row->id.'</td>
                     <td>'.$row->parent_id.'</td>
                     <td>'.$row->full_name.'</td>
                     <td>'.$row->position.'</td>
                     <td>'.$row->start_date.'</td>
                     <td>'.$row->salary.'</td>
                    </tr>
                    ';
                   } 
                   
                }

        } else {

            $output = '
               <tr>
                <td align="center" colspan="6">No Data Found</td>
               </tr>
               ';

        } 

        return json_encode($output);

    }

}
