@extends('admin.master')
@section('content')
    <br>
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading {{Lang::locale()==='kh'?'kh-moul':'time-roman'}}">
                {{trans('label.attribute')}}
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-4">
                        {!! Form::open(['id'=>'FormCreateAttribute']) !!}
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <span class="{{Lang::locale()==='kh' ? 'kh-os' : 'arial'}}">{{trans('label.language')}}</span>
                                        {!! Form::select('language_id',$language_id,null,['class'=>Lang::locale()==='kh' ? 'kh-os edit-form-control text-blue height-35' : 'arial edit-form-control text-blue height-35','required','placeholder'=>trans('label.choose_item'),'id'=>'language_id']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <span class="{{Lang::locale()==='kh' ? 'kh-os' : 'arial'}}">{{trans('label.name')}}</span>
                                        {!! Form::text('name',null,['class'=>Lang::locale()==='kh' ? 'kh-os edit-form-control text-blue height-35' : 'arial edit-form-control text-blue height-35','required','placeholder'=>trans('label.name')]) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {!! Form::submit(trans('label.create'),['class'=>Lang::locale()=='kh' ? 'btn btn-success btn-sm kh-os' : 'btn btn-success btn-sm arial']) !!}
                                        {!! Form::reset(trans('label.reset'),['class'=>Lang::locale()==='kh' ? 'kh-os btn btn-danger btn-sm' : 'arial btn btn-danger btn-sm']) !!}
                                        <a href="{{route('product.create')}}" class="{{Lang::locale()==='kh' ? 'kh-os btn btn-info btn-sm' : 'arial btn btn-info btn-sm'}}">{{trans('label.back')}}</a>
                                    </div>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="col-lg-8">
                        <div id="AttView" class="table-responsive"></div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">

            </div>
            <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                <div id="editAtt"></div>
            </div>

        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            loadview();
        });
        function loadview() {
            $.ajax({
                type : 'get',
                url  : "{{route('attribute.index')}}",
                dataType : 'html',
                success:function (data) {
                    $('#AttView').html(data);
                },
                error:function (error) {
                    console.log(error);
                }
            })
        }
        $('#FormCreateAttribute').submit(function (e) {
            e.preventDefault();
            var data =$('#FormCreateAttribute').serialize();
            var  url = "{{route('attribute.store')}}";
            var dataType ='json';
            var el = "";
            $.ajax({
                type : 'post',
                url  : url,
                data : data,
                dataType : dataType,
                success:function (data) {
                    $('#FormCreateAttribute')[0].reset();
                    $.map(data,function (value,key) {
                        el += "<option value='"+key+"'>"+value+"</option>";
                    });
                    $('#language_id').html(el);
                    loadview();
                },
                error:function (error) {
                    console.log(error);
                }
            })

        })
        function deleteAtt(id) {

            swal({
                title: "{{trans('label.delete')}}",
                text: "{{trans('label.are_you_sure_delete')}}",
                type: "warning",
                showCancelButton:true,
                closeOnConfirm: false,
                cancelButtonText: "{{trans('label.cancel')}}",
                confirmButtonText: "{{trans('label.yes')}}",
                confirmButtonColor: "#ec6c62"
            }, function() {
                $.ajax({
                    url : "{{url('attribute/delete')}}"+"/"+id,
                    type: "get",
                    dataType: 'html'
                }).done(function() {
                        swal("{{trans('label.deleted')}}", "{{trans('label.successfully_deleted')}}", "success");
                        $(document).ready(function () {
                            loadview();
                        });
                    })
                    .error(function(data) {
                        swal("Oops", "We couldn't connect to the server!", "error");
                    });
            });
        }

        function editAtt(id) {
            $.ajax({
                type : 'get',
                url  : "{{url('attribute/edit')}}"+"/"+id,
                dataType : 'html',
                success:function (data) {
                    $('#editAtt').html(data);
                },
                error:function (error) {
                    console.log(error);
                }
            })
        }

    </script>
@endsection