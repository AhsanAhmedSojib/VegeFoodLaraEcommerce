@extends('layouts.appadmin')
@section('title')
    Add Catagory   
@endsection
@section('content')
<div class="row grid-margin">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Edit catagory</h4>

            {!!Form::open(['action'=>'CatagoryController@updatecatagory', 'class'=>'cmxform', 'method'=>'POST', 'id'=>'commentForm'])!!}
                  {{csrf_field()}}
                    <div class="form-group">
                        {{Form::hidden('id', $catagory->id)}}
                      {{Form::label('','Product Catagory', ['for'=>'cname'])}}
                      {{Form::text('catagory_name',$catagory->catagory_name,['class'=>'form-control', 'minlength'=>'2'])}}

                    </div>
                    {{Form::submit('Update', ['class'=>'btn-primary'])}}
            {!!Form::close()!!}
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')
    <script src="{{asset('backend/js/bt-maxLength.js')}}"></script>  
@endsection
