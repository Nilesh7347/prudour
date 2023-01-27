<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Department;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;

use Illuminate\Support\Facades\Log;
class DepartmentController extends Controller
{
    //
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')->paginate(5);
        // echo "<pre>"; print_r($data); echo "</pre>";
        Log::info('Department Management  - '.$data[0]["name"]);
        $roles = Role::pluck('name','name')->all();
        // print_r($roles);
        // die;
       
        $data = Department::orderBy('id','DESC')->paginate(5);
        return view('departments.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = User::orderBy('id','DESC')->paginate(5);
        // echo "<pre>"; print_r($data); echo "</pre>";
        Log::info('Department Management Create Department - '.$data[0]["name"]);
        $roles = Role::pluck('name','name')->all();
            
            return view('departments.create',compact('roles'));        
       
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',           
        ]);
    
        $input = $request->all();
       
         Department::create($input);
        
        return redirect()->route('departments.index')
                        ->with('success','Department created successfully');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = User::orderBy('id','DESC')->paginate(5);
        // echo "<pre>"; print_r($data); echo "</pre>";
        Log::info('Department Management Show Department  - '.$data[0]["name"]);
        $roles = Role::pluck('name','name')->all();
       
       
        $departments = Department::find($id);
        return view('departments.show',compact('departments'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        $data = User::orderBy('id','DESC')->paginate(5);
        // echo "<pre>"; print_r($data); echo "</pre>";
        Log::info('Department Management  Edit Department- '.$data[0]["name"]);
        $roles = Role::pluck('name','name')->all();
       
        return view('departments.edit',compact('department'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        request()->validate([
            'name' => 'required',
        ]);
    
        $department->update($request->all());
    
        return redirect()->route('departments.index')
                        ->with('success','Department updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = User::orderBy('id','DESC')->paginate(5);
        // echo "<pre>"; print_r($data); echo "</pre>";
        Log::info('Department Management Delete Department  - '.$data[0]["name"]);
        Department::find($id)->delete();
        return redirect()->route('departments.index')
                        ->with('success','Department deleted successfully');
    }
}
