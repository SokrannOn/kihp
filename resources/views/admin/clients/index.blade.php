@if($client->count())
<label class="{{Lang::locale()==='kh' ? 'kh-os' : 'arial'}}">{{trans('label.list_view')}}</label>
<div class="table-responsive">
    <table id="clienttable" class="table table-bordered table-striped table-hover {{Lang::locale()==='kh' ? 'kh-os' : 'arial'}}">
        <thead>
        <tr>
            <th class="center">{{trans('label.No')}}</th>
            <th>{{trans('label.logo')}}</th>
            <th>{{trans('label.date')}}</th>
            <th>{{trans('label.category_name')}}</th>
            <th>{{trans('label.title')}}</th>
            <th>{{trans('label.description')}}</th>
            <th class="center">{{trans('label.publish')}}</th>
            <th>{{trans('label.created_by')}}</th>
            <th style="width:20%; !important;" class="center">{{trans('label.action')}}</th>
        </tr>
        </thead>
        <tbody>
        <?php $i=1;$logo='';?>
        @foreach($client as $c)
            <tr>
                <?php $logo = $c->pivot->logo;?>
                <td style="line-height: 50px" class="center">{{$i++}}</td>
                <td style="line-height: 50px" class="center"><img src='{{asset("photo/$logo")}}' alt="no image" style="background: white;border:2px solid #00A6C7;border-radius: 50px;padding:1px;height: 50px; width: 50px;"></td>
                <td style="line-height: 50px">{{$c->date}}</td>
                <td style="line-height: 50px">
                    <?php
                        echo \Illuminate\Support\Facades\DB::table('category_language')->select('name')->where('category_id',$c->category_id)->where('language_id',$l)->value('name');
                    ?>
                </td>
                <td style="line-height: 50px">{{str_limit($c->pivot->title,15)}}</td>
                <td style="line-height: 50px">{!! str_limit($c->pivot->description,30) !!}</td>
                <td style="line-height: 50px" class="center">
                    @if($c->publish==0)
                        <i class='fa fa-lock text-red text-sm'></i>
                    @else
                        <i class='fa fa-globe text-green text-sm'></i>
                    @endif
                </td>
                <td style="line-height: 50px">{{$c->user->name}}</td>
                <td style="line-height: 50px" class="center">
                    <a class="cursor-pointer padding-7px"​​ onclick='editClient("{{$c->id}}","{{$c->pivot->language_id}}")' data-toggle="modal" data-target=".bs-example-modal-sm"><i class="fa fa-edit"></i></a>
                    <a href="#" onclick="deleteClient('{{$c->id}}')"><i class="fa fa-trash icon-delete"></i></a>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@else
    <h4 class="{{Lang::locale()==='kh' ? 'kh-os text-danger' : 'arial text-danger'}}" style="line-height: 50px;text-align: center;">{{trans('label.data_not_found')}}</h4>
@endif