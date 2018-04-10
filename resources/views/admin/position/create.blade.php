@extends('admin.master')

@section('content')
    <br>
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="{{\Illuminate\Support\Facades\Lang::locale()==='kh' ? 'kh-moul panel-heading' : 'time-roman panel-heading'  }}">
                {{trans('label.position')}}
            </div>
            <div class="panel-body">
                <div class="row">
                    {!! Form::open(['action'=>'PositionController@store','method'=>'post']) !!}
                    <input type="hidden" value="{{csrf_token()}}">
                        <div class="col-md-4">
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
                            <div class="form-group">
                                {!! Form::submit(trans('label.create'),['class'=>Lang::locale()==='kh' ? 'kh-os btn btn-success btn-sm':'arial btn btn-success btn-sm']) !!}
                                {!! Form::reset(trans('label.reset'),['class'=>Lang::locale()==='kh' ? 'kh-os btn btn-warning btn-sm':'arial btn btn-warning btn-sm']) !!}
                            </div>

                        </div>
                    {!! Form::close() !!}
                        <div class="col-md-8">
                            <div id="viewPosition">
                                <div class="center">
                                    <i class="fa fa-spinner fa-spin" style="font-size:24px"> </i> <span>&nbsp; Wait...</span>
                                </div>
                            </div>
                        </div>
                </div>

                <div id="position" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">

                </div>

            </div>
            <div class="panel-footer">

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        function getViewposition() {
            $.ajax({
                type:'get',
                url:"{{url('/admin/position/index')}}",
                dataType:'html',
                success:function (data) {
                    $('#viewPosition').html(data);
                },
                error:function (error) {
                    console.log(error);
                }
            });
        }
        $(document).ready(function () {
            getViewposition();
        });
        function updatePos(id) {
            $.ajax({
                type:'get',
                url:"{{url('/admin/position/edit')}}"+"/"+id,
                dataType:'html',
                success:function (data) {
                   $('#position').html(data);
                },
                error:function (error) {
                    console.log(error);
                }
            });
        }
        function deletePos(id) {
            swal({
                title: "{{trans('label.are_you_sure')}}",
                text: "{{trans('label.are_you_sure_delete')}}",
                type: "warning",
                showCancelButton:true,
                closeOnConfirm: false,
                cancelButtonText: "{{trans('label.no')}}",
                confirmButtonText: "{{trans('label.yes')}}",
                confirmButtonColor: "#ec6c62"
            }, function() {
                $.ajax({
                    url : "{{url('/admin/position/delete')}}"+"/"+id,
                    type: "get",
                    dataType: 'html'
                })
                    .done(function(data) {
                        swal("Deleted!", "Your file was successfully deleted!", "success");
                        $(document).ready(function () {
                            getViewposition();
                        });
                    })
                    .error(function(data) {
                        swal("Oops", "We couldn't connect to the server!", "error");
                    });
            });
        }
    </script>
@endsection