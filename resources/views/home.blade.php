@extends('app')
@section('content')


<div class="w-100  d-flex justify-content-center align-items-center flex-column">
    <h1 class="w-100 mb-4 text-center">Guideline Center toDo</h1>
</div>






    <form class="d-block w-100" action="{{ route('todo_item.store') }}" method="POST">
    @csrf
        <div class="input-group mb-3 w-200">

  <input name="title"  type="text" class="form-control w-100" placeholder="Whats on your mind?" 
  aria-label="Whats on your mind?" aria-describedby="basic-1" required>


    <input name="author" type="text" class="form-control" placeholder="Author" 
  aria-label="Author" aria-describedby="basic-2">


  <input  name="deadline" type="datetime-local" id="deadline"
       value="Due time"
       min="2021-01-07T00:00" max="2022-12-14T00:00" required>

  

<label>To do List
<input list="todo_list_value" name="todo_list_value" /></label>
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



  <div class="input-group-append w-100 ">
    <button class="btn btn-primary mt-4" type="submit" name="todoitemsubmit">Create new todo item</button>
  </div>
</div>

    </form>








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


     
<a class="border-0 bg-transparent edit-btn" href="{{ route('todo_list.edit', $todoListCat->id) }}">
  <svg class="svg-icon d-inline" viewBox="0 0 20 20"> <path d="M18.303,4.742l-1.454-1.455c-0.171-0.171-0.475-0.171-0.646,0l-3.061,3.064H2.019c-0.251,0-0.457,0.205-0.457,0.456v9.578c0,0.251,0.206,0.456,0.457,0.456h13.683c0.252,0,0.457-0.205,0.457-0.456V7.533l2.144-2.146C18.481,5.208,18.483,4.917,18.303,4.742 M15.258,15.929H2.476V7.263h9.754L9.695,9.792c-0.057,0.057-0.101,0.13-0.119,0.212L9.18,11.36h-3.98c-0.251,0-0.457,0.205-0.457,0.456c0,0.253,0.205,0.456,0.457,0.456h4.336c0.023,0,0.899,0.02,1.498-0.127c0.312-0.077,0.55-0.137,0.55-0.137c0.08-0.018,0.155-0.059,0.212-0.118l3.463-3.443V15.929z M11.241,11.156l-1.078,0.267l0.267-1.076l6.097-6.091l0.808,0.808L11.241,11.156z"></path> </svg>
</a>


    <form class=" d-inline" action="{{ route('todo_list.destroy', $todoListCat->id) }}" method="POST">
  @method('DELETE')
  @csrf

<button class="border-0  bg-transparent delete-btn" type="submit">
  <svg class="svg-icon d-inline" viewBox="0 0 20 20"> <path d="M17.114,3.923h-4.589V2.427c0-0.252-0.207-0.459-0.46-0.459H7.935c-0.252,0-0.459,0.207-0.459,0.459v1.496h-4.59c-0.252,0-0.459,0.205-0.459,0.459c0,0.252,0.207,0.459,0.459,0.459h1.51v12.732c0,0.252,0.207,0.459,0.459,0.459h10.29c0.254,0,0.459-0.207,0.459-0.459V4.841h1.511c0.252,0,0.459-0.207,0.459-0.459C17.573,4.127,17.366,3.923,17.114,3.923M8.394,2.886h3.214v0.918H8.394V2.886z M14.686,17.114H5.314V4.841h9.372V17.114z M12.525,7.306v7.344c0,0.252-0.207,0.459-0.46,0.459s-0.458-0.207-0.458-0.459V7.306c0-0.254,0.205-0.459,0.458-0.459S12.525,7.051,12.525,7.306M8.394,7.306v7.344c0,0.252-0.207,0.459-0.459,0.459s-0.459-0.207-0.459-0.459V7.306c0-0.254,0.207-0.459,0.459-0.459S8.394,7.051,8.394,7.306"></path> </svg>
</button>
</form>
  
</div>
</div>
         




         @php
        $tmp = \App\Models\TodoItem::where('todo_list_id',$todoListCat->id )->latest()->get();
        @endphp

        @if(count($tmp))

<div class="table-responsive">
  <table class="table table-borderless table-sm table-light ">
    <thead>
      <tr>
        {{-- <th scope="col">#</th> --}}
                {{-- <th scope="col"></th> --}}
        <th scope="col">To do</th>
             <th scope="col">Priority</th>
        <th scope="col">Author</th>
         <th scope="col">Due</th>
       <th scope="col">Modify</th>
    <th scope="col">Postings</th>
      </tr>
    </thead>
    <tbody>


          @foreach($tmp as $todoListItem)

          @php 
$priority = null;

  switch($todoListItem->priority) {
 case '3':
   $priority = "High";
       break;

  case '2':
       $priority = "Medium";
        break;

  default:
    $priority = "Low";
}

@endphp



        <tr class=" @if($todoListItem->status == 1) 
 is-completed 
 @endif 
 ">


        <td class="font-weight-bold">{{ $todoListItem->title }}</td>
                <td >{{ $priority }}</td>
        <td>{{ $todoListItem->author }}</td>
        <td>{{ $todoListItem->deadline }}</td>
        


        <td>
           <td class="text-center">





<a class="border-0 bg-transparent edit-btn" href="{{ route('todo_item.edit', $todoListItem->id) }}">
  <svg class="svg-icon d-inline" viewBox="0 0 20 20"> <path d="M18.303,4.742l-1.454-1.455c-0.171-0.171-0.475-0.171-0.646,0l-3.061,3.064H2.019c-0.251,0-0.457,0.205-0.457,0.456v9.578c0,0.251,0.206,0.456,0.457,0.456h13.683c0.252,0,0.457-0.205,0.457-0.456V7.533l2.144-2.146C18.481,5.208,18.483,4.917,18.303,4.742 M15.258,15.929H2.476V7.263h9.754L9.695,9.792c-0.057,0.057-0.101,0.13-0.119,0.212L9.18,11.36h-3.98c-0.251,0-0.457,0.205-0.457,0.456c0,0.253,0.205,0.456,0.457,0.456h4.336c0.023,0,0.899,0.02,1.498-0.127c0.312-0.077,0.55-0.137,0.55-0.137c0.08-0.018,0.155-0.059,0.212-0.118l3.463-3.443V15.929z M11.241,11.156l-1.078,0.267l0.267-1.076l6.097-6.091l0.808,0.808L11.241,11.156z"></path> </svg>
</a>




<form class=" d-inline" action="{{ route('todo_item.destroy', $todoListItem->id) }}" method="POST">
  @method('DELETE')
  @csrf

<button class="border-0 bg-transparent delete-btn d-inline" type="submit">
  <svg class="svg-icon d-inline" viewBox="0 0 20 20"> <path d="M17.114,3.923h-4.589V2.427c0-0.252-0.207-0.459-0.46-0.459H7.935c-0.252,0-0.459,0.207-0.459,0.459v1.496h-4.59c-0.252,0-0.459,0.205-0.459,0.459c0,0.252,0.207,0.459,0.459,0.459h1.51v12.732c0,0.252,0.207,0.459,0.459,0.459h10.29c0.254,0,0.459-0.207,0.459-0.459V4.841h1.511c0.252,0,0.459-0.207,0.459-0.459C17.573,4.127,17.366,3.923,17.114,3.923M8.394,2.886h3.214v0.918H8.394V2.886z M14.686,17.114H5.314V4.841h9.372V17.114z M12.525,7.306v7.344c0,0.252-0.207,0.459-0.46,0.459s-0.458-0.207-0.458-0.459V7.306c0-0.254,0.205-0.459,0.458-0.459S12.525,7.051,12.525,7.306M8.394,7.306v7.344c0,0.252-0.207,0.459-0.459,0.459s-0.459-0.207-0.459-0.459V7.306c0-0.254,0.207-0.459,0.459-0.459S8.394,7.051,8.394,7.306"></path> </svg>
</button>
</form>



                             </td>
                             
        </td>

      

<td> 
<div>Created at: {{ $todoListItem->created_at }} </div>
<div>Updated at: {{ $todoListItem->updated_at }}</div>  
</td>

 </tr>
         @endforeach



         </tbody>

  </table>
</div>


@else 

<div class="font-weight-bold font-italic">No any entries yet.</div>
        @endif




        
@endforeach






@endsection