<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Centers;
use App\User;
use App\Teachers;
use App\Students;
use App\Messages;
use Kjdion84\Laraback\Traits\ValidateAjax;
use DB;
use DataTables;
use Illuminate\Support\Facades\Auth;
class MessageController extends Controller
{
       use ValidateAjax;
	

    // roles index with table
    public function index()
    {

    	return view('messages.index');
    }
    
    public function send()
    {
    	
        return view('messages.send');
    }
    // roles index datatable
    public function indexDatatable()
    {
		
       $users = DB::table('messages')->where('to_table', 'centers')->where('to_id', Auth::guard('center')->id());
       
    	
    	

return DataTables::of($users)->editColumn('from_id', function ($user) {
    if($user->from_table=='admins'){
        return User::find($user->from_id)->name; 
        }elseif($user->from_table=='teachers'){
        return Teachers::find($user->from_id)->name;    
        }else{
        return Students::find($user->from_id)->name;     
        }
                 
            })->make(true);
    }

        // roles index datatable
    public function sendDatatable()
    {
		
        $users = DB::table('messages')->where('from_table', 'centers')->where('from_id', Auth::guard('center')->id());
        
    	

return DataTables::of($users)->editColumn('from_id', function ($user) {
    if($user->to_table=='admins'){
        return User::find($user->to_id)->name; 
        }elseif($user->to_table=='teachers'){
        return Teachers::find($user->to_id)->name;    
        }else{
        return Students::find($user->to_id)->name;     
        }
                 
            })->make(true);
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////
        public function index_student()
    {

        return view('messages.index_student');
    }
     public function sendStudent()
    {
        
        return view('messages.send_student');
    }


   public function indexDatatableStudent()
    {
        
       $users = DB::table('messages')->where('to_table', 'students')->where('to_id', Auth::guard('student')->id());
       
        
        

return DataTables::of($users)->editColumn('from_id', function ($user) {
    if($user->from_table=='admins'){
        return User::find($user->from_id)->name; 
        }elseif($user->from_table=='teachers'){
        return Teachers::find($user->from_id)->name;    
        }else{
        return Centers::find($user->from_id)->name;     
        }
                 
            })->make(true);
    }

          // roles index datatable
    public function sendDatatableStudent()
    {
        
        $users = DB::table('messages')->where('from_table', 'students')->where('from_id', Auth::guard('student')->id());
        
        

return DataTables::of($users)->editColumn('from_id', function ($user) {
    if($user->to_table=='admins'){
        return User::find($user->to_id)->name; 
        }elseif($user->to_table=='teachers'){
        return Teachers::find($user->to_id)->name;    
        }else{
        return Centers::find($user->to_id)->name;     
        }
                 
            })->make(true);
    }



    //////////////////////////////////////////////////////////////////////



    public function admin()
    {

    	return view('messages.admins');
    }
    public function sendadmin()
    {
    	
        return view('messages.sendadmins');
    }


    // roles index datatable
    public function adminDatatable()
    {
		
       $users = DB::table('messages')->where('to_table', 'admins')->where('to_id', Auth::id());
return DataTables::of($users)->editColumn('from_id', function ($user) {
    if($user->from_table=='admins'){
        return User::find($user->from_id)->name; 
        }elseif($user->from_table=='teachers'){
        return Teachers::find($user->from_id)->name;    
        }else{
        return Students::find($user->from_id)->name;     
        }
                 
            })->make(true);
    }
    

        // roles index datatable
    public function sendDatatableadmin()
    {
		
        $users = DB::table('messages')->where('from_table', 'admins')->where('from_id', Auth::id());
return DataTables::of($users)->editColumn('from_id', function ($user) {
    if($user->to_table=='admins'){
        return User::find($user->to_id)->name; 
        }elseif($user->to_table=='teachers'){
        return Teachers::find($user->to_id)->name;    
        }else{
        return Students::find($user->to_id)->name;     
        }
                 
            })->make(true);
    }

}
