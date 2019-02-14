<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kjdion84\Laraback\Traits\ValidateAjax;
use App\Blog;
use DB;
use DataTables;
class BlogController extends Controller
{
     use ValidateAjax;
	

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:Browse Roles')->only(['index', 'indexDatatable']);
        $this->middleware('can:Add Roles')->only(['addModal', 'add']);
        $this->middleware('can:Edit Roles')->only(['editModal', 'edit']);
        $this->middleware('can:Delete Roles')->only(['deleteModal', 'delete']);
    }

    // roles index with table
    public function index()
    {
        return view('blogs.index');
    }

    // roles index datatable
    public function indexDatatable()
    {
		
        $query = DB::table('blogs');

		return DataTables::of($query)->toJson();
    }

    // show add role modal
    public function addModal()
    {
       

        return view('blogs.add');
    }

    // add role
    public function add()
    {
        $this->validateAjax(request(), [
            'name' => 'required',
        ]);

      

		$blog=DB::table('blogs')->insert(
    ['name' => request()->name]
);


       // activity('Added Blog', request()->name, $blog);

        return response()->json([
            'flash' => ['success', 'Blog added!'],
            'dismiss_modal' => true,
            'reload_datatables' => true,
        ]);
    }

    // show edit role modal
    public function editModal($id)
    {
        $blog = Blog::findOrFail($id);

        return view('blogs.edit', compact('blog'));
    }

    // edit role
    public function edit($id)
    {
        $this->validateAjax(request(), [
            'name' => 'required',
        ]);

        $blog = Blog::findOrFail($id);
        $blog->update(request()->all());

        //activity('Edited Blog', request()->all(), $role);

        return response()->json([
            'flash' => ['success', 'Blog edited!'],
            'dismiss_modal' => true,
            'reload_datatables' => true,
        ]);
    }

    // show delete role modal
    public function deleteModal($id)
    {
        $blog = Blog::findOrFail($id);

        return view('blogs.delete', compact('blog'));
    }

    // delete role
    public function delete($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        //activity('Deleted Role', $role->toArray(), $role);

        return response()->json([
            'flash' => ['success', 'Blog deleted!'],
            'dismiss_modal' => true,
            'reload_datatables' => true,
        ]);
    }
}