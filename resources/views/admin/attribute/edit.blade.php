<div class="modal-dialog modal-sm" role="document">
    <div class="modal-content" style="border-radius: 10px;">
        @foreach($data as $d)
            {!! Form::open(['action'=>['attributeController@update',$d->id],'method'=>'PATCH']) !!}
            <div class="{{Lang::locale()==='kh' ? 'kh-moul modal-header' : 'time-roman modal-header'}}">
                {{trans('label.edit')}}
            </div>
            <div class="container-fluid">
                {!! Form::hidden('pivotId',$d->pivot->id) !!}
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <span class="{{Lang::locale()==='kh' ? 'kh-os' : 'arial'}}">{{trans('label.name')}}</span>
                            {!! Form::text('name',$d->pivot->name,['class'=>Lang::locale()==='kh' ?'kh-os edit-form-control height-35 text-blue' : 'arial edit-form-control height-35 text-blue','placeholder'=>trans('label.fill'),'required']) !!}
                        </div>
                        @if($errors->has('name'))
                            <span class="{{Lang::locale()==='kh' ? 'kh-os' : 'arial'}}">{{$errors->first('name')}}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                {!! Form::submit(trans('label.update'),['class'=>Lang::locale()==='kh'? 'btn btn-success btn-sm kh-os' : 'btn btn-success btn-sm arial']) !!}
                {!! Form::button(trans('label.cancel'),['class'=>Lang::locale()==='kh'? 'btn btn-danger btn-sm kh-os' : 'btn btn-danger btn-sm arial','data-dismiss'=>"modal"]) !!}
            </div>
            {!! Form::close() !!}
        @endforeach
    </div>
</div>
