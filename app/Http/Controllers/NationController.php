<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Kjdion84\Laraback\Traits\ValidateAjax;
use App\Nations;
use DB;
use DataTables;
use Illuminate\Support\Facades\Auth;

class NationController extends Controller
{
    use ValidateAjax;
	

    // roles index with table
    public function index()
    {
        return view('nations.index');
    }

    // roles index datatable
    public function indexDatatable()
    {
		
        $query = DB::table('nations');

		return DataTables::of($query)->toJson();
    }

    // show add role modal
    public function addModal()
    {
       

        return view('nations.add');
    }

    // add role
    public function add()
    {
        $this->validateAjax(request(), [
            'title' => 'required',
        ]);

     

		$blog=DB::table('nations')->insert(
    ['title' => request()->title, ]
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
        $nation = Nations::findOrFail($id);

        return view('nations.edit', compact('nation'));
    }

    // edit role
    public function edit($id)
    {
       
		
		$nat = Nations::findOrFail($id);
        $nat->update(['title' => request()->title]);

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
        $nation = Nations::findOrFail($id);

        return view('nations.delete', compact('nation'));
    }

    // delete role
    public function delete($id)
    {
        $nat = Nations::findOrFail($id);
        $nat->delete();

        //activity('Deleted Role', $role->toArray(), $role);

        return response()->json([
            'flash' => ['success', 'تم الحذف بنجاح!'],
            'dismiss_modal' => true,
            'reload_datatables' => true,
        ]);
    }
}
