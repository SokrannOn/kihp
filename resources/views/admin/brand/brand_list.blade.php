<div class="container-fluid">
    <span class="{{Lang::locale()==='kh' ? 'kh-os' : 'arial'}}">{{trans('label.list_view')}}</span>
    <br>
    <table class="table table-hover">
        <thead>
            <tr>
                <th class="{{Lang::locale()==='kh' ? 'kh-os' : 'arial'}}">{{trans('label.No')}}</th>
                <th class="{{Lang::locale()==='kh' ? 'kh-os' : 'arial'}}">{{trans('label.name')}}</th>
                <th class=" center {{Lang::locale()==='kh' ? 'kh-os ' : 'arial'}}">{{trans('label.publish')}}</th>
                <th class="{{Lang::locale()==='kh' ? 'kh-os center' : 'arial center'}}">{{trans('label.action')}}</th>
            </tr>
        </thead>
        <tbody>
        @php($i=1)
            @foreach($brand as $b)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$b->name}}</td>
                    <td class="center">
                        @if($b->active == 1)
                           <i class="fa fa-globe text-info"></i>
                        @else
                            <i class="fa fa-lock"></i>
                        @endif
                    </td>
                    <td class="center">
                        <a class="cursor-pointer padding-7px text-warning" onclick='editBrand("{{$b->id}}")'><i class="fa fa-edit"></i></a>
                        <a class="cursor-pointer padding-7px text-danger"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>