@if($jobcategory->count())
<label class="{{Lang::locale()==='kh' ? 'kh-os' : 'arial'}}">{{trans('label.list_view')}}</label>
<div class="table-responsive">
    <table id="example1" class="table table-bordered table-striped table-hover {{Lang::locale()==='kh' ? 'kh-os' : 'arial'}}">
        <thead>
        <tr>
            <th class="center">{{trans('label.No')}}</th>
            <th>{{trans('label.date')}}</th>
            <th>{{trans('label.name')}}</th>
            <th class="center">{{trans('label.created_by')}}</th>
            <th style="width:20%; !important;" class="center">{{trans('label.action')}}</th>
        </tr>
        </thead>
        <tbody>
        <?php $i=1;?>
        @foreach($jobcategory as $c)
            <tr>
                <td class="center">{{$i++}}</td>
                <td>{{ \Carbon\Carbon::parse($c->date)->format('d-M-Y')}}</td>
                <td>{{$c->pivot->name}}</td>
                <td class="center">{{$c->user->name}}</td>
                <td class="center">
                    <a class="cursor-pointer padding-7px"​​ onclick='editJobCat("{{$c->id}}","{{$c->pivot->language_id}}")' data-toggle="modal" data-target=".bs-example-modal-sm"><i class="fa fa-edit"></i></a>
                    <a href="#" onclick="deleteJobCat('{{$c->id}}')"><i class="fa fa-trash icon-delete"></i></a>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@else
    <h4 class="{{Lang::locale()==='kh' ? 'kh-os text-danger' : 'arial text-danger'}}" style="line-height: 50px;text-align: center;">{{trans('label.data_not_found')}}</h4>
@endif