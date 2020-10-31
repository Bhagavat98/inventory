
/***** Device js *******/

DataTable();
function DataTable() {

    $title = "Device List";
    // Datatable defination
    $DataTable = $("#data_table").DataTable({
        ajax: "AllDevices", //Ajax call, it will only work if ajax will return the
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
            	data:"email"
            },
            {
                data: null,
                render: function (data) {

                    //Edit and Delete button added if data is found
                    return ' '+data.imei+'<br><lable class="label bg-blue">Vehicle Name : '+data.vehicleName+'</label>';
                }
            },
            {
                data: "cost"
            },
            {
                data: "device_type"
            },
            // {
            //     data: "renewal_charges"
            // },
            {
                data: null,
                render: function (data) {

                    //Edit and Delete button added if data is found
                    return '<lable class="label bg-green">'+data.use_days+'</lable><br><lable class="label bg-red">'+data.remaining_days+'</lable>';
                }
            },
            {
                data: "selling_date_h"
            },
            {
                data: null,
                render: function (data) {

                    //Edit and Delete button added if data is found
                    
                    if (data.is_expiry == 1) {
                       return  ''+data.expiry_date_h+'</br><lable class="label bg-red">Is Expiry</lable>';
                    }else{

                        return ' '+data.expiry_date_h+'';
                    }
                }
            },
            {
            	data:"billing_frequency"
            },
            {
                data:"last_update_by"
            },
            {
                data: null,
                render: function (data) {

                    //Edit and Delete button added if data is found
                    if (data.payment_status == 'received') {

                        return '<lable class="label bg-green">'+data.payment_status+'</lable>';

                    }else if(data.payment_status == 'pending' || data.payment_status == null){

                        return '<lable class="label bg-yellow">pending</lable>';

                    }else{

                        return '<lable class="label bg-yellow">'+data.payment_status+'</lable>';
                    }
                }
            },
            {
                data: null,
                render: function (data) {

                    //Edit and Delete button added if data is found
                    return '<i class="fa fa-edit  btn_icon_edit"></i> &nbsp;&nbsp;<i class="fas fa-trash-alt btn_icon_trash delete_btn"></i>';
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
        title: "Delete Record",
        type: "red",
        icon: "fa fa-trash",
        content: "are you sure to Delete this Record ?",
        buttons: {
            Yes: {
                btnClass: "btn-red",
                action: function () {
                    delete_table(data['id'],data['imei']);
                },
            },
            No: function () {
                // Nothing will happen after clicking no
            }
        }
    })
});

function delete_table($id,$imei) {
    
    var token =$("#token").val();
    $type = "red";
    $icon = "fa fa-times";
    $.ajax({
        url: "/device/delete",
        type: "POST",
        dataType: "json", //the output of ajax will parsed to json
        data: { //passing data to ajax
            "id": $id,
            "imei": $imei,
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
                title: "Delete Record",
                content: $data.message
            });
        }
    });
}


setTimeout(function(){  $(".csrfTokan").val($("[name='_token']").val());  }, 1000);



$("#data_table tbody").on("click", '.btn_icon_edit', function () {

    $("#edit_device_from").trigger("reset");
var data = $("#data_table").DataTable().row($(this).parents('tr')).data();
    console.log(data);
    $("#modal-edit-device").modal('show');
    $("#deviceId").val(data['id']);
    $("#email").val(data['email']);
    $("#imei").val(data['imei']);
    $("#device_type").val(data['device_type']);
    $("#vehicle_name").val(data['vehicleName']);
    $("#cost").val(data['cost']);
    $("#renewal_charges").val(data['renewal_charges']);
    $("#purchase_date").val(data['purchase_date']);
    $("#selling_date").val(data['selling_date']);
    $("#iccd").val(data['ICCD']);
    if (data.payment_status != null) {

        $("#payment_status").val(data['payment_status']);
    }
    $("#billing_frequency").val(data['billing_frequency']);
    console.log(data['status']);
    $("#statusList").val(data['status']);
    $("#statusList").trigger("change");
   

});


$("#edit_device_from").on("submit", function (e) {

    e.preventDefault();
    $type = 'red';
    $icon = 'fa fa-times'

    // new staff ajax call
    $.ajax({
        url: "device/edit",
        type: "POST",
        dataType: "json",
        contentType: false,
        processData: false,
        data: new FormData(this),
        success: function ($data) {
            if ($data.success === true) {
                $("#modal-edit-device").modal('hide');
                $('#data_table').DataTable().ajax.reload(null, false);
                $type = 'green';
                $icon = 'fa fa-check';
            }
            $.alert({
                // Jquery confirm will display result after ajax
                title: "Edit Device",
                icon: $icon,
                content: $data.message,
                type: $type
            });
            
        }

    });
});


// $("#email").select2();
// $("#email").trigger("change");



