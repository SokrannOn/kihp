@extends('admin.master')

@section('content')
    <br>
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading {{\Illuminate\Support\Facades\Lang::locale()==='kh' ? 'kh-moul' : 'time-roman'  }}">
                {{trans('label.contact')}}
            </div>
            <div class="panel-body">
                <div id="editContact">
                    {!! Form::open(['method'=>'post','id'=>'contact']) !!}
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
                        {!! Form::submit(trans('label.create'),['class'=>Lang::locale()==='kh' ? 'kh-os btn btn-success btn-sm':'arial btn btn-success btn-sm']) !!}
                        {!! Form::reset(trans('label.reset'),['class'=>Lang::locale()==='kh' ? 'kh-os btn btn-warning btn-sm':'arial btn btn-warning btn-sm']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>

            </div>
            <div class="panel-footer">
                <div id="viewContact">

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        function getViewContact() {
            $.ajax({
                type:'get',
                url:"{{route('contact.index')}}",
                dataType:'html',
                success:function (data) {
                    $('#viewContact').html(data);
                },
                error:function (error) {
                    console.log(error);
                }
            });
        }
        $(document).ready(function () {
            getViewContact();
        });

        $('#contact').submit(function (e) {
            e.preventDefault();
            var data = $('#contact').serialize();
            $.ajax({
                type : 'post',
                url  : "{{route('contact.store')}}",
                dataType: 'html',
                data : data,
                beforeSend:function () {
                },
                success:function (data) {
                    $('#contact')[0].reset();
                    $(document).ready(function () {
                        getViewContact();
                    });
                }
            });
        });

        function editContact(id) {
            $.ajax({
                type:'get',
                url:"{{url('/contact/edit')}}"+"/"+id,
                dataType:'html',
                success:function (data) {
                    $('#editContact').html(data);
                },
                error:function (error) {
                    console.log(error);
                }
            });
        }
        function cancel() {
            window.location.reload();
        }

    </script>
@endsection