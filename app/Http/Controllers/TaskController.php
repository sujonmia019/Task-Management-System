<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use Illuminate\Support\Facades\DB;
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
                ->filter(function ($query) use ($request) {
                    if (!empty($request->status)) {
                        $query->where('status', $request->status);
                    }
                    if (!empty($request->priority)) {
                        $query->where('priority', $request->priority);
                    }
                    if (!empty($request->start_date) && !empty($request->end_date)) {
                        $query->whereDate('created_at','>=',$request->start_date)
                            ->whereDate('created_at','<=',$request->end_date);
                    }
                })
                ->addColumn('status', function($row){
                    return STATUS_LABEL[$row->status];
                })
                ->addColumn('priority', function($row){
                    return PRIORITY_LABEL[$row->priority];
                })
                ->addColumn('due_date', function($row){
                    return $row->due_date ? dateFormat($row->due_date) : '';
                })
                ->addColumn('created_at', function($row){
                    return dateTimeFormat($row->created_at);
                })
                ->addColumn('action', function($row){
                    $action = '<div class="d-flex align-items-center">';
                        $action .= '<button type="button" class="btn-style btn-style-edit edit_data me-1" data-id="' . $row->id . '"><i class="fa fa-edit"></i></button>';
                        $action .= '<button type="button" class="btn-style btn-style-danger delete_data" data-id="' . $row->id . '" data-name="'.$row->title.'"><i class="fa fa-trash"></i></button>';
                    $action .= '</div>';
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
        if($request->ajax()){
            $data = Task::find($request->id);
            if($data){
                return response()->json(['status' => 'success', 'data' => $data]);
            }else{
                return response()->json(['status' => 'error', 'message' => 'Data not found']);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {
        if($request->ajax()){
            $result = Task::find($request->id);
            if($result){
                $result->delete();
                return response()->json(['status' => 'success', 'message' => 'Task deleted successfully.']);
            }else{
                return response()->json(['status' => 'error', 'message' => 'Data not found']);
            }
        }
    }

    public function listLayout(){
        $data['pendings']   = DB::table('tasks')->where(['status'=>1,'user_id'=>auth()->user()->id])->get();
        $data['inProgress'] = DB::table('tasks')->where(['status'=>2,'user_id'=>auth()->user()->id])->get();
        $data['completed']  = DB::table('tasks')->where(['status'=>3,'user_id'=>auth()->user()->id])->get();
        return view('task-list',$data);
    }

    public function storeOrUpdateTask(TaskRequest $request){
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
}
