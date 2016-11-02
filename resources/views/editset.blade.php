@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-sm-12 col-sm-offset-1">
          @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
  
        @endif

        @if( Session::has('success') )
            <div class="alert alert-success">{{Session::get('success')}}</div>
        @endif
  </div>
</div>
<div class="row">
    <div class="col-sm-9 col-sm-offset-1">
            {!! Form::model($set,['files'=>true]) !!}
            <div class="form-group">
                {!! Form::label('title','Title') !!}
                {!! Form::text('title',null,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('description','Email') !!}
                {!! Form::textarea('description',null,['class'=>'form-control']) !!}
            </div>
           
            <div class="form-group">
                {!! Form::label('img','Image') !!}
                {!! Form::file('img') !!}
            </div>

   
            {!! Form::submit('Edit',['class'=>'btn btn-success']) !!}
        {!! Form::close() !!}


    </div>

</div>



@endsection