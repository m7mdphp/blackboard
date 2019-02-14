<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kjdion84\Laraback\Traits\ValidateAjax;
use App\Colleges;
use App\Universtes;
use App\Lessons;
use App\Orders;
use DB;
use DataTables;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    use ValidateAjax;
	

    // roles index with table
    public function index()
    {
    	
        return view('orders.index');
    }

    // roles index datatable
    public function indexDatatable()
    {
		
        $users = DB::table('orders');
        

		return DataTables::of($users)->editColumn('university', function ($user) {
                return Universtes::find($user->university)->title;
            })->editColumn('collage', function ($user) {
                return Colleges::find($user->collage)->title;
            })->editColumn('lesson', function ($user) {
                return Lessons::find($user->lesson)->title;
            })->editColumn('date', function ($user) {
    return date("Y-m-d",$user->date);
                 
            })->make(true);
}
    // show add role modal
    public function addModal()
    {
       $universtes = DB::table('universtes')->get();
       $collages = DB::table('colleges')->get();
       $lessons = DB::table('lessons')->get();
        return view('orders.add')->with('universtes',$universtes)->with('collages',$collages)->with('lessons',$lessons);
    }

    // add role
    public function add()
    {
        $this->validateAjax(request(), [
            'universtey' => 'required',
            
            
            
        ]);

     

		$blog=DB::table('orders')->insert(
    ['university' => request()->universtey,
    'collage' => request()->collage,
    'lesson' => request()->lesson,
    'type' => request()->type,
    'notes' => request()->notes,
    'level' => 'new',
    'date' => time(),
    'howmany' => request()->howmany,
    'number' => request()->number, 
]
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
        $orders = Orders::findOrFail($id);
        $universtes = DB::table('universtes')->get();
        $collages = DB::table('colleges')->get();
        $lessons = DB::table('lessons')->get();

        return view('orders.edit', compact('orders'))->with('universtes',$universtes)->with('collages',$collages)->with('lessons',$lessons);
    }

    // edit role
    public function edit($id)
    {
       
		
		$nat = Orders::findOrFail($id);
        $nat->update(['universty' => request()->universty,
        	'collage' => request()->collage,
        	'lesson' => request()->lesson,
        	'notes' => request()->notes,
        ]);

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
        $orders = Orders::findOrFail($id);

        return view('orders.delete', compact('orders'));
    }

    // delete role
    public function delete($id)
    {
        $nat = Orders::findOrFail($id);
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
            $colleges = DB::table('colleges')->where('universty',$request->universtey)->pluck("title","id")->all();
            $data = view('orders.ajax-select',compact('colleges'))->render();
            return response()->json(['options'=>$data]);
        }else{
            return view('orders.ajax-select');
        }
    }
    public function selectAjax2(Request $request)
    {
        if($request->ajax()){
            $lessons = DB::table('lessons')->where('college',$request->collage)->pluck("title","id")->all();
            $data = view('orders.ajax-select2',compact('lessons'))->render();
            return response()->json(['options'=>$data]);
        }else{
            return view('orders.ajax-select2');
        }
    }
}
