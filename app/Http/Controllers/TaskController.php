<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{

    public function index()
    {
        return view('tasks');
    }

    public function read() {
        $user = Auth::user();
        $tasks = $user->tasks;
        return $tasks;
    }

    public function save() {
        $user = Auth::user();

        $id = request('id');
        $text = request('text', '');

        $task = Task::findOrFail($id);

        if ($task->user_id !== $user->id) {
            abort(500);
        }

        $task->text = $text;
        $task->save();

        return [];

    }

    public function create() {
        $user = Auth::user();
        $task = new Task;
        $task->text = '';

        $user->tasks()->save($task);

        return $task;
    }

    public function delete() {
        $user = Auth::user();
        $id = request('id');

        $task = Task::findOrFail($id);

        if ($task->user_id !== $user->id) {
            abort(500);
        }

        $task->delete();

        return [];
    }
}
