<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="border-radius: 5px;">
       <div class="modal-header">
           Detail
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        @foreach($pro as $p)
                            <h4 class="text-info {{Lang::locale()==='kh' ? 'kh-moul' : 'time-roman'}}">{{$p->pivot->name}}</h4>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        @foreach($pro as $p)
                            {!! $p->pivot->description !!}
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <span class="text-info {{Lang::locale()==='kh' ? 'kh-moul' : 'time-roman'}}">{{trans('label.main_photo')}}</span>
                    <div class="form-group">
                        <div class="padding-7px" style="width:50%">
                            @foreach($pro as $p)
                                <div class="item" style="float: left">
                                    <img class="img-thumbnail img-responsive" src='{{asset("mainProduct/$p->photo")}}' alt="no image">
                                    <div class="item-overlay top"></div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <span class="text-info {{Lang::locale()==='kh' ? 'kh-os' : 'time-roman'}}">{{trans('label.picdetail')}}</span>
                    <div class="form-group">
                        @foreach($pro as $pros)
                            @foreach($pros->photoproducts as $p)
                                <div class="item" style="float: left">
                                    <img class="img-thumbnail img-responsive" src='{{asset("picDetailProduct/$p->name")}}' alt="no image">
                                    <div class="item-overlay top"></div>
                                </div>
                                @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="" data-dismiss="modal" class="text-danger">Close</a>
        </div>
    </div>
</div>