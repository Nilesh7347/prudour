@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Departments Management</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('departments.create') }}"> Create New Department</a>
        </div>
    </div>
</div>


@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif


<table class="table table-bordered">
 <tr>
   <th>No</th>
   <th>Name</th>
   <th width="280px">Action</th>
 </tr>
 @foreach ($data as $key => $deprmnt)
  <tr>
    <td>{{ ++$i }}</td>
    <td>{{ $deprmnt->name }}</td>
   <td>
       <a class="btn btn-info" href="{{ route('departments.show',$deprmnt->id) }}">Show</a>
       <a class="btn btn-primary" href="{{ route('departments.edit',$deprmnt->id) }}">Edit</a>
        {!! Form::open(['method' => 'DELETE','route' => ['departments.destroy', $deprmnt->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
    </td>
  </tr>
 @endforeach
</table>


{!! $data->render() !!}


@endsection