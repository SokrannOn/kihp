function editForm(url,id,DataType,idHide) {
    $.ajax({
       type : 'get',
        url : url,
        dataType : DataType,
        success:function (data) {
            $(idHide).hide();
            $(id).html(data);
        },error:function (error) {
            console.log(error);
        }
    });
}

function cancelForm() {
    window.location.reload();
}
