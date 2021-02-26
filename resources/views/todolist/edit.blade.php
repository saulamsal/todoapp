@extends('app')
@section('content')
<div class="w-100  d-flex justify-content-center align-items-center flex-column">
    <h1 class="w-100">Edit toDo List titled "{{ $todoList->title }}"</h1>

</div>


                <form class="d-block w-100" action="{{ route('todo_list.update', $todoList->id) }}" method="POST">
    @csrf
    @method('PUT')
    <input name="title" type="text" class="form-control w-100" value="{{ $todoList->title }}" required>

  <div class="input-group-append w-100">
    <button class="btn btn-primary" type="submit" name="todolistsubmit">Update a todo list</button>
  </div>


</form>

</div>


   


</div>
@endsection
