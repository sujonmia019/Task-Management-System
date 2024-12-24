<?php

namespace App\Http\Controllers\API;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Requests\API\TaskRequest;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::where('user_id', auth()->id());
        $query->orderBy('due_date', $request->get('sort_by','ASC'));

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }
        if ($request->has('priority')) {
            $query->where('priority', $request->priority);
        }
        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        $perPage = $request->get('per_page',10);
        $data    = $query->paginate($perPage); // 10 default per page

        $data->getCollection()->transform(function ($task) {
            $task->status   = STATUS[$task->status];
            $task->priority = PRIORITY[$task->priority];
            return $task;
        });

        if($data->isNotEmpty()){
            return $this->response_json('success', 'Task retrieved successfull.',$data, 200);
        }else{
            return $this->response_json('error', 'No tasks found',null, 405);
        }
    }

    public function storeOrUpdate(TaskRequest $request)
    {
        $collection = collect($request->validated());
        $collection = $collection->merge(['user_id' => auth()->user()->id]);
        $data = Task::updateOrCreate(['id' => $request->id], $collection->all());

        if ($data) {
            return $this->response_json('success', 'Task created/updated successfully', $data,200);
        }else{
            return $this->response_json('error', 'Failed to create/update task',null,404);
        }
    }

    public function delete(int $id)
    {
        $data = Task::where(['id'=>$id,'user_id'=>auth()->id()])->first();
        if ($data) {
            $data->delete();
            return $this->response_json('success', 'Task deleted successfull.',null,200);
        }
        return $this->response_json('error', 'Task not found',null,404);
    }

}
