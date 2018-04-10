{!! Form::model($brand,['action'=>['brandController@update',$brand->id],'method'=>'patch']) !!}
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <span class="{{Lang::locale()==='kh' ? 'kh-os' : 'arial'}}">{{trans('label.name')}}</span>
            {!! Form::text('name',null,['class'=>Lang::locale()==='kh' ? 'kh-os edit-form-control text-blue' : 'arial edit-form-control text-blue','required','placeholder'=>trans('label.fill')]) !!}
            @if($errors->has('name'))
                <span class="text-danger">{{$errors->first('name')}}</span>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <div class="checkbox checkbox-primary">
                {!! Form::checkbox('active',null,$brand->active,['id'=>'active']) !!}
                <label for="active" class="{{Lang::locale()==='kh' ? 'kh-os' : 'arial'}}">
                    {{trans('label.active')}}
                </label>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        {!! Form::submit(trans('label.update'),['class'=>Lang::locale()==='kh' ? 'btn btn-success btn-sm kh-os' : 'btn btn-success btn-sm arial']) !!}
        {!! Form::button(trans('label.cancel'),['class'=>Lang::locale()==='kh' ? 'btn btn-danger btn-sm kh-os' : 'btn btn-danger btn-sm arial','onClick'=>"cancelForm()"]) !!}
    </div>
</div>

{!! Form::close() !!}
