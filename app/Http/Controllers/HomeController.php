<?php

namespace App\Http\Controllers;

use session;
use App\Models\Task;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $task = Task::where('user_id', Auth::id())->whereNull('deleted_at')->get();
        return view('content.home', compact('task'));
    }
    public function addTask(Request $request)
    {
        $data = [
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => null,
            'deleted_at' => null,
        ];

        $result = Task::insert($data);

        if($result){
            return response()->json(['Error' => 0, 'Message' => 'Successfully added a Task.']);
        }
    }
    public function editTask(Request $request)
    {
        $data = [
            'title' => $request->title_update,
            'description' => $request->description_update,
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $result = Task::where('id',$request->id_update)->update($data);

        if ($result){
            return response()->json(['Error' => 0, 'Message' => 'Task Successfully Updated.']);
        }
    }
    public function deleteTask(Request $request)
    {
        $data = [
            'deleted_at' => date('Y-m-d H:i:s'),
        ];
        $result = Task::where('id',$request->id)->update($data);

        if($result){
            return response()->json(['Error' => 0, 'Message' => 'Task Successfully Deleted.']);
        }
    }
}
