@extends('admin.master')
@section('content')
    <br>
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading {{\Illuminate\Support\Facades\Lang::locale()==='kh' ? 'kh-moul' : 'time-roman'  }}">
                {{trans('label.career')}}
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    @if($career->count())
                        <label class="{{Lang::locale()==='kh' ? 'kh-os' : 'arial'}}">{{trans('label.list_view')}}</label>
                        <div class="table-responsive">
                            <table id="" class="table table-bordered table-striped table-hover {{Lang::locale()==='kh' ? 'kh-os' : 'arial'}}">
                                <thead>
                                <tr>
                                    <th class="center">{{trans('label.No')}}</th>
                                    <th class="center">{{trans('label.date')}}</th>
                                    <th>{{trans('label.title')}}</th>
                                    <th>{{trans('label.job_category')}}</th>
                                    <th>{{trans('label.job_type')}}</th>
                                    <th>{{trans('label.location')}}</th>
                                    <th class="center">{{trans('label.close_date')}}</th>
                                    <th class="center">{{trans('label.publish')}}</th>
                                    <th class="center">{{trans('label.created_by')}}</th>
                                    <th style="width:20%; !important;" class="center">{{trans('label.action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i=1;?>
                                @foreach($career as $c)
                                    <tr>
                                        <td class="center">{{$i++}}</td>
                                        <td class="center">{{\Carbon\Carbon::parse($c->date)->format('d-M-Y')}}</td>
                                        <td>{{$c->pivot->title}}</td>
                                        <td>
                                            <?php
                                            echo \Illuminate\Support\Facades\DB::table('jobcategory_language')->select('name')->where('jobcategory_id',$c->jobcategory_id)->where('language_id',$l)->value('name');
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            echo \Illuminate\Support\Facades\DB::table('jobtype_language')->select('name')->where('jobtype_id',$c->jobtype_id)->where('language_id',$l)->value('name');
                                            ?>
                                        </td>
                                        <td>{{$c->location}}</td>
                                        <td class="center">{{\Carbon\Carbon::parse($c->close_date)->format('d-M-Y')}}</td>
                                        <td class="center">
                                            @if($c->publish==0)
                                                <i class='fa fa-lock text-red text-sm'></i>
                                            @else
                                                <i class='fa fa-globe text-green text-sm'></i>
                                            @endif
                                        </td>
                                        <td class="center">{{$c->user->name}}</td>
                                        <td class="center">
                                            <a title="{{trans('label.detail')}}" class="cursor-pointer padding-7px"​​ onclick='viewCareer("{{$c->id}}","{{$c->pivot->language_id}}")' data-toggle="modal" data-target=".bs-example-modal-sm"><i class="fa fa-eye text-info"></i></a>
                                            <a title="{{trans('label.edit')}}" href="{{url('career/edit'.'/'.$c->id.'/'.$c->pivot->language_id)}}" class="cursor-pointer padding-7px"​​><i class="fa fa-edit text-warning"></i></a>
                                            <a title="{{trans('label.delete')}}" class="cursor-pointer padding-7px" onclick="deleteCareer('{{$c->id}}')"><i class="fa fa-trash icon-delete"></i></a>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{$career->links()}}
                    @else
                        <h4 class="{{Lang::locale()==='kh' ? 'kh-os text-danger' : 'arial text-danger'}}" style="line-height: 50px;text-align: center;">{{trans('label.data_not_found')}}</h4>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div id="view" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">

    </div>
@stop
@section('script')
    <script>
        function viewCareer(id,langId) {
            $.ajax({
                type:'get',
                url:"{{url('/get/view')}}"+'/'+id+'/'+langId,
                dataType:'html',
                success:function (data) {
                    $('#view').html(data);
                },
                error:function (error) {
                    console.log(error);
                }
            });
        }

        function deleteCareer(id) {
            swal({
                title: "{{trans('label.are_you_sure')}}",
                text: "{{trans('label.are_you_sure_delete')}}",
                type: "warning",
                showCancelButton:true,
                closeOnConfirm: false,
                cancelButtonText: "{{trans('label.no')}}",
                confirmButtonText: "{{trans('label.yes')}}",
                confirmButtonColor: "#ec6c62"
            }, function() {
                $.ajax({
                    url : "{{url('/career/delete')}}"+"/"+id,
                    type: "get",
                    dataType: 'html'
                })
                    .done(function(data) {
                        window.location.reload();
                    })
            });
        }
    </script>
@stop
