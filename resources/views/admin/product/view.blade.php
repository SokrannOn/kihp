@extends('admin.master')

@section('content')
    <br>
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                View Product
            </div>
            <div class="panel-body">
                <div class="container-fluid">
                    <div id="view" class="table-responsive">
                        <div class="center">
                            <i class="fa fa-spinner fa-pulse fa-3x"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                    <div id="detail"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(function () {
            getContent();
        });
        function deletePro(id) {
            swal({
                title: "{{trans('label.delete')}}",
                text: "{{trans('label.are_you_sure_delete')}}",
                type: "warning",
                showCancelButton:true,
                closeOnConfirm: "{{trans('label.cancel')}}",
                confirmButtonText: "{{trans('label.yes')}}",
                cancelButtonText : "{{trans('label.no')}}",
                confirmButtonColor: "#ec6c62"
            }, function() {
                $.ajax({
                    type : 'get',
                    url : "{{url('/product/delete/')}}"+"/"+id,
                    dataType: 'html'
                })
                    .done(function(data) {
                        swal("{{trans('label.deleted')}}", "{{trans('label.successfully_deleted')}}", "success");
                        $(document).ready(function () {
                            getContent();
                        });
                    })
                    .error(function(data) {
                        swal("Oops", "We couldn't connect to the server!", "error");
                    });
            });
        }
        function getContent() {
            $.ajax({
               type : 'get',
                url : "{{url('/product/get-content/view')}}",
                dataType: 'html',
                beforeSend:function () {

                },
                success:function (data) {
                    $('#view').html(data);
                    $('#viewProduct').dataTable();
                },
                error:function (error) {
                    console.log(error);
                }
            });
        }


        function viewPro(id) {
            $.ajax({
                type : 'get',
                url : "{{url('/product/view-detail')}}"+"/"+id,
                dataType: 'html',
                beforeSend:function () {

                },
                success:function (data) {
                    $('#detail').html(data);
                },
                error:function (error) {
                    console.log(error);
                }
            });
        }
    </script>
@endsection