
    <div class="modal-dialog">
    {!! Form::model($user,['action'=>['UserController@update',$user->id],'method'=>'PATCH','files'=>true]) !!}

        <!-- Modal content-->
        <div class="modal-content" style="border-radius: 5px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
                <div class="{{\Illuminate\Support\Facades\Lang::locale()==='kh' ? 'kh-moul' : 'time-roman'  }}">
                    {{trans('label.edit')}}
                </div>
            </div>
            <div class="modal-body">
                <div >
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <span class="{{Lang::locale()=='kh'? 'kh-os required' : 'arial'}}">{{trans('label.name')}}</span>
                                        {!! Form::text('name',null,['class'=>Lang::locale()=='kh'? 'kh-os edit-form-control text-blue height-35' : 'arial edit-form-control text-blue height-35','required'=>'true','placeholder'=>trans('label.name')]) !!}
                                        @if($errors->has('name'))
                                            <span class="text-danger">{{$errors->first('name')}}</span>
                                        @endif
                                    </div>
                                    <div class="col-lg-6">
                                        <span class="{{Lang::locale()=='kh'? 'kh-os required' : 'arial'}}">{{trans('label.user_name')}}</span>
                                        {!! Form::text('username',null,['class'=>Lang::locale()=='kh'? 'kh-os edit-form-control text-blue height-35' : 'arial edit-form-control text-blue height-35','required'=>'true','placeholder'=>trans('label.user_name')]) !!}
                                        @if($errors->has('username'))
                                            <span class="text-danger">{{$errors->first('username')}}</span>
                                        @endif

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <span class="{{Lang::locale()=='kh'? 'kh-os required' : 'arial'}}">{{trans('label.role')}}</span>
                                        {!! Form::select('role_id',$role,null,['class'=>Lang::locale()=='kh'? 'kh-os edit-form-control text-blue height-35' : 'arial edit-form-control text-blue height-35','placeholder'=>trans('label.choose_item'), 'required'=>true ]) !!}
                                        @if($errors->has('role_id'))
                                            <span class="text-danger">{{$errors->first('role_id')}}</span>
                                        @endif
                                    </div>
                                    <div class="col-lg-6">
                                        <span class="{{Lang::locale()=='kh'? 'kh-os required' : 'arial'}}">{{trans('label.position')}}</span>
                                        {!! Form::select('position_id',$position,null,['class'=>Lang::locale()=='kh'? 'kh-os edit-form-control text-blue height-35' : 'arial edit-form-control text-blue height-35','placeholder'=>trans('label.choose_item'), 'required'=>true ]) !!}
                                        @if($errors->has('position_id'))
                                            <span class="text-danger">{{$errors->first('position_id')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-8 col-xs-5 col-sm-2">
                                        <div class="form-group">
                                            <img src='{{asset("/photo/$user->photo")}}' alt="" id="preViewEdit" style="height: 80px; width: 80px; border-radius: 50px; border: 2px solid #346895; padding: 2px;">
                                        </div>
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <label for="imageEdit" class="{{Lang::locale()=='kh'? 'kh-os btn btn-primary' : 'arial btn btn-primary'}}" style="padding: 4px 16px;">{{trans('label.browse')}}</label>
                                            <input type="file" name="imageEdit" class="edit-form-control" id="imageEdit" onchange="loadFileEdit(event)" accept="image/*"style="display: none;">
                                            {{--{!! Form::file('image',['class'=>'btn display-none']) !!}--}}
                                            @if($errors->has('image'))
                                                <span class="text-danger">{{$errors->first('image')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>

                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                {!! Form::submit(trans('label.update'),['class'=>Lang::locale()==='kh' ? 'kh-os btn btn-primary btn-sm pull-left':'arial btn btn-primary btn-sm pull-left']) !!}
                <a data-dismiss="modal" class="{{Lang::locale()==='kh' ? 'kh-os btn btn-danger btn-sm pull-left':'arial btn btn-danger btn-sm pull-left'}}">{{trans('label.close')}}</a>
            </div>

        </div>
    {!! Form::close() !!}
</div>

    <script type="text/javascript">
        var loadFileEdit = function(event) {
            var output = document.getElementById('preViewEdit');
            output.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>






