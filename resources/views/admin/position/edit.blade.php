<div class="modal-dialog modal-sm" role="document">
    <div class="panel panel-default">
        <div class="{{\Illuminate\Support\Facades\Lang::locale()==='kh' ? 'kh-moul panel-heading' : 'time-roman panel-heading'  }}">
            {{trans('label.edit')}}
        </div>
        {!! Form::model($p,['action'=>['PositionController@updatePosition',$p->id],'method'=>'PATCH']) !!}
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <span class="{{Lang::locale()=='kh'? 'kh-os required' : 'arial'}}">{{trans('label.name')}}</span>
                        {!! Form::text('name',null,['class'=>Lang::locale()=='kh'? 'kh-os edit-form-control text-blue height-35' : 'arial edit-form-control text-blue height-35','required'=>'true','placeholder'=>trans('label.name')]) !!}
                        @if($errors->has('name'))
                            <span class="text-danger">{{$errors->first('name')}}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <span class="{{Lang::locale()=='kh'? 'kh-os required' : 'arial'}}">{{trans('label.description')}}</span>
                        {!! Form::text('description',null,['class'=>Lang::locale()=='kh'? 'kh-os edit-form-control text-blue height-35' : 'arial edit-form-control text-blue height-35','required'=>'true','placeholder'=>trans('label.description')]) !!}
                        @if($errors->has('description'))
                            <span class="text-danger">{{$errors->first('description')}}</span>
                        @endif
                    </div>
                </div>
            </div>

        </div>
        <div class="panel-footer">
            {!! Form::submit(trans('label.update'),['class'=>Lang::locale()==='kh'? 'btn btn-success btn-sm kh-os' : 'btn btn-success btn-sm arial']) !!}
            {!! Form::button(trans('label.cancel'),['class'=>Lang::locale()==='kh'? 'btn btn-danger btn-sm kh-os' : 'btn btn-danger btn-sm arial','data-dismiss'=>"modal"]) !!}
        </div>
        {!! Form::close() !!}
    </div>
</div>
</div>