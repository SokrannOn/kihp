@if($activities->count())
<label class="{{Lang::locale()==='kh' ? 'kh-os' : 'arial'}}">{{trans('label.list_view')}}</label>
<div class="table-responsive">
    <table id="newstable" class="table table-bordered table-striped table-hover {{Lang::locale()==='kh' ? 'kh-os' : 'arial'}}">
        <thead>
        <tr>
            <th class="center">{{trans('label.No')}}</th>
            <th>{{trans('label.main_photo')}}</th>
            <th>{{trans('label.date')}}</th>
            <th>{{trans('label.category_name')}}</th>
            <th>{{trans('label.title')}}</th>
            <th>{{trans('label.description')}}</th>
            <th class="center">{{trans('label.publish')}}</th>
            <th>{{trans('label.created_by')}}</th>
            <th style="width:10%; !important;" class="center">{{trans('label.action')}}</th>
        </tr>
        </thead>
        <tbody>
        <?php $i=1;$logo='';?>
        @foreach($activities as $a)
            <tr>
                <td style="line-height: 50px" class="center">{{$i++}}</td>
                <td style="line-height: 50px" class="center"><img src='{{asset("newsImages/$a->main_photo")}}' alt="no image" style="background: white;border:2px solid #00A6C7;border-radius: 50px;padding:1px;height: 50px; width: 50px;"></td>
                <td style="line-height: 50px">{{ \Carbon\Carbon::parse($a->date)->format('d-M-Y')}}</td>
                <td style="line-height: 50px">
                    <?php
                        echo \Illuminate\Support\Facades\DB::table('category_language')->select('name')->where('category_id',$a->category_id)->where('language_id',$l)->value('name');
                    ?>
                </td>
                <td style="line-height: 50px">{{str_limit($a->pivot->title,15)}}</td>
                <td style="line-height: 50px">{!! str_limit($a->pivot->content,20) !!}</td>
                <td style="line-height: 50px" class="center">
                    @if($a->publish==0)
                        <i class='fa fa-lock text-red text-sm'></i>
                    @else
                        <i class='fa fa-globe text-green text-sm'></i>
                    @endif
                </td>
                <td style="line-height: 50px">{{$a->user->name}}</td>
                <td style="line-height: 50px" class="center">
                    <a href="{{url('news/edit'.'/'.$a->id.'/'.$a->pivot->language_id)}}" class="cursor-pointer padding-7px"​​><i class="fa fa-edit"></i></a>
                    <a onclick="deleteNews('{{$a->id}}')"><i class="fa fa-trash icon-delete cursor-pointer"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@else
    <h4 class="{{Lang::locale()==='kh' ? 'kh-os text-danger' : 'arial text-danger'}}" style="line-height: 50px;text-align: center;">{{trans('label.data_not_found')}}</h4>
@endif