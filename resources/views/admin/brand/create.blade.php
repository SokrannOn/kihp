@extends('admin.master')
@section('content')
    <br>
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading {{Lang::locale()==='kh' ? 'kh-moul' : 'time-roman'}}">
                {{trans('label.brand')}}
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div id="createBrand">
                            {!! Form::open(['id'=>'brand']) !!}
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <span class="{{Lang::locale()==='kh' ? 'kh-os' : 'arial'}}">{{trans('label.name')}}</span>
                                        {!! Form::text('name',null,['class'=>Lang::locale()==='kh' ? 'kh-os edit-form-control text-blue' : 'arial edit-form-control text-blue','required','placeholder'=>trans('label.fill')]) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="checkbox checkbox-primary">
                                            {!! Form::checkbox('active',null,null,['id'=>'active']) !!}
                                            <label for="active" class="{{Lang::locale()==='kh' ? 'kh-os' : 'arial'}}">
                                                {{trans('label.active')}}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    {!! Form::submit(trans('label.create'),['class'=>Lang::locale()==='kh' ? 'btn btn-success btn-sm kh-os' : 'btn btn-success btn-sm arial']) !!}
                                    {!! Form::reset(trans('label.reset'),['class'=>Lang::locale()==='kh' ? 'btn btn-danger btn-sm kh-os' : 'btn btn-danger btn-sm arial']) !!}
                                </div>
                            </div>

                            {!! Form::close() !!}
                        </div>
                        <div id="editBrand"></div>
                    </div>
                    <div class="col-lg-8">
                        <div id="brandView"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#brand').submit(function (e) {
            e.preventDefault();
            var data = $('#brand').serialize();
            $.ajax({
               type : 'post',
               url : "{{route('brand.store')}}",
               data: data,
               dataType : 'html',
               beforeSend:function () {

               },success:function (data) {
                  $('#brand')[0].reset();
                  $('#brandView').html(data);

               },error:function (error) {
                    console.log(error);
               }

            });
        });
        $(function () {
            $.ajax({
                type : 'get',
                url : "{{route('brand.index')}}",
                dataType : 'html',
                beforeSend:function () {

                },success:function (data) {
                    $('#brandView').html(data);

                },error:function (error) {
                    console.log(error);
                }

            });
        });
        function editBrand(id) {
            var url = "{{url('/brand/edit/')}}"+"/"+id;
            var dataType = 'html';
            var idControl = "#editBrand";
            var idHide = "#createBrand";
            editForm(url,idControl,dataType,idHide);
        }

    </script>
@endsection