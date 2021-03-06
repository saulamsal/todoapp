<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodoItem extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'status', 'priority', 'author', 'todo_list', 'todo_list_id', 'deadline'];

    public function todoList()
    {
        return $this->hasOne(\App\Models\TodoList::class, 'id', 'todo_list_id');
    }
}
