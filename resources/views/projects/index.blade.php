@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Projects Management</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('projects.create') }}"> Create New Project</a>
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
 @foreach ($data as $key => $pro)
  <tr>
    <td>{{ ++$i }}</td>
    <td>{{ $pro->name }}</td>
   <td>
       <a class="btn btn-info" href="{{ route('projects.show',$pro->id) }}">Show</a>
       <a class="btn btn-primary" href="{{ route('projects.edit',$pro->id) }}">Edit</a>
        {!! Form::open(['method' => 'DELETE','route' => ['projects.destroy', $pro->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
    </td>
  </tr>
 @endforeach
</table>


{!! $data->render() !!}


@endsection