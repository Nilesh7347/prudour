<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Department;
use App\Models\Project;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
class ProjectController extends Controller
{
    
    //
    public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')->paginate(5);
        // echo "<pre>"; print_r($data); echo "</pre>";
        Log::info('Project Management  - '.$data[0]["name"]);
        $roles = Role::pluck('name','name')->all();
       
        $data = Project::orderBy('id','DESC')->paginate(5);
        return view('projects.index',compact('data'))
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
        Log::info('Project Management Create - '.$data[0]["name"]);
        $roles = Role::pluck('name','name')->all();
       
        $roles = Role::pluck('name','name')->all();
        return view('projects.create',compact('roles'));
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
       
        Project::create($input);
        
        return redirect()->route('projects.index')
                        ->with('success','project created successfully');
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
        Log::info('Project Management Show - '.$data[0]["name"]);
        $roles = Role::pluck('name','name')->all();
        
        $projects = Project::find($id);
        return view('projects.show',compact('projects'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $data = User::orderBy('id','DESC')->paginate(5);
        // echo "<pre>"; print_r($data); echo "</pre>";
        Log::info('Project Management Edit - '.$data[0]["name"]);
        $roles = Role::pluck('name','name')->all();
        
        return view('projects.edit',compact('project'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        request()->validate([
            'name' => 'required',
        ]);
    
        $project->update($request->all());
    
        return redirect()->route('projects.index')
                        ->with('success','projects updated successfully');
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
        Log::info('Project Management Delete - '.$data[0]["name"]);
        Project::find($id)->delete();
        return redirect()->route('projects.index')
                        ->with('success','projects deleted successfully');
    }
}
