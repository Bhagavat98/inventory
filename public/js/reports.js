
/***** Reports js *******/

$("#operator,#client_type,#device_type,#report_type,#providers").select2({});


    $('.from_date').datepicker({
      autoclose: true,
      format: 'dd-mm-yyyy'
    });

    $('.to_date').datepicker({
      autoclose: true,
      format: 'dd-mm-yyyy'
    });

jQuery(function(){
   jQuery('#submit_btn').click();
});

$("#reload_btn").on("click",function(){ 
    location.reload(true);
});

// form date to date from call 
$("#report_device_from").on("submit", function (e) {


	var client_type = $('#client_type option:selected').attr('data-id');
	var device_type = $('#device_type option:selected').attr('data-id');
	var report_type = $('#report_type option:selected').attr('data-id');


    var from_date = $("#from_date").val();
    var to_date = $("#to_date").val();

    var pdffilename = client_type+' Client on Device Type '+device_type+' Type '+report_type+' Reports  From - '+from_date+' - To - '+to_date;
    var pdftitle =  client_type+' Client on Device Type '+device_type+' Type '+report_type+' Reports  From - '+from_date+' - To - '+to_date;

    e.preventDefault();
    // new ajax call
    $.ajax({
        type: "POST",
        url: "/reports/device", //admin reports
        dataType: "json",
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function (data) {

            var table = $('#device_data_table').DataTable();
            table.destroy();
            
            $data_table = $("#device_data_table").DataTable({
                info: false,
                autoWidth: false,
                paging: true, // paging is set to false
                "aaData":data,
                "columns": [
                    //filling the tbody with json data
                    {
                        data: "index"
                    },
                    {
            	        data:"email"
                    },
                    { 
                        data: "imei"
                    },
                    {
                        data: "vehicleName"
                    },
                    {
                        data: "cost"
                    },
                    {
                        data: "device_type"
                    },
                    {
                        data: "renewal_charges"
                    },
                    {
                        data: "p_date"
                    },
                    { 
                        data: "s_date"
                    },
                    {
            	        data:"e_date"
                    },
                    {
            	        data:"billing_frequency"
                    },
                    ],
                    dom: 'Bfrtip',
	                buttons: [{
	                        extend: 'print',
	                        text: '<i class="fa fa-print"></i> Print',
	                        className: "btn btn-defult",
	                        titleAttr: 'Print',
	                        title: pdftitle
	                    },
	                    {
	                        extend: 'pdfHtml5',
	                        text: '<i class="fa fa-file-pdf-o"></i> Download PDF',
	                        className: "btn btn-danger",
	                        title: pdftitle,
	                        filename:pdffilename,
	                        titleAttr: 'PDF'
	                    },
	                    {
	                        extend: 'excelHtml5',
	                        text: '<i class="fa fa-file-excel-o"></i> Download Excel',
	                        className: "btn btn-success",
	                        title: pdftitle,
	                        pageSize: 'A4',
	                        orientation: 'landscape',
	                        filename:pdffilename,
	                        titleAttr: 'Excel'
	                    },
	                    {
	                        extend: 'csvHtml5',
	                        text: '<i class="fa fa-file-excel-o"></i> Download Csv',
	                        className: "btn btn-info",
	                        title: pdftitle,
	                        pageSize: 'A4',
	                        orientation: 'landscape',
	                        filename:pdffilename,
	                        titleAttr: 'CSV'
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
                        "emptyTable": "No Reports Available"
                    }
                });
                $data_table.on('order.dt search.dt', function () {
                    $data_table.column(0, {
                        search: 'applied',
                        order: 'applied'
                    }).nodes().each(function (cell, i) {
                        cell.innerHTML = i + 1;
                    });
                }).draw();

           console.log(data);
        }

    });
});



// form date to date from call 
$("#report_sim_from").on("submit", function (e) {


	var client_type = $('#client_type option:selected').attr('data-id');
	var providers = $('#providers option:selected').attr('data-id');
	var report_type = $('#report_type option:selected').attr('data-id');


    var from_date = $("#from_date").val();
    var to_date = $("#to_date").val();

    var pdffilename = client_type+' Client on SIM '+providers+' Report Type '+report_type+'  From - '+from_date+' - To - '+to_date;
    var pdftitle =  client_type+' Client on SIM '+providers+' Report Type '+report_type+'  From - '+from_date+' - To - '+to_date;

    e.preventDefault();
    // new ajax call
    $.ajax({
        type: "POST",
        url: "/reports/sim", //admin reports
        dataType: "json",
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function (data) {

            var table = $('#sim_data_table').DataTable();
            table.destroy();
            
            $data_table = $("#sim_data_table").DataTable({
                info: false,
                autoWidth: false,
                paging: true, // paging is set to false
                "aaData":data,
                "columns": [
                    //filling the tbody with json data
                    {
                        data: "index"
                    },
                    {
		            	data:"email"
		            },
		            {
		                data: "sim_no" 
		            },
		            {
		                data: "sim_provider"
		            },
		            {
		                data: "mobile_no"
		            },
		            {
		                data: "price"
		            },
		            {
		                data: "sale_date"
		            },
		            {
		                data: "billing_frequency"
		            },
		            {
		                data:"e_date"
		            },
		            {
		                data: "status"
		            },
                    ],
                    dom: 'Bfrtip',
	                buttons: [{
	                        extend: 'print',
	                        text: '<i class="fa fa-print"></i> Print',
	                        className: "btn btn-defult",
	                        titleAttr: 'Print',
	                        title: pdftitle
	                    },
	                    {
	                        extend: 'pdfHtml5',
	                        text: '<i class="fa fa-file-pdf-o"></i> Download PDF',
	                        className: "btn btn-danger",
	                        title: pdftitle,
	                        filename:pdffilename,
	                        titleAttr: 'PDF'
	                    },
	                    {
	                        extend: 'excelHtml5',
	                        text: '<i class="fa fa-file-excel-o"></i> Download Excel',
	                        className: "btn btn-success",
	                        title: pdftitle,
	                        pageSize: 'A4',
	                        orientation: 'landscape',
	                        filename:pdffilename,
	                        titleAttr: 'Excel'
	                    },
	                    {
	                        extend: 'csvHtml5',
	                        text: '<i class="fa fa-file-excel-o"></i> Download Csv',
	                        className: "btn btn-info",
	                        title: pdftitle,
	                        pageSize: 'A4',
	                        orientation: 'landscape',
	                        filename:pdffilename,
	                        titleAttr: 'CSV'
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
                        "emptyTable": "No Reports Available"
                    }
                });
                $data_table.on('order.dt search.dt', function () {
                    $data_table.column(0, {
                        search: 'applied',
                        order: 'applied'
                    }).nodes().each(function (cell, i) {
                        cell.innerHTML = i + 1;
                    });
                }).draw();

           console.log(data);
        }

    });
});



