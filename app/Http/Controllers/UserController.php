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
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportUser;

class UserController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Auth::user()->user_type == 'Admin'){
            $data = User::orderBy('id','DESC')->paginate(5);
            // echo "<pre>"; print_r($data); echo "</pre>";
            Log::info('User Management with user - '.$data[0]["name"]);
            return view('users.index',compact('data'))
                ->with('i', ($request->input('page', 1) - 1) * 5);
        }else{
            $userId = Auth::user()->id;
           
            $data = User::where(['id'=>$userId])->orderBy('id','DESC')->paginate(5);
            // echo "<pre>"; print_r($data); echo "</pre>";
            Log::info('User Management with user - '.$data[0]["name"]);
            return view('users.index',compact('data'))
                ->with('i', ($request->input('page', 1) - 1) * 5);
        }
        
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
        Log::info('User Management create user - '.$data[0]["name"]);
        $projects = Project::pluck('name', 'name')->all();
        $departments = Department::pluck('name', 'name')->all();
        $roles = Role::pluck('name','name')->all();
        return view('users.create',compact('roles','departments','projects'));
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
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        
        $input['password'] = Hash::make($input['password']);
        $input['departments'] = implode(',', $input['departments']);
        $input['projects'] = implode(',', $input['projects']);
        $input['user_type'] = $input['roles'];
        // echo "<pre>";
        // print_r($input);
        // echo "</pre>";
        // die;
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('users.index')
                        ->with('success','User created successfully');
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
        Log::info('User Management Show user - '.$data[0]["name"]);
        $user = User::find($id);
        return view('users.show',compact('user'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = User::orderBy('id','DESC')->paginate(5);
        // echo "<pre>"; print_r($data); echo "</pre>";
        Log::info('User Management Update user - '.$data[0]["name"]);
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        $projects = Project::pluck('name', 'name')->all();
        $departments = Department::pluck('name', 'name')->all();
       
        return view('users.edit',compact('user','roles','userRole','departments','projects'));
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
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
    
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
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
        Log::info('User Management Delete user - '.$data[0]["name"]);
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }

    public function exportUsers(Request $request){
        return Excel::download(new ExportUser, 'users.xlsx');
    }
}
