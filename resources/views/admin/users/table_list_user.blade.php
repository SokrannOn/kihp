@if($user->count())
    <label class="{{Lang::locale()==='kh' ? 'kh-os' : 'arial'}}">{{trans('label.list_view')}}</label>
<div class="table-responsive">
    <table id="table" class="table table-bordered table-striped {{Lang::locale()==='kh' ? 'kh-os' : 'arial'}}">
        <thead>
        <tr>
            <th class="center">{{trans('label.No')}}</th>
            <th class="center">{{trans('label.photo')}}</th>
            <th>{{trans('label.name')}}</th>
            <th>{{trans('label.user_name')}}</th>
            <th>{{trans('label.position')}}</th>
            <th>{{trans('label.email')}}</th>
            <th style="width:20%; !important;" class="center">{{trans('label.action')}}</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <?php $i=1;?>
            @foreach($user as $u)
                <td style="line-height: 50px;" class="center">{{$i++}}</td>
                <td class="center"><img src='{{asset("photo/$u->photo")}}' alt="no image" style="background: white;border:2px solid #00A6C7;border-radius: 50px;padding:1px;height: 50px; width: 50px;"></td>
                <td style="line-height: 50px">{{$u->name}}</td>
                <td style="line-height: 50px">{{$u->username}}</td>
                <td style="line-height: 50px">{{$u->position->name}}</td>
                <td style="line-height: 50px">{{$u->email}}</td>
                <td style="line-height: 50px" class="center">


                    <a class="cursor-pointer icon-edit" onclick='editUser("{{$u->id}}")' style="padding: 5px;" data-toggle="modal" data-target="#editUser"><i class="fa fa-edit"></i></a>
                    <a class="cursor-pointer" onclick='resetPassword("{{$u->id}}")' data-toggle="modal" data-target=".bs-example-modal-sm" style="padding: 5px;"><i class="fa fa-refresh"></i></a>
                    <a class="cursor-pointer icon-trash" style="padding: 5px;" onclick='deleteUser("{{$u->id}}")'><i class="fa fa-trash" style="color: red;"></i></a>
                    <a class="cursor-pointer icon-view" onclick='viewUser("{{$u->id}}")' style="padding: 5px;" data-toggle="modal" data-target="#viewUser" style="padding: 5px;"><i class="fa fa-eye" style=""></i></a>

                </td>
        </tr>

        @endforeach
        </tbody>
    </table>
</div>
@else
    <h4 class="{{Lang::locale()==='kh' ? 'kh-os text-danger' : 'arial text-danger'}}" style="line-height: 50px;text-align: center;">{{trans('label.data_not_found')}}</h4>
@endif