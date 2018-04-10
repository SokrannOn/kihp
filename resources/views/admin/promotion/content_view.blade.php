@if(count($promo))
    <table id="viewPromotion" class="table table-bordered table-striped {{Lang::locale()==='kh' ? 'kh-os' : 'arial'}}">
        <thead>
        <tr class="{{Lang::locale()==='kh' ? 'kh-os' : 'arial'}}">
            <th class="center">{{trans('label.No')}}</th>
            <th class="center">{{trans('label.date')}}</th>
            <th>{{trans('label.name')}}</th>
            <th >{{trans('label.category')}}</th>
            <th>{{trans('label.created_by')}}</th>
            <th class="center">{{trans('label.publish')}}</th>
            <th style="width:20%; !important;" class="center">{{trans('label.action')}}</th>
        </tr>
        </thead>
        <tbody>
        <tr class="{{Lang::locale()==='kh' ? 'kh-os' : 'arial'}}">
            <?php $i=1;?>
            @foreach($promo as $p)
                <td class="center">{{$i++}}</td>
                <td class="center">{{\Carbon\Carbon::parse($p->date)->format('d-M-Y')}}</td>
                <td class="{{Lang::locale()==='kh' ? 'kh-os' : 'arial'}}">{{$p->pivot->name}}</td>
                <td class="{{Lang::locale()==='kh' ? 'kh-os' : 'arial'}}">@foreach($p->category->languages()->where([['language_id',$lid],['category_id',$p->category_id]])->get() as $cat ) {{$cat->pivot->name}} @endforeach</td>
                <td >{{$p->user->name}}</td>
                <td class="center">
                    @if($p->publish)
                        <i class="fa fa-globe text-info"></i>
                        @else
                        <i class="fa fa-lock text-danger"></i>
                    @endif
                </td>
                <td class="center">

                    <a href="{{route('promotion.edit',$p->id)}}" style="padding: 5px;"><i class="fa fa-edit"></i></a>
                    <a href="#" style="padding: 5px;" onclick='deletePro("{{$p->id}}")'><i class="fa fa-trash" style="color: red;"></i></a>
                    <a href="#" onclick='viewPro("{{$p->id}}")' data-toggle="modal" data-target=".bs-example-modal-lg" style="padding: 5px;" data-toggle="modal" data-target="#viewUser" style="padding: 5px;"><i class="fa fa-eye" style=""></i></a>

                </td>
        </tr>

        @endforeach
        </tbody>
    </table>

@else
    <h5 class="center">No record view</h5>
@endif