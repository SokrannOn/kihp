<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="border-radius: 5px;">
        <div class="modal-header {{Lang::locale()=='kh'? 'kh-moul' : 'time-roman'}}">
            {{trans('label.detail')}}
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            @foreach($promo as $m)
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group text-info {{Lang::locale()=='kh'? 'kh-moul' : 'time-roman'}}">
                            {!! $m->pivot->name !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            {!! $m->pivot->description !!}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="modal-footer">
            <a href="" data-dismiss="modal" class="text-danger">Close</a>
        </div>
    </div>
</div>