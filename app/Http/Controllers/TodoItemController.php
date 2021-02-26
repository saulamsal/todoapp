<?php

namespace App\Http\Controllers;

use App\Models\TodoItem;
use App\Models\TodoList;

use Illuminate\Http\Request;

class TodoItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $validateData = $request->validate([
            'title' => 'required||max:255',
            'deadline' => 'required'
        ]);

        $toDoListID = null;

        if ($request->todo_list_value) {
            $hasToDoListAlready = TodoList::where('title', $request->todo_list_value)->first();
            if (!($hasToDoListAlready)) {
                $newToDo =
                    TodoList::create([
                        'title' => $request->todo_list_value,
                    ]);
            }
            $toDoListID = TodoList::where('title', $request->todo_list_value)->pluck('id')->first();
        } else {
            $toDoListID = TodoList::where('title', "Untitled")->pluck('id')->first();
            if (!$toDoListID) {
                \Illuminate\Support\Facades\DB::insert('insert into todo_lists (id, title) values (?, ?)', [0, 'Untitled']);
                $toDoListID = TodoList::where('title', "Untitled")->pluck('id')->first();
            }
        }


        $todo = TodoItem::create([
            'title' => $request->title,
            'status' => 0,
            'priority' => $request->priority ?  $request->priority : 'medium',
            'author' => $request->author ? $request->author : NULL,
            'todo_list_id' => (int)$toDoListID,
            'deadline' => $request->deadline ?  $request->deadline : NULL
        ]);

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TodoItem  $todoItem
     * @return \Illuminate\Http\Response
     */
    public function show(TodoItem $todoItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TodoItem  $todoItem
     * @return \Illuminate\Http\Response
     */
    public function edit(TodoItem $todoItem)
    {
        //
        //
        $toDoList = TodoList::latest()->get();
        return view('todoitem.edit')->with('todoItem', $todoItem)->with('toDoList', $toDoList);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TodoItem  $todoItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TodoItem $todoItem)
    {
        //
        $todoItem->update($request->all());
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TodoItem  $todoItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(TodoItem $todoItem)
    {
        //
        $todoItem->delete();
        return redirect('/');
    }
}
