@extends('layouts.app')

@section('content')
<div class="row">
<div class="col-sm-12">
    @if (count($errors) > 0)
                    <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if( Session::has('success') )
                    <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{Session::get('success')}}</div>
                @endif

</div>
</div>

<!-- Button trigger modal -->
 <div class="box box-danger">
        <div class="box-header with-border">Add new Set</div>
        <div class="box-body">
             <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal">
                 Add New Set
             </button>
        </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add New User</h4>
      </div>
       {!! Form::open(['url'=>url('/').'/sets','files'=>true]) !!}
       <div class="modal-body">
          <div class="box box-primary">
             <div class="box-body">
                 <div class="col-md-12">
                     <div class="form-group">
                        {!! Form::label('title','Title') !!}
                        {!! Form::text('title',null,['class'=>'form-control']) !!}
                     </div>
                     <div class="form-group">
                        {!! Form::label('description','Description') !!}
                        {!! Form::textarea('description',null,['class'=>'form-control']) !!}
                     </div>
                  
                     <div class="form-group">
                        {!! Form::label('img','Image') !!}
                        {!! Form::file('img') !!}
                     </div>
                 </div>
             </div>
         </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         {!! Form::submit('Add',['class'=>'btn btn-success']) !!}
      </div>

                {!! Form::close() !!}
    </div>
  </div>
</div>

<div class="col-sm-12"><table id="sets" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="sets_info">
                <thead>
                <tr role="row">
                    <th class="sorting_asc" tabindex="0" aria-controls="sets" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Set Title">Title</th>
                    <th class="sorting" tabindex="0" aria-controls="sets" rowspan="1" colspan="1" aria-label="Set Image">Image</th>
                    <th class="sorting" tabindex="0" aria-controls="sets" rowspan="1" colspan="1" aria-label="Set Status">Status</th>
                    <th class="sorting" tabindex="0" aria-controls="sets" rowspan="1" colspan="1" aria-label="Last Updated time">Date Updated</th>
                    <th class="sorting" tabindex="0" aria-controls="sets" rowspan="1" colspan="1" aria-label="Creation Date">Date Created</th>
                    <th class="sorting" tabindex="0" aria-controls="sets" rowspan="1" colspan="1" aria-label="Manage Sets">Manage</th>
                </tr>
                </thead>
                <tbody>
                   @foreach( $sets as $set )
                <tr role="row" @if($set->id%2==0)class="odd"@else class="odd" @endif>
                  <td class="sorting_1">{{$set->title}}</td>
                  <td><img src="public/imgs/{{$set->img}}" alt="{{$set->title}}" class="img-responsive"></td>
                  <td>
                  <label class="switch">
  @if($set->status==1) 
 
 <a class="btn btn-success btn-xs " href="{{ url('set/disable/'.$set->id) }}"  data-toggle="tooltip" data-placement="bottom" title="Click here to disable" >Enabled</a>
   @else 
   <a class="btn btn-danger btn-xs " href="{{ url('set/enable/'.$set->id) }}" data-toggle="tooltip" data-placement="bottom" title="Click here to enable">Disabled</a>
    @endif

</label>
                  </td>
                   <td>{{$set->created_at}}</td>
                   <td>{{$set->updated_at}}</td>
                  <td>
                      <a href="{{ url('set/edit/'.$set->id) }}"  class="btn btn-info">
                          Edit
                      </a>
                      <a href="{{ url('set/delete/'.$set->id) }}" class="btn btn-danger">
                          Delete
                      </a>
                  </td>
                </tr>
                @endforeach
               </tbody>
                <tfoot>
                <tr><th rowspan="1" colspan="1">Title</th><th rowspan="1" colspan="1">Browser</th><th rowspan="1" colspan="1">Platform(s)</th><th rowspan="1" colspan="1">Engine version</th><th rowspan="1" colspan="1">Manage</th></tr>
                </tfoot>
              </table></div>
@endsection
