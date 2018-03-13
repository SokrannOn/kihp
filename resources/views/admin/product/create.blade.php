@extends('admin.master')

@section('content')
    <br>
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading {{Lang::locale()==='kh' ? 'kh-moul' : 'time-roman'}}">
                {{trans('label.product')}}
            </div>
            <div class="panel-body">
                <div class="row">

                </div>
            </div>
            <div class="panel-footer">

            </div>
        </div>
    </div>
@endsection


@section('script')


@endsection