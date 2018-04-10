@if($contact->count())
<label class="{{Lang::locale()==='kh' ? 'kh-os' : 'arial'}}">{{trans('label.list_view')}}</label>
<div class="table-responsive">
    <table id="example1" class="table table-bordered table-striped table-hover {{Lang::locale()==='kh' ? 'kh-os' : 'arial'}}">
        <thead>
        <tr>
            <th class="center">{{trans('label.No')}}</th>
            <th>{{trans('label.company_name')}}</th>
            <th>{{trans('label.phone_number')}}</th>
            <th>{{trans('label.email')}}</th>
            <th>{{trans('label.website')}}</th>
            <th>{{trans('label.address')}}</th>
            <th style="width:20%; !important;" class="center">{{trans('label.action')}}</th>
        </tr>
        </thead>
        <tbody>
        <?php $i=1;?>
        @foreach($contact as $p)
            <tr>
                <td class="center">{{$i++}}</td>
                <td>{{$p->company_name}}</td>
                <td>{{$p->phone_number}}</td>
                <td>{{$p->email}}</td>
                <td>{{$p->website}}</td>
                <td>{{$p->address}}</td>
                <td class="center">
                    <a class="cursor-pointer" onclick="editContact('{{$p->id}}')"><i class="fa fa-edit icon-edit"></i> </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@else
    <h4 class="{{Lang::locale()==='kh' ? 'kh-os text-danger' : 'arial text-danger'}}" style="line-height: 50px;text-align: center;">{{trans('label.data_not_found')}}</h4>
@endif