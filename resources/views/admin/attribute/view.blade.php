<h5 class="{{Lang::locale()==='kh' ? 'kh-os' : 'arial'}}">{{trans('label.list_view')}}</h5>
<table class="table table-hover">
    <thead>
        <tr>
            <th class="{{Lang::locale()==='kh' ? 'kh-os' : 'arial'}}">{{trans('label.No')}}</th>
            <th class="{{Lang::locale()==='kh' ? 'kh-os' : 'arial'}}">{{trans('label.date')}}</th>
            <th class="{{Lang::locale()==='kh' ? 'kh-os' : 'arial'}}">{{trans('label.name')}}</th>
            <th class="{{Lang::locale()==='kh' ? 'kh-os' : 'arial'}}">{{trans('label.action')}}</th>
        </tr>
    </thead>
    <tbody>
    @php($i=1)
        @foreach($attribute as $att)
           <tr>
               <td class="center,{{Lang::locale()==='kh' ? 'kh-os' : 'arial'}}">{{$i++}}</td>
               <td class="{{Lang::locale()==='kh' ? 'kh-os' : 'arial'}}">{{\Carbon\Carbon::parse($att->date)->format('d-M-Y')}}</td>
               <td class="{{Lang::locale()==='kh' ? 'kh-os' : 'arial'}}">{{$att->pivot->name ? $att->pivot->name : 'N/A'}}</td>
               <td class="center,{{Lang::locale()==='kh' ? 'kh-os' : 'arial'}}">
                   <a class="cursor-pointer padding-7px text-warning" onclick='editAtt("{{$att->id}}")' data-toggle="modal" data-target=".bs-example-modal-sm"><i class="fa fa-edit"></i></a>
                   <a class="cursor-pointer padding-7px text-danger" onclick='deleteAtt("{{$att->id}}")'><i class="fa fa-trash"></i></a>
               </td>
           </tr>
        @endforeach
    </tbody>
</table>