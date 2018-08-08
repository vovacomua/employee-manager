<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\SearchRequest;

use App\Employee;

class EmployeeController extends Controller
{

    public function __construct()

    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::orderBy('id', 'asc')->get();

        return view('list.list', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('list.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $this->validate(request(), [
            'parent_id' => 'nullable|numeric|digits_between:1,5|exists:employees,id',
            'full_name' => 'required|max:255',
            'position'  => 'required|max:255',
            'start_date'=> 'required|date',
            'salary'    => 'required|regex:/^\d{1,5}(\.\d{2})?$/',
            'photo'     => 'nullable|mimes:jpeg'
        ]);

        $has_photo = (isset($request->photo) ? 1 : 0);

        $employee = Employee::create([
                    'full_name' => $request->input('full_name'), 
                    'position' => $request->input('position'), 
                    'start_date' => $request->input('start_date'), 
                    'salary' => $request->input('salary'),
                    'has_photo' => $has_photo
                    ]); 
        
        if ($request->has('parent_id')){
            $boss = Employee::find($request->input('parent_id'));
            $employee->makeChildOf($boss);
        }

        if ($has_photo){
            $photoName = $employee->id.'.jpg';
            $request->photo->move(public_path('photos'), $photoName);   
        }


        return redirect('restricted')->with('success','New Employee has been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::find($id);
        
        return view('list.edit', compact('employee','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $this->validate(request(), [
            'parent_id' => 'nullable|numeric|digits_between:1,5|exists:employees,id',
            'full_name' => 'required|max:255',
            'position'  => 'required|max:255',
            'start_date'=> 'required|date',
            'salary'    => 'required|regex:/^\d{1,5}(\.\d{2})?$/',
            'photo'     => 'nullable|mimes:jpeg'
        ]);

        $has_photo = (isset($request->photo) ? 1 : 0);

        $employee = Employee::find($id);

        $employee->full_name = $request->input('full_name');
        $employee->position = $request->input('position');
        $employee->start_date = $request->input('start_date');
        $employee->salary = $request->input('salary');
        $employee->has_photo = $has_photo;
        
        $employee->save();

        //change boss

        $employee_parent_id = (isset($employee->parent_id) ? $employee->parent_id : null);
        $boss_id            = ($request->has('parent_id') ? intval($request->input('parent_id')) : null);

        if (($boss_id != $employee_parent_id) && ($boss_id != $employee->id)){ 

            if ($boss_id == null){
                $employee->makeRoot();
            } else {

                $boss = Employee::find($boss_id);
                
                if ($boss->isDescendantOf($employee)){
                    return back()->with('error', 'You tried to assign descendant as boss.'); 
                } else {

                    $employee->makeChildOf($boss);
                }

            }

        }

        if ($has_photo){
            $photoName = $employee->id.'.jpg';
            $request->photo->move(public_path('photos'), $photoName);
        }

        return redirect('restricted')->with('success', 'Employee has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);
        $employee->delete();
        return redirect('restricted')->with('success','Employee has been deleted.');
    }

    //

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
                    $url_edit = action('EmployeeController@edit', $row->id);
                    $url_destroy = action('EmployeeController@destroy', $row->id);
                    $token = csrf_field();

                    $photo = ((intval($row->has_photo) == 1) ? asset('photos/'.$row->id.'.jpg') : asset('photos/no-photo.jpg'));

                   $output .= '
                    <tr>
                     <td><img src="'.$photo.'" style="max-height:40px; max-width:40px"></td>
                     <td>'.$row->id.'</td>
                     <td>'.$row->parent_id.'</td>
                     <td>'.$row->full_name.'</td>
                     <td>'.$row->position.'</td>
                     <td>'.$row->start_date.'</td>
                     <td>'.$row->salary.'</td>

                     <td>
                        <a href="'.$url_edit.'" class="btn btn-warning"> <i class="fas fa-edit"></i> </a>
                     </td>

                     <td>
                        <form action="'.$url_destroy.'" method="post">
                          '.$token.'
                          <input name="_method" type="hidden" value="DELETE">
                          <button class="btn btn-danger" type="submit"> <i class="far fa-trash-alt"></i> </button>
                        </form>
                     </td>

                    </tr>
                    ';
                   } 
                   
                }

        } else {

            $output = '
               <tr>
                <td align="center" colspan="9">No Data Found</td>
               </tr>
               ';

        } 

        return json_encode($output);

    }  

}
