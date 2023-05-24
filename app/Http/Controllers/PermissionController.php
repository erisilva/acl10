<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use Illuminate\View\View;

use App\Models\Permission;
use App\Models\Perpage;
use App\Models\Log;

use Barryvdh\DomPDF\Facade\Pdf; // Export PDF

use App\Exports\PermissionsExport;
use Maatwebsite\Excel\Facades\Excel; // Export Excel

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

        $permission = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
          ]);
  
        $new_permission = Permission::create($permission);

        // LOG
        Log::create([
            'model_id' => $new_permission->id,
            'model' => 'Permission',
            'action' => 'store',
            'changes' => json_encode($new_permission),
            'user_id' => auth()->id(),            
        ]);

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

        // LOG
        Log::create([
            'model_id' => $permission->id,
            'model' => 'Permission',
            'action' => 'update',
            'changes' => json_encode($permission->getChanges()),
            'user_id' => auth()->id(),            
        ]);

        return redirect(route('permissions.index'))->with('message', __('Permission updated successfully!'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission) : RedirectResponse
    {
        $this->authorize('permission-delete');

        // LOG
        Log::create([
            'model_id' => $permission->id,
            'model' => 'Permission',
            'action' => 'destroy',
            'changes' => json_encode($permission),
            'user_id' => auth()->id(),            
        ]);

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
    
    /**
     * Export the specified resource to Excel.
     */
    public function exportcsv() : \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $this->authorize('permission-export');

        return Excel::download(new PermissionsExport(request(['name', 'description'])),  __('Permissions') . '_' .  date("Y-m-d H:i:s") . '.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    /**
     * Export the specified resource to Excel.
     */
    public function exportxls() : \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $this->authorize('permission-export');

        return Excel::download(new PermissionsExport(request(['name', 'description'])),  __('Permissions') . '_' .  date("Y-m-d H:i:s") . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }
}
