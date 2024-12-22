<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use Yajra\DataTables\Facades\DataTables;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $getData = Task::where('user_id',auth()->user()->id)->orderBy('created_at','desc');
            return DataTables::eloquent($getData)
                ->addIndexColumn()
                ->addColumn('status', function($row){
                    return STATUS_LABEL[$row->status];
                })
                ->addColumn('priority', function($row){
                    return PRIORITY_LABEL[$row->priority];
                })
                ->addColumn('due_date', function($row){
                    return dateTimeFormat($row->due_date);
                })
                ->addColumn('created_at', function($row){
                    return dateTimeFormat($row->created_at);
                })
                ->addColumn('action', function($row){
                    $action = '<button type="button" class="btn-style btn-style-danger delete_data" data-id="' . $row->id . '"><i class="fa fa-trash"></i></button>';
                    return $action;
                })
                ->rawColumns(['status','priority','action'])
                ->make(true);
        }
        return view('home');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function storeOrUpdate(TaskRequest $request)
    {
        if($request->ajax()){
            $collection = collect($request->validated());
            $collection = $collection->merge(['user_id' => auth()->user()->id]);
            $result = Task::updateOrCreate(['id' => $request->update_id], $collection->all());

            if ($result) {
                return response()->json(['status' => 'success', 'message' => 'Task added successfully.']);
            }
            return response()->json(['status' => 'error', 'message' => 'Data could not be saved!']);

        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {
        //
    }
}
