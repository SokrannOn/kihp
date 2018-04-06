@extends('admin.master')

@section('content')
    <div class="container-fluid">
        <br>
        <div class="panel panel-default">
            {!! Form::open(['action'=>'ArticleController@store','method'=>'post']) !!}
            <div class="panel-heading">
                Articles
            </div>
            <div class="panel-body">

                    <div class="row">
                        <div class="col-lg-5">
                            <div class="form-group">
                                {!! Form::label('cat','Category Name') !!}
                                {!! Form::select('category_id',$category,null,['class'=>'edit-form-control','placeholder'=>'Please choose category']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="form-group">
                                {!! Form::label('tittle','Tittle') !!}
                                {!! Form::text('tittle',null,['class'=>'edit-form-control','placeholder'=>'Please provide tittle']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <textarea name="content" class="form-control my-editor"></textarea>
                        </div>
                    </div>


            </div>
            <div class="panel-footer">
                {!! Form::submit('Save',['class'=>'btn btn-primary btn-sm']) !!}
                <a href="" class="btn btn-danger btn-sm">Close</a>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('script')
    <script>
        var editor_config = {
            path_absolute : "/",
            selector: "textarea.my-editor",
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

                var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
                if (type == 'image') {
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }

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

        tinymce.init(editor_config);
    </script>


@endsection