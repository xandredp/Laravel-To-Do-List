<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::orderBy('due_date', 'asc')->paginate(5);

        return view('tasks.index')->with('tasks', $tasks);
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
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255|min:3', 
            'description' => 'required|string|max:10000|min:10',
            'due_date' => 'required|date',
        ]);

        $task = new Task;

        $task->name = $request->name;
        $task->description = $request->description;
        $task->due_date = $request->due_date;

        $task->save();

        Session::flash('success', 'Created To Do Successfully');

        return redirect()->route('task.index');

        // switch($request->input('action')) {
        //     case 'delete':
        //         $task = Task::find($id);
        //         $task->delete();
        //         Session::flash('success', 'Deleted To Do');
        //         return redirect()->route('task.index');
        //         break;
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::find($id);
        $task->dueDateFormatting = false;

        return view('tasks.edit')->withTask($task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255|min:3', 
            'description' => 'required|string|max:10000|min:10',
            'due_date' => 'required|date',
        ]);

        $task = Task::find($id);

        $task->name = $request->name;
        $task->description = $request->description;
        $task->due_date = $request->due_date;

        $task->save();

        Session::flash('success', 'Saved To Do Successfully');

        return redirect()->route('task.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);

        $task->delete();

        Session::flash('success', 'Deleted To Do');

        return redirect()->route('task.index');
    }
}
