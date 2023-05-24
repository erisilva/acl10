<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

use App\Models\Role;
use App\Models\Perpage;
use App\Models\Permission;
use App\Models\Log;

use Barryvdh\DomPDF\Facade\Pdf;

use App\Exports\RolesExport;
use Maatwebsite\Excel\Facades\Excel;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $this->authorize('role-index');

        if(request()->has('perpage')) {
            session(['perPage' => request('perpage')]);
        }

        return view('roles.index', [
            'roles' => Role::orderBy('id', 'asc')->filter(request(['name', 'description']))->paginate(session('perPage', '5'))->appends(request(['name', 'description'])),
            'perpages' => Perpage::orderBy('valor')->get()
        ]);
    }

        /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        $this->authorize('role-create');

        return view('roles.create', [
            'permissions' => Permission::orderBy('name','asc')->get()
          ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse
    {
        $this->authorize('role-create');

        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
          ]);        
  
        DB::beginTransaction();
  
            try {
                $role = $request->all();

                $newRole = Role::create($role);

                if(isset($role['permissions']) && count($role['permissions'])){
                    foreach ($role['permissions'] as $key => $value) {
                        $newRole->permissions()->attach($value);
                    }
                }

                DB::commit();

                //LOG
                Log::create([
                    'model_id' => $newRole->id,
                    'model' => 'Role',
                    'action' => 'store',
                    'changes' => json_encode($newRole),
                    'user_id' => auth()->id(),            
                ]);
    
                return redirect(route('roles.index'))->with('message', __('Role created successfully!'));
  
            }catch(\Exception $e){
                DB::rollback();

                return redirect()->route('roles.index')->with('message', __('Error saving record!') . ' ' . $e->getMessage());
            }
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role) : View
    {
        $this->authorize('role-show');

        return view('roles.show', [
            'role' => $role
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role) : View
    {
        $this->authorize('role-edit');

        return view('roles.edit', [
            'role' => $role,
            'permissions' => Permission::orderBy('name','asc')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role) : RedirectResponse
    {
        $this->authorize('role-edit');

        $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'required|max:255',
          ]);        
  
          DB::beginTransaction();
  
          try{

            // recebe todos valores entrados no formulário
            $input = $request->all();

            // remove todos as permissões vinculadas a esse operador
            $role->permissions()->detach();

            // vincula os novas permissões desse operador
            if(isset($input['permissions']) && count($input['permissions'])){
                foreach ($input['permissions'] as $key => $value) {
                   $role->permissions()->attach($value);
                }
            }
                
            $role->update($input);

            // LOG
            Log::create([
                'model_id' => $role->id,
                'model' => 'Role',
                'action' => 'update',
                'changes' => json_encode($role->getChanges()),
                'user_id' => auth()->id(),            
            ]);
  
            DB::commit();
  
            return redirect(route('roles.index'))->with('message', __('Role updated successfully!'));
  
        }catch(\Exception $e){
            DB::rollback();

            return redirect()->route('roles.index')->with('message', __('Error saving record!') . ' ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role) : RedirectResponse
    {
        $this->authorize('role-delete');

        try{
            // LOG
            Log::create([
                'model_id' => $role->id,
                'model' => 'Role',
                'action' => 'destroy',
                'changes' => json_encode($role),
                'user_id' => auth()->id(),            
            ]);

            $role->permissions()->detach();

            $role->delete();

            return redirect()->route('roles.index')->with('message', __('Role deleted successfully!'));

        }catch(\Exception $e){
            return redirect()->route('roles.index')->with('message', __('Error deleting record!') . ' ' . $e->getMessage());
        }

    }

    /**
     * Export the specified resource to PDF.
     */
    public function exportpdf() : \Illuminate\Http\Response
    {
        $this->authorize('role-export');

        return PDF::loadView('roles.report', [
            'dataset' => Role::orderBy('id', 'asc')->filter(request(['name', 'description']))->get()
        ])->download(__('Roles') . '_' .  date("Y-m-d H:i:s") . '.pdf');
    }

    /**
     * Export the specified resource to XLS.
     */
    public function exportcsv() : \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $this->authorize('role-export');

        return Excel::download(new RolesExport(request(['name','description'])),  __('Roles') . '_' .  date("Y-m-d H:i:s") . '.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    /**
     * Export the specified resource to XLS.
     */
    public function exportxls() : \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $this->authorize('role-export');
        return Excel::download(new RolesExport(request(['name','description'])),  __('Roles') . '_' .  date("Y-m-d H:i:s") . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }
}
