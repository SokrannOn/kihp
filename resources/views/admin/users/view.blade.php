
<div class="modal-dialog">
<!-- Modal content-->
    <div class="modal-content" style="border-radius:5px;">
        <div class="modal-header">
            <div class="{{\Illuminate\Support\Facades\Lang::locale()==='kh' ? 'kh-moul' : 'time-roman'  }}">
                {{trans('label.detail')}}
            </div>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <div class="center">
                <img src='{{asset("/photo/$user->photo")}}' alt="" id="preViewEdit" style="height: 120px; width: 120px; border-radius: 80px; border: 2px solid #346895; padding: 2px; margin: 0 auto;">
            </div>
            <br>
            <div style="margin: 0 10% 0 10%;">
                <table width="100%" border="0px" class="table table-condensed {{Lang::locale()==='kh' ? 'kh-os' : 'arial'}}">
                    <tr>
                        <td>{{trans('label.name')}}</td>
                        <td class="text-right">{{$user->name}}</td>
                    </tr>
                    <tr>
                        <td>{{trans('label.user_name')}}</td>
                        <td class="text-right">{{$user->username}}</td>
                    </tr>
                    <tr>
                        <td>{{trans('label.email')}}</td>
                        <td class="text-right">{{$user->email}}</td>
                    </tr>
                    <tr>
                        <td>{{trans('label.role')}}</td>
                        <td class="text-right">{{$user->role->name}}</td>
                    </tr>
                    <tr>
                        <td>{{trans('label.position')}}</td>
                        <td class="text-right">{{$user->position->name}}</td>
                    </tr>
                </table>
            </div>
        </div>
</div>







