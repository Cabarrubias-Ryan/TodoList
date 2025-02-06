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
        return view('content.home');
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
            return response()->json(['Error' => 0, 'Message' => 'Successfully added a Task']);
        }
    }
}
