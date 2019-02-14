<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Kjdion84\Laraback\Traits\ValidateAjax;
use App\Colleges;
use App\Lessons;
use DB;
use DataTables;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{
    use ValidateAjax;
	

    // roles index with table
    public function index()
    {
    	
        return view('lessons.index');
    }

    // roles index datatable
    public function indexDatatable()
    {
		
        $users = DB::table('lessons');
        	

		return DataTables::of($users)->editColumn('college', function ($user) {
                return Colleges::find($user->college)->title;
            })->make(true);
    }

    // show add role modal
    public function addModal()
    {
       $query = DB::table('colleges')->get();

        return view('lessons.add')->with('query',$query);
    }

    // add role
    public function add()
    {
        $this->validateAjax(request(), [
            'college' => 'required',
            'title' => 'required',
        ]);

     

		$blog=DB::table('lessons')->insert(
    ['college' => request()->college,'title' => request()->title, ]
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
        $lessons = Lessons::findOrFail($id);
        $query = DB::table('colleges')->get();

        return view('lessons.edit', compact('lessons'))->with('query',$query);
    }

    // edit role
    public function edit($id)
    {
       
		
		$nat = Lessons::findOrFail($id);
        $nat->update(['college' => request()->college,'title' => request()->title]);

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
        $lessons = Lessons::findOrFail($id);

        return view('lessons.delete', compact('lessons'));
    }

    // delete role
    public function delete($id)
    {
        $nat = Lessons::findOrFail($id);
        $nat->delete();

        //activity('Deleted Role', $role->toArray(), $role);

        return response()->json([
            'flash' => ['success', 'تم الحذف بنجاح!'],
            'dismiss_modal' => true,
            'reload_datatables' => true,
        ]);
    }
}
