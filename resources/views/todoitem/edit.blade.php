@extends('app')
@section('content')
<div class="w-100  d-flex justify-content-center align-items-center flex-column">
    <h1 class="w-100">Edit toDo Item titled "{{ $todoItem->title }}"</h1>

</div>


        <form class="d-block w-100" action="{{ route('todo_item.update', $todoItem->id) }}" method="POST">
    @csrf
    @method('PUT')


        <div class="input-group mb-3 w-200">

  <input name="title" type="text" class="form-control w-100" value="{{  $todoItem->title }}"  required>


    <input name="author" type="text" class="form-control" value={{ $todoItem->author  }}>


  <input  name="deadline" type="datetime-local" id="deadline"
       value="{{ $todoItem->deadline  }}"
       min="2021-01-07T00:00" max="2022-12-14T00:00" required>


<label>To do List
<input list="todo_list_value" name="todo_list_value"  

value="{{  $todoItem->todoList->title }}"
 /></label>
<datalist id="todo_list_value">

          @foreach($toDoList as $todoListCat)
  <option value="{{ $todoListCat->title }}">
          @endforeach
</datalist>

<label>Priority</label>
<select class="priority" name="priority" size="3">
  <option value="1">Low</option>
  <option selected value="2">Medium</option>
  <option value="3">High</option>
</select>



  <div class="input-group-append w-100">
    <button class="btn btn-primary" type="submit" name="todoitemsubmit">Update todo item</button>
  </div>
</div>

    </form>




</div>


   


</div>
@endsection
