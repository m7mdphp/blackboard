<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Kjdion84\Laraback\Traits\ValidateAjax;
use App\Documents;
use DB;
use DataTables;
use Illuminate\Support\Facades\Auth;
class Document extends Controller
{
     use ValidateAjax;
	

    // roles index with table
    public function index()
    {
        return view('document.index');
    }

    // roles index datatable
    public function indexDatatable()
    {
		
        $query = DB::table('documents');

		return DataTables::of($query)->toJson();
    }

    // show add role modal
    public function addModal()
    {
       

        return view('document.add');
    }

    // add role
    public function add()
    {
        $this->validateAjax(request(), [
            'university' => 'required',
			'collage' => 'required',
			'year' => 'required',
			'subject' => 'required',
			'diary' => 'required|mimes:jpeg,png,jpg,gif,svg,pdf|max:2048',
			'coast' => 'required',
			'cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

      $diary = time().'.'.request()->diary->getClientOriginalExtension();
      request()->diary->move(public_path('uploads'), $diary);
	  
	  $cover = time().'.'.request()->cover->getClientOriginalExtension();
      request()->cover->move(public_path('uploads'), $cover);
	  
	  $center=auth()->guard('center')->id();

		$blog=DB::table('documents')->insert(
    ['university' => request()->university, 'collage' => request()->collage, 'year' => request()->year, 'subject' => request()->subject, 'diary' => $diary, 'coast' => request()->coast,
	'cover' => $cover, 'center' => $center]
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
        $document = Documents::findOrFail($id);

        return view('document.edit', compact('document'));
    }

    // edit role
    public function edit($id)
    {
       $this->validateAjax(request(), [
            'university' => 'required',
			'collage' => 'required',
			'year' => 'required',
			'subject' => 'required',
			'diary' => 'mimes:jpeg,png,jpg,gif,svg,pdf|max:2048',
			'coast' => 'required',
			'cover' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
		
		$doc = Documents::findOrFail($id);
		if(request()->diary){
	  $diary = time().'.'.request()->diary->getClientOriginalExtension();
      request()->diary->move(public_path('uploads'), $diary);
	  }else{
	  $diary =$doc->diary;
	  }
	  if(request()->cover){
	  $cover = time().'.'.request()->cover->getClientOriginalExtension();
      request()->cover->move(public_path('uploads'), $cover);
	  }else{
	  $cover=$doc->cover;
	  }
	  $center=auth()->guard('center')->id();
	  
        
        $doc->update(['university' => request()->university, 'collage' => request()->collage, 'year' => request()->year, 'subject' => request()->subject, 'diary' => $diary, 'coast' => request()->coast,
		'cover' => $cover, 'center' => $center]);

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
        $document = Documents::findOrFail($id);

        return view('document.delete', compact('document'));
    }

    // delete role
    public function delete($id)
    {
        $doc = Documents::findOrFail($id);
        $doc->delete();

        //activity('Deleted Role', $role->toArray(), $role);

        return response()->json([
            'flash' => ['success', 'تم الحذف بنجاح!'],
            'dismiss_modal' => true,
            'reload_datatables' => true,
        ]);
    }
}
