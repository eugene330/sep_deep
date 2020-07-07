<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * @var User
     */
    protected $user;

    public function __construct()
    {
        $this->middleware('auth');
        $this->user = Auth::user();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$tasks = Task::all();  Выбор всех задач всех пользователей
        $tasks = $this->user->tasks; // $this->>user->tasks()->get();
        return view('tasks.index', ['tasks' => $tasks]);
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

//        $userId = Auth::user()->id;
//
//        $task = new Task();
//        $task->name = $request->name;
//        $task->user_id = $userId;
//        $task->save();
//
        //===================================================
//        $user = Auth::user();
        $this->user
            ->tasks()
            ->create(
                [
                    'name' => $request->name,
                ]); //конструктор запроса!!! с уловием user_id текушего пользователя
        return redirect()->route('tasks.index');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $tasks)
    {
        $this->authorize('edit', $tasks);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Task $tasks
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $tasks)
    {
        $this->authorize('destroy', $tasks);

        $tasks->delete();
        return redirect()->route('tasks.index');
    }
}
