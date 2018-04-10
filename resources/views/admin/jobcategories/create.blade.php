@extends('admin.master')

@section('content')
    <br>
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading {{\Illuminate\Support\Facades\Lang::locale()==='kh' ? 'kh-moul' : 'time-roman'  }}">
                {{trans('label.job_category')}}
            </div>
            <div class="panel-body">
                    {!! Form::open(['method'=>'post','id'=>'jobcategory']) !!}
                    <div class="row">
                        <input type="hidden" name="jobcategory_id" id="jobcategory_id" value="0">
                        <div class="col-md-6">
                            <div class="form-group">
                                <span class="{{\Illuminate\Support\Facades\Lang::locale()=='kh'? 'kh-os' : 'arial'}}">{{trans('label.language_name')}}</span>
                                {!! Form::select('language_id',$language,null,['class'=>Lang::locale()=='kh'? 'kh-os edit-form-control text-blue height-35' : 'arial edit-form-control text-blue height-35','required'=>'true','id'=>'lang','placeholder'=>trans('label.choose_item')])!!}
                                @if($errors->has('language_id'))
                                    <span class="text-danger">
                                        {{$errors->first('language_id')}}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span class="{{\Illuminate\Support\Facades\Lang::locale()=='kh'? 'kh-os' : 'arial'}}">{{trans('label.name')}}</span>
                                {!! Form::text('name',null,['class'=>Lang::locale()=='kh'? 'kh-os edit-form-control text-blue height-35' : 'arial edit-form-control text-blue height-35','required'=>'true','placeholder'=>trans('label.name')])!!}
                                @if($errors->has('name'))
                                    <span class="text-danger">
                                            {{$errors->first('name')}}
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

                <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                    <div id="editJobCat"></div>
                </div>

            </div>
            <div class="panel-footer">
                <div id="viewJobCategory">
                    <div class="center">
                        <i class="fa fa-spinner fa-spin" style="font-size:24px"> </i> <span>&nbsp; Wait...</span>
                    </div>
                </div>
            </div>
            <div id="testing">

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">

        function editJobCat(id,langId) {
            $.ajax({
                type : 'get',
                url : "{{url('/jobcategory/edit')}}"+"/"+id+"/"+langId,
                dataType : 'html',
                success:function (data) {
                    $('#editJobCat').html(data);
                },
                error:function (error) {
                    console.log(error);
                }
            });
        }

        function getViewJobCategory() {
            $.ajax({
                type:'get',
                url:"{{route('jobcategory.index')}}",
                dataType:'html',
                success:function (data) {
                    $('#viewJobCategory').html(data);
                },
                error:function (error) {
                    console.log(error);
                }
            });
        }
        $(document).ready(function () {
            getViewJobCategory();
        });

        $('#jobcategory').submit(function (e) {
            e.preventDefault();
            var data = $('#jobcategory').serialize();
            $.ajax({
                type : 'post',
                url  : "{{route('jobcategory.store')}}",
                data : data,
                dataType: 'json',
                beforeSend:function () {
                },
                success:function (data) {
                    var serialnumber="<option value=''>{{trans('label.choose_item')}}</option>";
                    $.map(data.language,function(value ,key){
                        serialnumber+="<option value=" + key + ">" + value + "</option>";
                    });
                    $('#lang').html(serialnumber);

                    $('#jobcategory')[0].reset();
                    $('#jobcategory_id').val(data.id);
                    $(document).ready(function () {
                        getViewJobCategory();
                    });
                },
                error:function (error) {
                    console.log(error);
                }
            });
        });


        function deleteJobCat(id) {
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
                    url : "{{url('/jobcategory/delete')}}"+"/"+id,
                    type: "get",
                    dataType: 'html'
                })
                    .done(function(data) {
                        swal("Deleted!", "Your file was successfully deleted!", "success");
                        $(document).ready(function () {
                            getViewJobCategory();
                        });
                    })
                    .error(function(data) {
                        swal("Oops", "We couldn't connect to the server!", "error");
                    });
            });
        }

    </script>
@endsection