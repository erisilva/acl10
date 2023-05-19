<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use Illuminate\View\View;

use App\Models\Permission;
use App\Models\Perpage;

use Barryvdh\DomPDF\Facade\Pdf; // Export PDF

class PermissionController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $this->authorize('permission-index');

        if(request()->has('perpage')) {
            session(['perPage' => request('perpage')]);
        }

        return view('permissions.index', [
            'permissions' => Permission::orderBy('name', 'asc')->filter(request(['name','description']))->paginate(session('perPage', '5'))->appends(request(['name', 'description'])),
            'perpages' => Perpage::orderBy('valor')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        $this->authorize('permission-create');

        return view('permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse
    {
        $this->authorize('permission-create');

        // Nota: o $request->validate([...]) retorna só os campos que forem validados na lista
        // usar o $request->all(); para pegar todos os campos
        $permission = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
          ]);
  
        Permission::create($permission);

        return redirect(route('permissions.index'))->with('message', __('Permission created successfully!'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function show(Permission $permission) : View
    {
        $this->authorize('permission-show');

        return view('permissions.show', [
          'permission' => $permission
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission) : View
    {
        $this->authorize('permission-edit');

        return view('permissions.edit', [
          'permission' => $permission
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission) : RedirectResponse
    {
        $this->authorize('permission-edit');

        $input = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
          ]);
  
        $permission->update($input);

        return redirect(route('permissions.index'))->with('message', __('Permission updated successfully!'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission) : RedirectResponse
    {
        $this->authorize('permission-delete');

        $permission->roles()->detach();

        $permission->delete();

        return redirect(route('permissions.index'))->with('message', __('Permission deleted successfully!'));
        
    }

    /**
     * Export the specified resource to PDF.
     */
    public function exportpdf() : \Illuminate\Http\Response
    {
        $this->authorize('permission-export');

        return Pdf::loadView('permissions.report', [
            'dataset' => Permission::orderBy('id', 'asc')->filter(request(['name', 'description']))->get()
        ])->download(__('Permissions') . '_' .  date("Y-m-d H:i:s") . '.pdf');
    }   
}
