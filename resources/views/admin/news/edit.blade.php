@extends('admin.master')

@section('content')
    <br>
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-body">
                @foreach($data as $d)
                    {!! Form::open(['action'=>['NewsController@update',$d->id],'method'=>'PATCH','files'=>true]) !!}
                    <div class="row">
                        <div class="col-lg-10">
                            {!! Form::hidden('pivotId',$d->pivot->id) !!}
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <span class="{{Lang::locale()==='kh' ? 'kh-os' : 'arial'}}">{{trans('label.title')}}</span>
                                        {!! Form::text('title',$d->pivot->title,['class'=>Lang::locale()==='kh' ?'kh-os edit-form-control height-35 text-blue' : 'arial edit-form-control height-35 text-blue','placeholder'=>trans('label.fill'),'required']) !!}
                                        @if($errors->has('title'))
                                            <span class="text-danger">
                                {{$errors->first('title')}}
                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <span class="{{Lang::locale()==='kh' ? 'kh-os' : 'arial'}}">{{trans('label.category_name')}}</span>
                                        {!! Form::select('category_id',$cat,$d->category_id ? $d->category_id : null,['class'=>Lang::locale()==='kh' ?'kh-os edit-form-control height-35 text-blue' : 'arial edit-form-control height-35 text-blue','placeholder'=>trans('label.choose_item'),'id'=>'parent_num']) !!}
                                        @if($errors->has('category_id'))
                                            <span class="text-danger">
                                {{$errors->first('category_id')}}
                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <span class="{{\Illuminate\Support\Facades\Lang::locale()=='kh'? 'kh-os' : 'arial'}}">{{trans('label.reference')}}</span>
                                        {!! Form::text('reference',$d->reference,['class'=>Lang::locale()=='kh'? 'kh-os edit-form-control text-blue height-35' : 'arial edit-form-control text-blue height-35','placeholder'=>trans('label.reference')])!!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <span class="{{\Illuminate\Support\Facades\Lang::locale()=='kh'? 'kh-os required' : 'arial required'}}">{{trans('label.summarize')}}</span>
                                        {!! Form::textarea('summarize',$d->pivot->main_content,['class'=>Lang::locale()=='kh'? 'kh-os edit-form-control text-blue' : 'arial edit-form-control text-blue','required'=>true,'placeholder'=>trans('label.summarize'),'rows'=>3])!!}
                                        @if($errors->has('summarize'))
                                            <span class="text-danger">
                                {{$errors->first('summarize')}}
                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <span class="{{\Illuminate\Support\Facades\Lang::locale()=='kh'? 'kh-os required' : 'arial required'}}">{{trans('label.main_photo')}}</span>
                                        <input type="file" class="edit-form-control" id="imageEdit" onchange="loadFile(event)" name="imageEdit" accept="image/x-png,image/gif,image/jpeg" style="display: none;">
                                        <label for="imageEdit" class="cursor-pointer"><img src="{{asset('/newsImages/'.$d->main_photo)}}" alt="" class="img-responsive" id="preView" style="border: 2px solid #346895; padding: 2px;margin-top:5px;"></label>
                                        @if($errors->has('imageEdit'))
                                            <span class="text-danger">
                                {{$errors->first('imageEdit')}}
                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-12">
                                    <textarea name="description" class="form-control description">{{$d->pivot->content}}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="{{\Illuminate\Support\Facades\Lang::locale()=='kh'? 'kh-os checkbox checkbox-primary' : 'arial checkbox checkbox-primary'}}">
                                            {!! Form::checkbox('publishedit',null,$d->publish,['id'=>'publishedit']) !!}
                                            <label for="publishedit" class="{{Lang::locale()==='kh' ? 'kh-os' : 'arial'}}">
                                                {{trans('label.publish')}}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {!! Form::submit(trans('label.update'),['class'=>Lang::locale()==='kh'? 'btn btn-primary btn-sm kh-os' : 'btn btn-primary btn-sm arial']) !!}
                            {!! Form::button(trans('label.cancel'),['class'=>Lang::locale()==='kh'? 'btn btn-danger btn-sm kh-os' : 'btn btn-danger btn-sm arial']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                @endforeach
            </div>
        </div>

    </div>

    @endsection

@section('script')
    <script src="{{asset('//cdn.tinymce.com/4/tinymce.min.js')}}"></script>
    <script type="text/javascript">
        var loadFile = function(event) {
            var output = document.getElementById('preView');
            output.src = URL.createObjectURL(event.target.files[0]);
        };
        var loadFileEdit = function(event) {
            var output = document.getElementById('preViewEdit');
            output.src = URL.createObjectURL(event.target.files[0]);
        };
        //
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
    </script>
@endsection