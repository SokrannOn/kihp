@extends('admin.master')

@section('content')
    <br>
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading {{\Illuminate\Support\Facades\Lang::locale()==='kh' ? 'kh-moul' : 'time-roman'  }}">
                {{trans('label.category')}}
            </div>
            <div class="panel-body">
                    {!! Form::open(['method'=>'post','id'=>'category']) !!}
                    <div class="row">
                        <input type="hidden" name="category_id" id="category_id" value="0">
                        <div class="col-md-4">
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
                        <div class="col-md-4">
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
                        <div class="col-md-4">
                            <div class="form-group">
                                <span class="{{\Illuminate\Support\Facades\Lang::locale()=='kh'? 'kh-os' : 'arial'}}">{{trans('label.parent')}}</span>
                                {!! Form::select('parent',$category,0,['class'=>Lang::locale()=='kh'? 'kh-os edit-form-control text-blue height-35' : 'arial edit-form-control text-blue height-35','id'=>'par','placeholder'=>trans('label.choose_item')])!!}
                                @if($errors->has('parent'))
                                    <span class="text-danger">
                                            {{$errors->first('parent')}}
                                        </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="{{\Illuminate\Support\Facades\Lang::locale()=='kh'? 'kh-os checkbox checkbox-primary' : 'arial checkbox checkbox-primary'}}">
                                    {!! Form::checkbox('publish',1,null,['id'=>'publish']) !!}
                                    <label for="publish">
                                        {{trans('label.publish')}}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::submit(trans('label.create'),['class'=>Lang::locale()==='kh' ? 'kh-os btn btn-success btn-sm':'arial btn btn-success btn-sm']) !!}
                        {!! Form::reset(trans('label.reset'),['class'=>Lang::locale()==='kh' ? 'kh-os btn btn-warning btn-sm':'arial btn btn-warning btn-sm']) !!}
                    </div>
                    {!! Form::close() !!}

                <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                    <div id="editCat"></div>
                </div>

            </div>
            <div class="panel-footer">
                <div id="viewCategory">
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

        function editCat(id,langId) {
            $.ajax({
                type : 'get',
                url : "{{url('/category/edit')}}"+"/"+id+"/"+langId,
                dataType : 'html',
                success:function (data) {
                    $('#editCat').html(data);
                },
                error:function (error) {
                    console.log(error);
                }
            });
        }

        $('#lang').on('change',function () {
            var langId = $(this).val();
            $.ajax({
                type:'get',
                url:"{{url('get/select/parent')}}"+'/'+langId,
                dataType:'json',
                success:function (data) {
                    var serialnumber="<option value=''>{{trans('label.choose_item')}}</option>";
                    $.map(data,function(value ,key){
                        serialnumber+="<option value=" + key + ">" + value + "</option>";
                    });
                    $('#par').html(serialnumber);
                },
                error:function (error) {
                    console.log(error);
                }
            });
        });
        function getViewCategory() {
            $.ajax({
                type:'get',
                url:"{{route('category.index')}}",
                dataType:'html',
                success:function (data) {
                    $('#viewCategory').html(data);
                },
                error:function (error) {
                    console.log(error);
                }
            });
        }
        $(document).ready(function () {
            getViewCategory();
        });

        $('#category').submit(function (e) {
            e.preventDefault();
            var data = $('#category').serialize();
            $.ajax({
                type : 'post',
                url  : "{{route('category.store')}}",
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

                    $('#category')[0].reset();
                    $('#category_id').val(data.id);
                    $(document).ready(function () {
                        getViewCategory();
                        getSelectParent();
                    });
                },
                error:function (error) {
                    console.log(error);
                }
            });
        });

        function updatePos(id) {
            $.ajax({
                type:'get',
                url:"{{url('/language/edit')}}"+"/"+id,
                dataType:'html',
                success:function (data) {
                    $('#editlanguage').html(data);
                },
                error:function (error) {
                    console.log(error);
                }
            });
        }

        function deleteCat(id) {
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
                    url : "{{url('/category/delete')}}"+"/"+id,
                    type: "get",
                    dataType: 'html'
                })
                    .done(function(data) {
                        swal("Deleted!", "Your file was successfully deleted!", "success");
                        $(document).ready(function () {
                            getViewCategory();
                        });
                    })
                    .error(function(data) {
                        swal("Oops", "We couldn't connect to the server!", "error");
                    });
            });
        }

        function getSelectParent() {
            $.ajax({
                type: 'get',
                url: "{{url('/get/select/parent')}}",
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    var serialnumber="<option value=''>{{trans('label.choose_item')}}</option>";
                        $.map(response,function(value ,key){
                            serialnumber+="<option value=" + key + ">" + value + "</option>";
                        });
                    $('#par').html(serialnumber);
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }
    </script>
@endsection