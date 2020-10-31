
/***** Accounts js *******/
DataTable();
function DataTable() {

    $title = "Accounts List";
    // Datatable defination
    $DataTable = $("#data_table").DataTable({
        ajax: "AllAccounts", //Ajax call, it will only work if ajax will return the
        // data in the format of json ex;- {"data":[{"key1":"val1","key2":"val2,....}]},
        info: false,
        autoWidth: false,
        paging: true, // paging is set to false
        columns: [
            //filling the tbody with json data
            {
                data: null
            },
            {
                data: "name"
            },
            {
                data: "email"
            },
            {
                data: "mobile"
            },
            {
                data: null,
                render: function (data) {

                    return '<span class="label bg-green">'+data.role+'</span>';
                }
            },
            {
                data: "address"
            },
            {
                data: null,
                render: function (data) {

                    var myUniqueId = $("#myUniqueId").val();
                    console.log("data.id = "+data.id+" myUniqueId = "+myUniqueId);
                    if (myUniqueId == data.id) {
 console.log("data.id = "+data.id+" myUniqueId = "+myUniqueId);
                         return  '<form action="accounts/adminlogin" method="post" >' +
                            '<input type="hidden" name="id" value="'+data.id+'">' +
                            '<input type="hidden" name="_token" class="csrfTokan">' +
                            '<input type="hidden" name="email" value="'+data.email+'">' +
                        '<button type="submit" class=" btn btn-danger" disabled><i class="fas fa-sign-in-alt"></i> login</button></form>';
                    }else{

                        //Edit and Delete button added if data is found
                        return  '<form action="accounts/adminlogin" method="post" >' +
                            '<input type="hidden" name="id" value="'+data.id+'">' +
                            '<input type="hidden" name="_token" class="csrfTokan">' +
                            '<input type="hidden" name="email" value="'+data.email+'">' +
                        '<button type="submit" class=" btn btn-danger"><i class="fas fa-sign-in-alt"></i> login</button></form>';
                    }
                    
                }
            },
            {
                data: null,
                render: function (data) {

                    //Edit and Delete button added if data is found
                    return '<a href="vendor/'+data.id+'"><i class="fa fa-edit  btn_icon_edit" ></i></a> ' +
                        '<i class="fas fa-trash-alt btn_icon_trash delete_btn"></i>';
                }
            }
        ],
        "columnDefs": [{
            // disabling ordering and searching false for action column
            //"targets": ,
            "searchable": false,
            "orderable": false
        }],
        sAjaxDataProp: "data",
        "language": { 
            "emptyTable": "No Accounts Available"
        }
    });
    $DataTable.on('order.dt search.dt', function () {
        $DataTable.column(0, {
            search: 'applied',
            order: 'applied'
        }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();
}

// assigning onclick event for delete button
$("#data_table tbody").on("click", '.delete_btn', function () {
    var data = $("#data_table").DataTable().row($(this).parents('tr')).data();
    
    $.confirm({
        title: "Delete Account",
        type: "red",
        icon: "fa fa-trash",
        content: "are you sure to Delete this Account ?",
        buttons: {
            Yes: {
                btnClass: "btn-red",
                action: function () {
                    delete_table(data['id']);
                },
            },
            No: function () {
                // Nothing will happen after clicking no
            }
        }
    })
});

function delete_table($id) {
    
    var token =$("#token").val();
    $type = "red";
    $icon = "fa fa-times";
    $.ajax({
        url: "/account/delete",
        type: "POST",
        dataType: "json", //the output of ajax will parsed to json
        data: { //passing data to ajax
            "id": $id,
            "_token":token
        },
        success: function ($data) {
            //$data contains the
            if ($data.success === true) {
                $('#data_table').DataTable().ajax.reload(null, false);
                $type = "green";
                $icon = "fa fa-check";
            }
            // If delete is success
            $.alert({
                icon: $icon,
                type: $type,
                title: "Delete Account",
                content: $data.message
            });
        }
    });
}


setTimeout(function(){  $(".csrfTokan").val($("[name='_token']").val());  }, 1000);
