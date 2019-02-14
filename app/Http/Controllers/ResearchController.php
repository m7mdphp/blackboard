<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kjdion84\Laraback\Traits\ValidateAjax;
use App\Researches;
use DB;
use DataTables;
use Illuminate\Support\Facades\Auth;

class ResearchController extends Controller
{
     use ValidateAjax;
	

    // roles index with table
    public function index()
    {
        return view('researches.index');
    }

    // roles index datatable
    public function indexDatatable()
    {
		
        $users = DB::table('researches');

		return DataTables::of($users)->editColumn('date', function ($user) {
    return date("Y-m-d",$user->date);
                 
            })->editColumn('level','1')->make(true);
    }

    // show add role modal
    public function addModal()
    {
       

        return view('researches.add');
    }

    // add role
    public function add()
    {
        $this->validateAjax(request(), [
            'title' => 'required',
            'details' => 'required',
            'pages' => 'required',
            'alngs' => 'required',
            'notes' => 'required',

        ]);

     

		$blog=DB::table('researches')->insert(
    ['title' => request()->title,
    'details' => request()->details,
    'pages' => request()->pages,
    'alngs' => request()->alngs,
    'notes' => request()->notes, 
    'date' => time(),

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
        $researches = Researches::findOrFail($id);

        return view('researches.edit', compact('researches'));
    }

    // edit role
    public function edit($id)
    {
       
		
		$nat = Researches::findOrFail($id);
        $nat->update(['title' => request()->title,
        	'details' => request()->details,
        	'pages' => request()->pages,
        	'alngs' => request()->alngs,
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
        $researches = Researches::findOrFail($id);

        return view('researches.delete', compact('researches'));
    }

    // delete role
    public function delete($id)
    {
        $nat = Researches::findOrFail($id);
        $nat->delete();

        //activity('Deleted Role', $role->toArray(), $role);

        return response()->json([
            'flash' => ['success', 'تم الحذف بنجاح!'],
            'dismiss_modal' => true,
            'reload_datatables' => true,
        ]);
    }
}
