@extends('app')
@section('content')


<div class="w-100  d-flex justify-content-center align-items-center flex-column">
    <h1 class="w-100 mb-4 text-center">Guideline Center toDo</h1>
</div>


<h3 class="text-left text-info">
				Add a todo list
			</h3>

                <form class="d-block w-100" action="{{ route('todo_list.store') }}" method="POST">
                    @csrf
    <input name="todolistsingle" type="text" class="form-control w-100" placeholder="Your todo list" 
  aria-label="Your todo list" aria-describedby="basic-1" required>

  <div class="input-group-append w-100">
    <button class="btn btn-primary mt-4" type="submit" name="todolistsubmit">Create a new list</button>
  </div>


</form>







      @foreach($toDoList as $todoListCat)
<div class="wrapper-todo_list">
 <div class="text-success font-weight-bold h4">{{ $todoListCat->title }}</div></div>
         
         
@endforeach


@endsection