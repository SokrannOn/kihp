{!! Form::label('listview',trans('label.list_view'),['class'=>Lang::locale()==='kh' ? 'kh-os' : 'time-roman']) !!}
<table class="{{Lang::locale()==='kh' ? 'kh-os table table-hover' : 'arial table table-hover'}}">
    <thead>
        <tr>
            <th >{{trans('label.No')}}</th>
            <th >{{trans('label.date')}}</th>
            <th >{{trans('label.name')}}</th>
            <th >{{trans('label.parent')}}</th>
            <th >{{trans('label.created_by')}}</th>
            <th class="center">{{trans('label.publish')}}</th>
            <th class="center">{{trans('label.action')}}</th>
        </tr>
    </thead>
    <tbody>
    @php($i=1)
    @foreach($categoryproduct->categoryproducts()->where('trash',0)->get() as $cat)
        <tr >
            <td>{{$i++}}</td>
            <td>{{\Carbon\Carbon::parse($cat->date)->format('d-M-Y')}}</td>
            <td >{{$cat->pivot->name}}</td>
            <td >{{$cat->parent ? DB::table('categoryproduct_language')->where([['language_id',$categoryproduct->id],['categoryproduct_id',$cat->parent]])->value('name') : ''}}</td>
            <td >{{$cat->user->name}}</td>
            <td class="center">
                @if($cat->publish)
                    <i class="fa fa-globe text-info" title="publish" aria-hidden="true"></i>
                @else
                    <i class="fa fa-lock text-warning" title="private" aria-hidden="true"></i>
                @endif
            </td>
            <td class="center">
                <a class="cursor-pointer padding-7px"​​ onclick='editCatPro("{{$cat->id}}","{{$cat->pivot->language_id}}")' data-toggle="modal" data-target=".bs-example-modal-sm"><i class="fa fa-edit"></i></a>
                <a class="cursor-pointer padding-7px text-danger" onclick='deleteCatpro("{{$cat->id}}")'><i class="fa fa-trash"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
