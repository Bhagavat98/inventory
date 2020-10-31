
/***** Customer js *******/
DataTable();
function DataTable() {

    $title = "Customer List";
    // Datatable defination
    $DataTable = $("#data_table").DataTable({
        ajax: "AllCustomer", //Ajax call, it will only work if ajax will return the
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
                    return '<span class="label bg-green">'+data.customer_type+'</span>';
                }
            },
            {
                data: "billing_code"
            },
            {
                data: "application"
            },
            {
                data: null,
                render: function (data) {

                    //Edit and Delete button added if data is found
                    return '<a href="customer/edit/'+data.id+'"><i class="fa fa-edit  btn_icon_edit" ></i></a> ' +
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
            "emptyTable": "No Customer Available"
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
        title: "Delete Customer",
        type: "red",
        icon: "fa fa-trash",
        content: "are you sure to Delete this Customer ?",
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
        url: "/customer/delete",
        type: "POST",
        dataType: "json", //the output of ajax will parsed to json
        data: { //passing data to ajax
            "id": $id,
            "_token":token
        },
        success: function ($data) {
            //$data contains the
            if ($data.success === true) {
               location.reload();// $('#data_table').DataTable().ajax.reload(null, false);
                $type = "green";
                $icon = "fa fa-check";
            }
            // If delete is success
            $.alert({
                icon: $icon,
                type: $type,
                title: "Delete Customer",
                content: $data.message
            });
        }
    });
}


setTimeout(function(){  $(".csrfTokan").val($("[name='_token']").val());  }, 1000);
