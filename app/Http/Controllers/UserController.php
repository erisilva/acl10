<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Perpage;

use Illuminate\Http\Request;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Barryvdh\DomPDF\Facade\Pdf;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $this->authorize('user-index');

        if(request()->has('perpage')) {
            session(['perPage' => request('perpage')]);
        }

        return view('users.index', [
            'users' => User::orderBy('name', 'asc')->filter(request(['name', 'email']))->paginate(session('perPage', '5'))->appends(request(['name', 'email'])),
            'perpages' => Perpage::orderBy('valor')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        $this->authorize('user-create');

        return view('users.create', [
            'roles' => Role::orderBy('description','asc')->get() 
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse
    {
        $this->authorize('user-create');

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed'
          ]);
    
          DB::beginTransaction();
    
          try{
    
              $user = $request->all();
              $user['active'] = 'y'; //set as active
              $user['password'] = Hash::make($user['password']);
              $user['email_verified_at'] = now();
    
              $newUser = User::create($user); 
    
              if(isset($user['roles']) && count($user['roles'])){
                  foreach ($user['roles'] as $key => $value) {
                      $newUser->roles()->attach($value);
                  }
              }
    
              DB::commit();
    
              return redirect(route('users.index'))->with('message',__('User created successfully!'));
    
          }catch(\Exception $e){
              DB::rollback();
              return redirect()->route('users.index')->with('message', __('Error saving record!') . $e->getMessage());
          }

    }

    /**
     * Display the specified resource.
     */
    public function show(User $user) : View
    {
        $this->authorize('user-show');

        return view('users.show', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user) : View
    {   
        $this->authorize('user-edit');

        return view('users.edit', [
            'user' => $user,
            'roles' => Role::orderBy('description','asc')->get() 
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user) : RedirectResponse
    {
        $this->authorize('user-edit');

        $this->validate($request, [
            'name' => 'required|max:255',
            'password' => 'nullable|min:6|max:255'
        ]);
    
        DB::beginTransaction();
    
        try{
    
            // update password only if informed
            if ($request->has('password') && (request('password') != "")) {
                $input = $request->all();
                $input['password'] = Hash::make($input['password']);
            } else {
                $input = $request->except('password');
            }   

            // update active
            if (isset($input['active'])) {
                $input['active'] = 'y';
            } else {
                $input['active'] = 'n';
            }

            // remove all roles from this user
            $user->roles()->detach();

            // add roles to this user
            if(isset($input['roles']) && count($input['roles'])){
                foreach ($input['roles'] as $key => $value) {
                    $user->roles()->attach($value);
                }
            }
    
            // update user
            $user->update($input);
    
            DB::commit();
    
            return redirect(route('users.edit', $user))->with('message', __('User updated successfully!'));
    
        }catch(\Exception $e){
            DB::rollback();
            return redirect()->route('users.index')->with('message', __('Error saving record!') . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user) : RedirectResponse
    {
        $this->authorize('user-delete');

        DB::beginTransaction();
    
        try{
    
            $user->roles()->detach();
            $user->delete();
    
            DB::commit();
    
            return redirect(route('users.index'))->with('message', __('User deleted successfully!'));
    
        }catch(\Exception $e){
            DB::rollback();
            return redirect()->route('users.index')->with('message', __('Error deleting record!') . $e->getMessage());
        }
    }

    /**
     * Export the specified resource to PDF.
     */
    public function exportpdf() : \Illuminate\Http\Response
    {
      $this->authorize('user-export');

      return PDF::loadView('users.report', [
          'dataset' => User::orderBy('name', 'asc')->filter(request(['name', 'email']))->get()
      ])->download(__('Users') . '_' .  date("Y-m-d H:i:s") . '.pdf');
    }

    /**
     * Export the specified resource to CSV.
     */
    public function exportcsv() : \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
      $this->authorize('user-export');

      return Excel::download(new UsersExport(request(['name','email'])), __('Users') . '_' .  date("Y-m-d H:i:s") . '.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    /**
     * Export the specified resource to XLSX.
     */
    public function exportxls() : \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
      $this->authorize('user-export');

      return Excel::download(new UsersExport(request(['name','email'])),  __('Users') . '_' .  date("Y-m-d H:i:s") . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }
}
