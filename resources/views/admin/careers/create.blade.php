@extends('admin.master')

@section('content')
    <br>
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading {{\Illuminate\Support\Facades\Lang::locale()==='kh' ? 'kh-moul' : 'time-roman'  }}">
                {{trans('label.career')}}
            </div>
            <div class="panel-body">
                    {!! Form::open(['action'=>'CareerController@store','method'=>'post']) !!}
                    <div class="row">
                        <input type="hidden" name="career_id" id="career_id" value="0">
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
                                <span class="{{\Illuminate\Support\Facades\Lang::locale()=='kh'? 'kh-os' : 'arial'}}">{{trans('label.category')}}</span>
                                {!! Form::select('category_id',$category,0,['class'=>Lang::locale()=='kh'? 'kh-os edit-form-control text-blue height-35' : 'arial edit-form-control text-blue height-35','id'=>'category_id','placeholder'=>trans('label.choose_item')])!!}
                                @if($errors->has('category_id'))
                                    <span class="text-danger">
                                            {{$errors->first('category_id')}}
                                        </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <span class="{{\Illuminate\Support\Facades\Lang::locale()=='kh'? 'kh-os' : 'arial'}}">{{trans('label.job_category')}}</span>
                                {!! Form::select('jobcategory_id',$jobcategory,0,['class'=>Lang::locale()=='kh'? 'kh-os edit-form-control text-blue height-35' : 'arial edit-form-control text-blue height-35','id'=>'jobcategory_id','placeholder'=>trans('label.choose_item')])!!}
                                @if($errors->has('jobcategory_id'))
                                    <span class="text-danger">
                                            {{$errors->first('jobcategory_id')}}
                                        </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span class="{{\Illuminate\Support\Facades\Lang::locale()=='kh'? 'kh-os' : 'arial'}}">{{trans('label.title')}}</span>
                                {!! Form::text('title',null,['class'=>Lang::locale()=='kh'? 'kh-os edit-form-control text-blue height-35' : 'arial edit-form-control text-blue height-35','required'=>'true','placeholder'=>trans('label.title')])!!}
                                @if($errors->has('title'))
                                    <span class="text-danger">
                                        {{$errors->first('title')}}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <span class="{{\Illuminate\Support\Facades\Lang::locale()=='kh'? 'kh-os' : 'arial'}}">{{trans('label.job_type')}}</span>
                                {!! Form::select('jobtype_id',$jobtype,0,['class'=>Lang::locale()=='kh'? 'kh-os edit-form-control text-blue height-35' : 'arial edit-form-control text-blue height-35','id'=>'jobtype_id','placeholder'=>trans('label.choose_item')])!!}
                                @if($errors->has('jobtype_id'))
                                    <span class="text-danger">
                                            {{$errors->first('jobtype_id')}}
                                        </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <span class="{{\Illuminate\Support\Facades\Lang::locale()=='kh'? 'kh-os' : 'arial'}}">{{trans('label.location')}}</span>
                                {!! Form::text('location',null,['class'=>Lang::locale()=='kh'? 'kh-os edit-form-control text-blue height-35' : 'arial edit-form-control text-blue height-35','required'=>'true','placeholder'=>trans('label.location')])!!}
                                @if($errors->has('location'))
                                    <span class="text-danger">
                                        {{$errors->first('location')}}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <span class="{{\Illuminate\Support\Facades\Lang::locale()=='kh'? 'kh-os' : 'arial'}}">{{trans('label.close_date')}}</span>
                                {!! Form::date('close_date',null,['class'=>Lang::locale()=='kh'? 'kh-os edit-form-control text-blue height-35' : 'arial edit-form-control text-blue height-35','required'=>'true','placeholder'=>trans('label.close_date')])!!}
                                @if($errors->has('close_date'))
                                    <span class="text-danger">
                                        {{$errors->first('close_date')}}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <span class="{{\Illuminate\Support\Facades\Lang::locale()=='kh'? 'kh-os' : 'arial'}}">{{trans('label.description')}}</span>
                            <textarea name="description" class="form-control description"></textarea>
                            @if($errors->has('description'))
                                <span class="text-danger">
                                        {{$errors->first('description')}}
                                    </span>
                            @endif
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

            </div>
            <div class="panel-footer">

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('//cdn.tinymce.com/4/tinymce.min.js')}}"></script>
    <script type="text/javascript">

        var editor_config = {
            path_absolute : "/",
            selector: "textarea.description",
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
            relative_urls: false,
            file_browser_callback : function(field_name, url, type, win) {
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;
                //
                var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
                if (type == 'image') {
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }
                //
                tinyMCE.activeEditor.windowManager.open({
                    file : cmsURL,
                    title : 'Filemanager',
                    width : x * 0.8,
                    height : y * 0.8,
                    resizable : "yes",
                    close_previous : "no"
                });
            }
        };
        //
        tinymce.init(editor_config);

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
                url:"{{url('/get/select/by/language')}}"+'/'+langId,
                dataType:'json',
                success:function (data) {
                    var serialnumber="<option value=''>{{trans('label.choose_item')}}</option>";
                    $.map(data.category,function(value ,key){
                        serialnumber+="<option value=" + key + ">" + value + "</option>";
                    });
                    $('#category_id').html(serialnumber);
                    var jobcategory_id="<option value=''>{{trans('label.choose_item')}}</option>";
                    $.map(data.jobcategory,function(value ,key){
                        jobcategory_id+="<option value=" + key + ">" + value + "</option>";
                    });
                    $('#jobcategory_id').html(jobcategory_id);

                    var jobtype_id="<option value=''>{{trans('label.choose_item')}}</option>";
                    $.map(data.jobtype,function(value ,key){
                        jobtype_id+="<option value=" + key + ">" + value + "</option>";
                    });
                    $('#jobtype_id').html(jobtype_id);
                },
                error:function (error) {
                    console.log(error);
                }
            });
        });

    </script>
@endsection