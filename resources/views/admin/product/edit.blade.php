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
                    {!! Form::model($product,['action'=>['productController@update',$product->id],'method'=>'patch','files'=>'true']) !!}
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <span class="{{Lang::locale()==='kh' ? 'kh-os' : 'arial'}}">{{trans('label.language')}}</span>
                                {!! Form::select('language_id',$allLang,$lang,['class'=>Lang::locale()==='kh' ? 'kh-os edit-form-control text-blue height-35' : 'arial edit-form-control text-blue height-35','required','placeholder'=>trans('label.choose_item')]) !!}
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <span class="{{Lang::locale()==='kh' ? 'kh-os' : 'arial'}}">{{trans('label.categoryproduct')}}</span>
                                {!! Form::select('categoryproduct_id',$category,null,['class'=>Lang::locale()==='kh' ? 'kh-os edit-form-control text-blue height-35' : 'arial edit-form-control text-blue height-35','required','placeholder'=>trans('label.choose_item')]) !!}
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <span class="{{Lang::locale()==='kh' ? 'kh-os' : 'arial'}}">{{trans('label.brand')}}</span>
                                {!! Form::select('brand_id',$brand,null,['class'=>Lang::locale()==='kh' ? 'kh-os edit-form-control text-blue height-35' : 'arial edit-form-control text-blue height-35','required','placeholder'=>trans('label.choose_item')]) !!}
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <span class="{{Lang::locale()==='kh' ? 'kh-os' : 'arial'}}">{{trans('label.name')}}</span>
                                @foreach($pro as $p)
                                {!! Form::text('name',$p->pivot->name,['class'=>Lang::locale()=='kh'? 'kh-os edit-form-control text-blue height-35' : 'arial edit-form-control text-blue height-35','required'=>'true','placeholder'=>trans('label.product_name')])!!}
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                @foreach($pro as $d)
                                <textarea class="mydescription" name="description" required rows="13">{{$d->pivot->description}}</textarea>
                                @endforeach
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
                                <div class="padding-7px" style="width:30%">
                                    @foreach($pro as $p)
                                        <img class="img-thumbnail img-responsive" src='{{asset("mainProduct/$p->photo")}}' alt="no image">
                                    @endforeach
                                </div>
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
                            @foreach($pro as $pros)
                                @foreach($pros->photoproducts as $p)
                                    <div class="item" style="float: left">
                                        <img class="img-thumbnail img-responsive" src='{{asset("picDetailProduct/$p->name")}}' alt="no image">
                                        <div class="item-overlay top"></div>
                                        <div class="middle">
                                            <a class="cursor-pointer" type="button" onclick='deletePhoto("{{$p->id}}")'><i class="fa fa-close fa-3x text-red"></i></a>
                                        </div>
                                    </div>
                                @endforeach
                            @endforeach
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
            </div>
            <div class="panel-footer">
            </div>
        </div>
    </div>
@endsection

@section('script')


    <script>

        function deletePhoto(id) {
            swal({
                title: "{{trans('label.delete')}}",
                text: "{{trans('label.are_you_sure_delete')}}",
                type: "warning",
                showCancelButton:true,
                closeOnConfirm: "{{trans('label.cancel')}}",
                confirmButtonText: "{{trans('label.yes')}}",
                cancelButtonText : "{{trans('label.no')}}",
                confirmButtonColor: "#ec6c62"
            }, function() {
                $.ajax({
                    type : 'get',
                    url : "{{url('product/delete-image-detail/')}}"+"/"+id,
                    dataType: 'html'
                })
                    .done(function(data) {
                        swal("{{trans('label.deleted')}}", "{{trans('label.successfully_deleted')}}", "success");
                        $(document).ready(function () {
                            window.location.reload();
                        });
                    })
                    .error(function(data) {
                        swal("Oops", "We couldn't connect to the server!", "error");
                    });
            });
        }










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