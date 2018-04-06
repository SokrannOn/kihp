<div style="margin-top: 10%;" class="modal-dialog modal-sm" role="document">
    <div class="modal-content" style="border-radius: 10px;">
            <div class="panel panel-default">
                <div class="panel-body">
                    {!! Form::model($user,['action'=>['UserController@resetPasswordSuccess',$user->id],'method'=>'patch']) !!}
                    <div class="row">
                        <div class="col-lg-12">
                            <span class="{{Lang::locale()=='kh'? 'kh-os required' : 'arial'}}">{{trans('label.new_password')}}</span>
                            {!! Form::password('password',['class'=>Lang::locale()=='kh'? 'kh-os edit-form-control text-blue height-35' : 'arial edit-form-control text-blue height-35','pattern'=>'.{8,}','placeholder'=>trans('label.new_password'),'onchange'=>"this.setCustomValidity(this.validity.patternMismatch ? 'Must have at least 8 characters' : '');
                            if(this.checkValidity()) form.confirm_pass.pattern = this.value;",'required'=>true ]) !!}
                            @if($errors->has('password'))
                                <span class="text-danger">{{$errors->first('password')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <span class="{{Lang::locale()=='kh'? 'kh-os required' : 'arial'}}">{{trans('label.confirm')}}</span>
                            {!! Form::password('confirm_pass',['class'=>Lang::locale()=='kh'? 'kh-os edit-form-control text-blue height-35' : 'arial edit-form-control text-blue height-35','placeholder'=>trans('label.confirm'),'pattern'=>'.{8,}','onchange'=>"this.setCustomValidity(this.validity.patternMismatch ? 'Please enter the same Password as above' : '');", 'required'=>true ]) !!}

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::submit(trans('label.save'),['class'=>Lang::locale()==='kh' ? 'kh-os btn btn-primary btn-sm':'arial btn btn-primary btn-sm']) !!}
                            <a data-dismiss="modal" class="{{Lang::locale()==='kh' ? 'kh-os btn btn-danger btn-sm':'arial btn btn-danger btn-sm'}}">{{trans('label.close')}}</a>
                        </div>

                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
    </div>
</div>