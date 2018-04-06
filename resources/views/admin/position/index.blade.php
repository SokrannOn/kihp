@if($position->count())
    <label class="{{Lang::locale()==='kh' ? 'kh-os' : 'arial'}}">{{trans('label.list_view')}}</label>
    <div class="table-responsive">
        <table id="newstable" class="table table-bordered table-striped table-hover {{Lang::locale()==='kh' ? 'kh-os' : 'arial'}}">
            <thead>
            <tr>
                <th class="center">{{trans('label.No')}}</th>
                <th>{{trans('label.name')}}</th>
                <th>{{trans('label.description')}}</th>
                <th>{{trans('label.created_by')}}</th>
                <th class="center">{{trans('label.action')}}</th>
            </tr>
            </thead>
            <tbody>
            <?php $i=1;?>
            @foreach($position as $p)
                <tr>
                    <td class="center">{{$i++}}</td>
                    <td>{{$p->name}}</td>
                    <td>{!! $p->description !!}</td>
                    <td>{{$p->user->name}}</td>
                    <td class="center">
                        <a style="padding: 7px" onclick="updatePos('{{$p->id}}')" data-toggle="modal" data-target=".bs-example-modal-sm"><i class="fa fa-edit icon-edit cursor-pointer"></i></a>
                        <a onclick="deletePos('{{$p->id}}')"><i class="fa fa-trash icon-delete cursor-pointer"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@else
    <h4 class="{{Lang::locale()==='kh' ? 'kh-os text-danger' : 'arial text-danger'}}" style="line-height: 50px;text-align: center;">{{trans('label.data_not_found')}}</h4>
@endif