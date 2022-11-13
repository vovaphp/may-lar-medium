<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ValidTask;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks= Task::all();
        Task::checkOwnerAuthorise($tasks);
        return view('tasks.index',[
            'tasks' => $tasks,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidTask $request)
    {
/*        $this->validate($request,[
            'name'=>'required|max:255',
        ]);*/
        $user=Auth::user();
        $user->tasks()->create([
            'name'=>$request->name,
        ]);

/*        $task = new Task();
        $task->name = '';
        $task->user_id=$user->id;
        $task->save();

        Task::create([
            name=>'',
            user_id=>$user->id,
        ]);*/

        return redirect(route('task.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $this->authorize('owner',$task);
        return view('tasks.edit',[
            'task' => $task,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\ValidTask  $request
     * @param  App\Models\Task  $id
     */
    public function update(ValidTask $request, Task $task)
    {
        $this->authorize('owner',$task);
        $task->name = $request->name;
        $task->save();
        return redirect(route('task.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Task $task
     */
    public function destroy(Task $task)
    {
        $this->authorize('owner',$task);
        $task->delete();
        return redirect(route('task.index'));
    }
}
