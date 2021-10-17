@extends('layouts.appadmin')
@section('title')
    Catagories
@endsection
@section('content')
    {{Form::hidden('', $increment=1)}}
<div class="card">
    <div class="card-body">
      <h4 class="card-title">Catagories</h4>
      @if (Session::has('status'))
      <div class="alert alert-success">
        {{Session::get('status')}}
      </div>
  @endif
      <div class="row">
        <div class="col-12">
          <div class="table-responsive">
            <table id="order-listing" class="table">
              <thead>
                <tr>
                    <th>Order #</th>
                    <th>Catagory Name</th>
                    <th>Actions</th>
                </tr>
              </thead>
              <tbody>
              @foreach ($catagories as $catagory)
              <tr>
                <td>{{$increment}}</td>
                <td>{{$catagory->catagory_name}}</td>
                <td>
                  <button class="btn btn-outline-primary" onclick="window.location='{{url('/edit_catagory/'.$catagory->id)}}'">Edit</button>
                  <a href="/delete/{{$catagory->id}}" class="btn btn-outline-danger" id="delete">Delete</a>
                </td>
            </tr>
            {{Form::hidden('', $increment=$increment+1)}}
              @endforeach

                
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection
@section('scripts')
    <script src="{{asset('backend/js/data-table.js')}}"></script>
@endsection