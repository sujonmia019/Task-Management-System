<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $getData = Task::where('user_id',auth()->user()->id)->orderBy('created_at','desc');
            return DataTables::eloquent($getData)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $action = '<button type="button" class="btn-style btn-style-danger delete_data" data-id="' . $row->id . '"><i class="fa fa-trash"></i></button>';
                    return $action;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('home');
    }
}
