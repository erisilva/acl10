<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Perpage;
use Illuminate\Http\Request;

use Illuminate\View\View;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $this->authorize('log-index');

        if(request()->has('perpage')) {
            session(['perPage' => request('perpage')]);
        }

        return view('logs.index', [
            'logs' => Log::orderBy('id', 'desc')->paginate(session('perPage', '5')),
            'perpages' => Perpage::orderBy('valor')->get()
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Log $log) : View
    {
        $this->authorize('log-show');

        return view('logs.show', [
            'log' => $log
        ]);
    }

}
