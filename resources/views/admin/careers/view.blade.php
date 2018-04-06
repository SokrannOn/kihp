<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="border-radius: 10px;">
        <div class="panel panel-default">
            <div class="panel-heading {{\Illuminate\Support\Facades\Lang::locale()==='kh' ? 'kh-moul' : 'time-roman'  }}">
                {{trans('label.detail')}}
            </div>
            <div class="panel-body">
                @foreach($career as $c)
                    <div class="row">
                        <div class="col-lg-12">
                            <h4 class="text-blue {{\Illuminate\Support\Facades\Lang::locale()==='kh' ? 'kh-moul' : 'time-roman'  }} ">{{$c->pivot->title}}</h4>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-12">
                            {!! $c->pivot->description !!}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
