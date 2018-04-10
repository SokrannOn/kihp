@extends('admin.master')

@section('content')
    <br>
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading {{Lang::locale()==='kh' ? 'kh-moul' : 'time-roman'}}">
                {{trans('label.product')}}
            </div>
            <div class="panel-body">
                <div id="productCreate">
                    {!! Form::open(['action'=>'productController@store','method'=>'post','files'=>'true','id'=>'createProduct']) !!}
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <span class="{{Lang::locale()==='kh' ? 'kh-os' : 'arial'}}">{{trans('label.language')}}</span>
                                    {!! Form::select('language_id',$lang,$selectLang,['class'=>Lang::locale()==='kh' ? 'kh-os edit-form-control text-blue height-35' : 'arial edit-form-control text-blue height-35','required','placeholder'=>trans('label.choose_item')]) !!}
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <span class="{{Lang::locale()==='kh' ? 'kh-os' : 'arial'}}">{{trans('label.categoryproduct')}}</span>
                                    {!! Form::select('categoryproduct_id',$categoryProduct,$selectCategory,['class'=>Lang::locale()==='kh' ? 'kh-os edit-form-control text-blue height-35' : 'arial edit-form-control text-blue height-35','required','placeholder'=>trans('label.choose_item')]) !!}
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <span class="{{Lang::locale()==='kh' ? 'kh-os' : 'arial'}}">{{trans('label.brand')}}</span>
                                    {!! Form::select('brand',$brand,$selectBrand,['class'=>Lang::locale()==='kh' ? 'kh-os edit-form-control text-blue height-35' : 'arial edit-form-control text-blue height-35','required','placeholder'=>trans('label.choose_item')]) !!}
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <span class="{{Lang::locale()==='kh' ? 'kh-os' : 'arial'}}">{{trans('label.name')}}</span>
                                    {!! Form::text('name',null,['class'=>Lang::locale()=='kh'? 'kh-os edit-form-control text-blue height-35' : 'arial edit-form-control text-blue height-35','required'=>'true','placeholder'=>trans('label.product_name')])!!}
                                </div>
                            </div>
                        </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <textarea class="mydescription" name="description" rows="13"></textarea>
                                {{--<textarea name="content" class="form-control my-editor"></textarea>--}}
                            </div>
                        </div>
                    </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    {!! Form::label('mainphoto',trans('label.main_photo'),['class'=>Lang::locale()==='kh' ? 'kh-os cursor-pointer btn-default btn-sm' : 'arial cursor-pointer btn-default btn-sm','style'=>'padding:6px 10px; border-radius:5px;']) !!}
                                    <input type="file" name="mainphoto" id="mainphoto" accept="image/jpeg,image/png" style="display: none;">
                                    <div id="mainPic"></div>
                                </div>
                                @if($errors->has('mainphoto'))
                                    <span class="text-danger">{{$errors->first('mainphoto')}}</span>
                                @endif
                            </div>
                            <div class="col-lg-9">
                                <div class="form-group">
                                    {!! Form::label('picdetail',trans('label.picdetail'),['class'=>Lang::locale()==='kh' ? 'kh-os cursor-pointer btn-default btn-sm' : 'arial cursor-pointer btn-default btn-sm','style'=>'padding:6px 10px; border-radius:5px;']) !!}
                                    <input type="file" name="picdetail[]" id="picdetail" multiple accept="image/jpeg,image/png" style="display: none;">
                                    <div id="detailImg"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="checkbox checkbox-primary">
                                        {!! Form::checkbox('publish',null,null,['id'=>'publish']) !!}
                                        <label for="publish" class="{{Lang::locale()==='kh' ? 'kh-os' : 'arial'}}">
                                            {{trans('label.publish')}}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <br>
                                <div class="form-group">
                                    {!! Form::submit(trans('label.create'),['class'=>Lang::locale()==='kh' ? 'kh-os btn btn-success btn-sm' : 'arial btn btn-success btn-sm']) !!}
                                    {!! Form::reset(trans('label.reset'),['class'=>Lang::locale()==='kh' ? 'kh-os btn btn-danger btn-sm' : 'arial btn btn-danger btn-sm']) !!}
                                </div>

                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
                <div id="productEdit"></div>
            </div>
            <div class="panel-footer">
            </div>
        </div>
    </div>
@endsection





@section('script')


    <script>

        var editor_config = {
            path_absolute : "/",
            selector: 'textarea.mydescription',
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern "
            ],
            toolbar: "insertfile undo redo | fontselect | fontsizeselect |​ forecolor | backcolor | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
            font_formats: 'Arial=arial;khmer os= khmer os;Khmer OS Muol Light=Khmer OS Muol Light;Khmer OS Muol=Khmer OS Muol;Khmer OS Content=Khmer OS Content',
            fixed_toolbar_container: '#mytoolbar',
            relative_urls: true,
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
        function previewImages() {

            var $preview = $('#detailImg').empty();
            if (this.files) $.each(this.files, readAndPreview);

            function readAndPreview(i, file) {

                if (!/\.(jpe?g|png|gif)$/i.test(file.name)){
                    return alert(file.name +" is not an image");
                } // else...

                var reader = new FileReader();

                $(reader).on("load", function() {
                    $preview.append($("<img/>", {class:'img-thumbnail margin-2',src:this.result, height:100 }));

                });

                reader.readAsDataURL(file);

            }
        }
        $('#picdetail').on("change", previewImages);

        function mainPhoto() {

            var $preview = $('#mainPic').empty();
            if (this.files) $.each(this.files, readAndPreview);

            function readAndPreview(i, file) {

                if (!/\.(jpe?g|png|gif)$/i.test(file.name)){
                    return alert(file.name +" is not an image");
                } // else...

                var reader = new FileReader();

                $(reader).on("load", function() {
                    $preview.append($("<img/>", {class:'img-thumbnail margin-2',src:this.result, height:100 }));

                });

                reader.readAsDataURL(file);

            }
        }
        $('#mainphoto').on("change", mainPhoto);
//
    </script>
@endsection