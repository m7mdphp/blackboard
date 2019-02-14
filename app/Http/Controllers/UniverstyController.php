<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Kjdion84\Laraback\Traits\ValidateAjax;
use App\Nations;
use App\Universtes;
use DB;
use DataTables;
use Illuminate\Support\Facades\Auth;

class UniverstyController extends Controller
{
    use ValidateAjax;
	

    // roles index with table
    public function index()
    {
        
    	
      return view('universtes.index');
    }

    // roles index datatable
    public function indexDatatable()
    {
		
        $users = DB::table('universtes');
		return DataTables::of($users)->editColumn('nation', function ($user) {
                return Nations::find($user->nation)->title;
            })->make(true);
    }

    // show add role modal
    public function addModal()
    {
       $query = DB::table('nations')->get();

        return view('universtes.add')->with('query',$query);
    }

    // add role
    public function add()
    {
        $this->validateAjax(request(), [
            'nation' => 'required',
            'title' => 'required',
        ]);

     

		$blog=DB::table('universtes')->insert(
    ['nation' => request()->nation,'title' => request()->title, ]
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
        $universtes = Universtes::findOrFail($id);
        $query = DB::table('nations')->get();

        return view('universtes.edit', compact('universtes'))->with('query',$query);
    }

    // edit role
    public function edit($id)
    {
       
		
		$nat = Universtes::findOrFail($id);
        $nat->update(['nation' => request()->nation,'title' => request()->title]);

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
        $universty = Universtes::findOrFail($id);

        return view('universtes.delete', compact('universty'));
    }

    // delete role
    public function delete($id)
    {
        $nat = Universtes::findOrFail($id);
        $nat->delete();

        //activity('Deleted Role', $role->toArray(), $role);

        return response()->json([
            'flash' => ['success', 'تم الحذف بنجاح!'],
            'dismiss_modal' => true,
            'reload_datatables' => true,
        ]);
    }
}
