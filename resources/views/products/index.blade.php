@extends('layouts.layoutAdmin')

@section('contend-header')
<h1>
    Products
    <small>List</small>
</h1>
<ol class="breadcrumb">
    <li><a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><i class="fa fa-dashboard"></i> Product</li>      
</ol>            
</section>  
@endsection

@section('content')
<div class="row">
  <div class="col-xs-12">	
    <div class="box box-warning">
      <div class="box-header with-border">
        <h2 class="box-title">Products</h2>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <a href="{{ url('product/create') }}"><button class="btn btn-warning">Create New Product</button></a>
        <label>
          @if(Session::has('success'))
            <p style="color: red;font-weight: bold">{{ Session::get('success') }}</p>
          @endif
        </label>
      </div>
      <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>          
          <tr>
            <th>Name</th>            
            <th>Description</th>            
            <th>Code Group</th>
            <th>Group</th>
            <th>Created Time</th>
            <th>Updated Time</th>
            <th>Action</th>            
          </tr>
          </thead>
          <tbody>
          @foreach($data['dataProduct'] as $value)
          <tr>
            <td>{{ $value->name_product_group }}</td>            
            <td>{{ $value->description }}</td>
            <td>{{ $value->code_product_group }}</td>
            <td></td>
            <td>{{ $value->created_at }}</td>
            <td>{{ $value->updated_at }}</td>
            <td>
                <a href="{{ url('product/edit') }}/{{ $value->id }}">Edit </a> | 
                <a href="{{ url('product/delete') }}/{{$value->id}}"> Delete</a>
            </td>
          </tr>
          @endforeach
          </tbody>          
          
        </table>
      </div>
      <!-- /.box-body -->
    </div>
  </div>
</div>
@endsection