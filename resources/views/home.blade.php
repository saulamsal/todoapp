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
 <div class="text-success font-weight-bold h4">{{ $todoListCat->title }}

</div>
</div>
       

    <form class=" d-inline" action="{{ route('todo_list.destroy', $todoListCat->id) }}" method="POST">
  @method('DELETE')
  @csrf

<button class="border-0  delete-btn" type="submit">
  <svg class="svg-icon d-inline" viewBox="0 0 20 20"> <path d="M17.114,3.923h-4.589V2.427c0-0.252-0.207-0.459-0.46-0.459H7.935c-0.252,0-0.459,0.207-0.459,0.459v1.496h-4.59c-0.252,0-0.459,0.205-0.459,0.459c0,0.252,0.207,0.459,0.459,0.459h1.51v12.732c0,0.252,0.207,0.459,0.459,0.459h10.29c0.254,0,0.459-0.207,0.459-0.459V4.841h1.511c0.252,0,0.459-0.207,0.459-0.459C17.573,4.127,17.366,3.923,17.114,3.923M8.394,2.886h3.214v0.918H8.394V2.886z M14.686,17.114H5.314V4.841h9.372V17.114z M12.525,7.306v7.344c0,0.252-0.207,0.459-0.46,0.459s-0.458-0.207-0.458-0.459V7.306c0-0.254,0.205-0.459,0.458-0.459S12.525,7.051,12.525,7.306M8.394,7.306v7.344c0,0.252-0.207,0.459-0.459,0.459s-0.459-0.207-0.459-0.459V7.306c0-0.254,0.207-0.459,0.459-0.459S8.394,7.051,8.394,7.306"></path> </svg>
</button>
</form>
  
         
@endforeach


@endsection