
{!! Form::model($contact,['action'=>['ContactController@update',$contact->id],'method'=>'PATCH']) !!}
<input type="hidden" value="{{csrf_token()}}">
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <span class="{{\Illuminate\Support\Facades\Lang::locale()=='kh'? 'kh-os' : 'arial'}}">{{trans('label.company_name')}}</span>
            {!! Form::text('company_name',null,['class'=>Lang::locale()=='kh'? 'kh-os edit-form-control text-blue height-35' : 'arial edit-form-control text-blue height-35','required'=>'true','placeholder'=>trans('label.company_name')])!!}
            @if($errors->has('company_name'))
                <span class="text-danger">
                                    {{$errors->first('company_name')}}
                                </span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <span class="{{\Illuminate\Support\Facades\Lang::locale()=='kh'? 'kh-os' : 'arial'}}">{{trans('label.phone_number')}}</span>
            {!! Form::text('phone_number',null,['class'=>Lang::locale()=='kh'? 'kh-os edit-form-control text-blue height-35' : 'arial edit-form-control text-blue height-35','required'=>'true','placeholder'=>trans('label.phone_number')])!!}
            @if($errors->has('phone_number'))
                <span class="text-danger">
                                    {{$errors->first('phone_number')}}
                                </span>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <span class="{{\Illuminate\Support\Facades\Lang::locale()=='kh'? 'kh-os' : 'arial'}}">{{trans('label.email')}}</span>
            {!! Form::text('email',null,['class'=>Lang::locale()=='kh'? 'kh-os edit-form-control text-blue height-35' : 'arial edit-form-control text-blue height-35','required'=>'true','placeholder'=>trans('label.email')])!!}
            @if($errors->has('email'))
                <span class="text-danger">
                                    {{$errors->first('email')}}
                                </span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <span class="{{\Illuminate\Support\Facades\Lang::locale()=='kh'? 'kh-os' : 'arial'}}">{{trans('label.website')}}</span>
            {!! Form::text('website',null,['class'=>Lang::locale()=='kh'? 'kh-os edit-form-control text-blue height-35' : 'arial edit-form-control text-blue height-35','required'=>'true','placeholder'=>trans('label.website')])!!}
            @if($errors->has('website'))
                <span class="text-danger">
                                    {{$errors->first('website')}}
                                </span>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <span class="{{\Illuminate\Support\Facades\Lang::locale()=='kh'? 'kh-os' : 'arial'}}">{{trans('label.address')}}</span>
            {!! Form::textarea('address',null,['class'=>Lang::locale()=='kh'? 'kh-os edit-form-control text-blue' : 'arial edit-form-control text-blue','rows'=>3,'placeholder'=>trans('label.address')])!!}
            @if($errors->has('address'))
                <span class="text-danger">
                    {{$errors->first('address')}}
                </span>
            @endif
        </div>
    </div>
</div>
<div class="form-group">
    {!! Form::submit(trans('label.update'),['class'=>Lang::locale()==='kh' ? 'kh-os btn btn-primary btn-sm':'arial btn btn-primary btn-sm']) !!}
    {!! Form::button(trans('label.cancel'),['class'=>Lang::locale()==='kh'? 'btn btn-danger btn-sm kh-os' : 'btn btn-danger btn-sm arial','onclick'=>'cancel()']) !!}
</div>
{!! Form::close() !!}

