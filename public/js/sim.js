
/***** sim js *******/

DataTable();
function DataTable() {

    $title = "Device List";
    // Datatable defination
    $DataTable = $("#data_table").DataTable({
        ajax: "AllSim", //Ajax call, it will only work if ajax will return the
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
                    return ' '+data.sim_no+'<br><lable class="label bg-blue">Provider : '+data.sim_provider+'</lable>';
                }
            },
            {
                data: "mobile_no"
            },
            {
                data: null,
                render: function (data) {

                    //Edit and Delete button added if data is found
                    return '<lable class="label bg-green">'+data.use_days+'</lable><br><lable class="label bg-red">'+data.remaining_days+'</lable>';
                }
            },
            {
                data: "price"
            },
            {
                data: "selling_date_h"
            },
            {
                data: "billing_frequency"
            },
            {
                data: null,
                render: function (data) {

                    if (data.is_ex == 'yes') {

                        return ''+data.expiry_date_h+'<br><lable class="label bg-red">Is Expiry</label>'

                    }else{
                        return ''+data.expiry_date_h+'';
                    }
                    
                }
            },
            {
                data:"last_update_by"
            },
            {
                data: "status"
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
            "emptyTable": "No Sim Available"
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

    // var column = $DataTable.column( 0 );
 
    // $( column.footer() ).html(
    //     column.data().reduce( function (a,b) {
    //         return a+b;
    //     } )
    // );
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
        url: "/sim/delete",
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
                title: "Delete Record",
                content: $data.message
            });
        }
    });
}


setTimeout(function(){  $(".csrfTokan").val($("[name='_token']").val());  }, 1000);

$("#data_table tbody").on("click", '.btn_icon_edit', function () {


var data = $("#data_table").DataTable().row($(this).parents('tr')).data();
    console.log(data);
    $("#modal-edit-sim").modal('show');
    $("#simId").val(data['id']);
    $("#email").val(data['email']);
    $("#sim_no").val(data['sim_no']);
    $("#mobile_no").val(data['mobile_no']);
    $("#sim_provider").val(data['sim_provider']);
    $("#price").val(data['price']);
    $("#selling_date").val(data['sale_date']);
    $("#status").val(data['status']);

   

    $("#billing_frequency").val(data['billing_frequency']);
    

});


$("#edit_sim_from").on("submit", function (e) {

    e.preventDefault();
    $type = 'red';
    $icon = 'fa fa-times'

    // new staff ajax call
    $.ajax({
        url: "sim/edit",
        type: "POST",
        dataType: "json",
        contentType: false,
        processData: false,
        data: new FormData(this),
        success: function ($data) {
            if ($data.success === true) {
                $("#modal-edit-sim").modal('hide');
                $('#data_table').DataTable().ajax.reload(null, false);
                $type = 'green';
                $icon = 'fa fa-check';
            }
            $.alert({
                // Jquery confirm will display result after ajax
                title: "Edit SIM",
                icon: $icon,
                content: $data.message,
                type: $type
            });
            
        }

    });
});
