<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Task;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        if (\Auth::check()) {
            $user = \Auth::user();
            $tasks =  $user->tasks()->orderBy('created_at', 'desc')->paginate(10);
            
            $tasks = Task::where('user_id', $user->id)->get();

        return view('tasks.index', [
            'tasks' => $tasks,
             ]);
            
        }else {
            return view('welcome');
        }
       
       
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       if (\Auth::check()) {
       
        $task = new Task;

        return view('tasks.create', [
            'task' => $task,
        ]);
        
        
       }else{
           return view('welcome');
       }
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
            'status' => 'required|max:10',
            'content' => 'required|max:191',
        ]);
        $task = new Task;
        $task->status = $request->status;
        $task->content = $request->content;
        $task->user_id = \Auth::user()->id;
        $task->save();

        return redirect('/');
        /*if (\Auth::check()) {
        
         $user = \Auth::user();
         $user -> user();
        
        $this->validate($request, [
            'status' => 'required|max:10',
            'content' => 'required|max:191',
        ]);

         $request->user()->tasks()->create([
            'status' => $request->status,
            'content' => $request->content,
            
        ]);
       

        return redirect('/');
        
        }else{
            return view('welcome');
        }*/
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $task = Task::find($id);

        return view('tasks.show', [
            'task' => $task,
        ]);
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

        return view('tasks.edit', [
            'task' => $task,
        ]);
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
            'status' => 'required|max:10',
            'content' => 'required|max:191',
        ]);
        
        $task = Task::find($id);
        $task->status = $request->status;
        $task->content = $request->content;
        $task->save();

        return redirect('/');
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
        if (\Auth::user()->id === $task->user_id) {
        $task->delete();
        }
        return redirect('/');
    }
}
