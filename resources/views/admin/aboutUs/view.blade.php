@extends('admin.master')
@section('content')
    <br>
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading {{Lang::locale()=='kh' ? 'kh-moul' : 'time-roman'}}">
                {{trans('label.view_about_us_list')}}
            </div>
            <div class="panel-body">
                <div class="table table-responsive">
                    @if(count($about))
                        <table class="table table-hover {{Lang::locale()=='kh' ? 'kh-os' : 'arial'}}">
                            <thead>
                            <tr>
                                <th>{{trans('label.No')}}</th>
                                <th>{{trans('label.date')}}</th>
                                <th>{{trans('label.category')}}</th>
                                <th class="center">{{trans('label.publish')}}</th>
                                <th class="center">{{trans('label.action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i=1)
                            @foreach($about as $a)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$a->date}}</td>
                                    <td>
                                        @foreach($a->category->languages()->where('languages.id',$lid)->get() as $l)
                                            {{$l->pivot->name}}
                                        @endforeach
                                    </td>
                                    <td class="center">
                                        @if($a->publish)
                                            <i class="fa fa-globe text-info"></i>
                                        @else
                                            <i class="fa fa-unlock text-info center "></i>
                                        @endif
                                    </td>
                                    <td class="center">
                                        <a href="{{route('promotion.edit',$a->id)}}" style="padding: 5px;"><i class="fa fa-edit"></i></a>
                                        <a href="#" style="padding: 5px;" onclick='deleteAb("{{$a->id}}")'><i class="fa fa-trash" style="color: red;"></i></a>
                                        <a href="#" onclick='viewPro("{{$a->id}}")' data-toggle="modal" data-target=".bs-example-modal-lg" style="padding: 5px;" data-toggle="modal" data-target="#viewUser" style="padding: 5px;"><i class="fa fa-eye" style=""></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @else
                        <h5 class="center">No record view</h5>
                    @endif
                </div>
            </div>
            <div class="panel-footer">
                <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                    <div id="detail">sdfsafad</div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function deleteAb(id) {
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
                    url : "{{url('/aboutus/delete-record')}}"+"/"+id,
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
    </script>
@endsection