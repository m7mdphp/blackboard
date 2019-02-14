<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Kjdion84\Laraback\Traits\ValidateAjax;
use App\Colleges;
use App\Universtes;
use App\Nations;
use DB;
use DataTables;
use Illuminate\Support\Facades\Auth;

class CollegeController extends Controller
{
    use ValidateAjax;
	

    // roles index with table
    public function index()
    {
    	
        return view('colleges.index');
    }

    // roles index datatable
    public function indexDatatable()
    {
		
        $users = DB::table('colleges');
        $get = DB::table('colleges')->get();
        $user= $get[0]->universty;
        $name= Universtes::find($user)->title;	

		return DataTables::of($users)->editColumn('universty', function ($user) {
                return Universtes::find($user->universty)->title;
            })->make(true);
}
    // show add role modal
    public function addModal()
    {
       $universtes = DB::table('universtes')->get();
       $nations = DB::table('nations')->get();
        return view('colleges.add')->with('universtes',$universtes)->with('nations',$nations);
    }

    // add role
    public function add()
    {
        $this->validateAjax(request(), [
            'universty' => 'required',
            'title' => 'required',
        ]);

     

		$blog=DB::table('colleges')->insert(
    ['universty' => request()->universty,'title' => request()->title, ]
);


       // activity('Added Blog', request()->name, $blog);

        return response()->json([
            'flash' => ['success', 'تم الحفظ بنجاح'],
            'dismiss_modal' => true,
            'reload_datatables' => true,
        ]);
    }

    // show edit role modal
    public function editModal($id)
    {
        $colleges = Colleges::findOrFail($id);
        $query = DB::table('universtes')->get();

        return view('colleges.edit', compact('colleges'))->with('query',$query);
    }

    // edit role
    public function edit($id)
    {
       
		
		$nat = Colleges::findOrFail($id);
        $nat->update(['universty' => request()->universty,'title' => request()->title]);

        //activity('Edited Blog', request()->all(), $role);

        return response()->json([
            'flash' => ['success', 'تم التعديل بنجاح'],
            'dismiss_modal' => true,
            'reload_datatables' => true,
        ]);
    }

    // show delete role modal
    public function deleteModal($id)
    {
        $colleges = Colleges::findOrFail($id);

        return view('colleges.delete', compact('colleges'));
    }

    // delete role
    public function delete($id)
    {
        $nat = Colleges::findOrFail($id);
        $nat->delete();

        //activity('Deleted Role', $role->toArray(), $role);

        return response()->json([
            'flash' => ['success', 'تم الحذف بنجاح!'],
            'dismiss_modal' => true,
            'reload_datatables' => true,
        ]);
    }

    public function selectAjax(Request $request)
    {
        if($request->ajax()){
            $universtes = DB::table('universtes')->where('nation',$request->nation)->pluck("title","id")->all();
            $data = view('colleges.ajax-select',compact('universtes'))->render();
            return response()->json(['options'=>$data]);
        }else{
            return view('colleges.ajax-select');
        }
    }
}
