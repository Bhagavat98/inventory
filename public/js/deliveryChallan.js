
/***** Delivery Challan js *******/
//alert();
$("#deviceList").select2({
    placeholder:" Select Device"
});
$("#simList").select2({
    placeholder:" Select Sim"
});

$("#otherstock").select2({
    placeholder:" Select Sim"
});


$("#created_by").select2({
	placeholder:" Select Created By"
});

$("#gst").select2({
	placeholder:"Select GST Percentage"
});

$("#customerList").select2({
	placeholder:"Select Customer"
});


$("#filterBy").select2({
    placeholder:" Select Filter By"
});


$('#simList').select2({ placeholder:" Select Sim" }).on("change", function(e) {   
  var uldiv = $(this).siblings('span.select2').find('ul');
  var count = uldiv.find('li').length - 1; 
  // alert('select2 counter'+count);
   $("#simListSelectedCount").text('Selected Device - '+count);
});

$('#deviceList').select2({ placeholder:" Select Device" }).on("change", function(e) {   
  var uldiv = $(this).siblings('span.select2').find('ul');
  var count = uldiv.find('li').length - 1; 
   $("#deviceListSelectedCount").text('Selected Device - '+count);
   //alert('select2 counter'+count);
});

$('#otherstock').select2({ placeholder:" Select Other Stock" }).on("change", function(e) {   
  var uldiv = $(this).siblings('span.select2').find('ul');
  var count = uldiv.find('li').length - 1; 
   $("#otherstockSelectedCount").text('Selected Other Stock - '+count);
   //alert('select2 counter'+count);
});






// $("#checkbox_select_all_device").click(function(){
//     if($("#checkbox_select_all_device").is(':checked') ){
//         $("#deviceList > option").prop("selected","selected");
//         $("#deviceList").trigger("change");
//     }else{
//         $("#deviceList > option").removeAttr("selected");
//          $("#deviceList").trigger("change");
//          $('#deviceList ').select2('destroy').find('option').prop('selected', false).end().select2(); 
//      }
// });


$("#checkbox_select_all_device").click(function(){
    if($("#checkbox_select_all_device").is(':checked') ){
        $("#deviceList > option").prop("selected","selected");
        $("#deviceList").trigger("change");
    }else{
       
         $('#deviceList ').select2('destroy').find('option').prop('selected', false).end().select2(); 
     }
});

$("#checkbox_select_all_sim").click(function(){ 
    if($("#checkbox_select_all_sim").is(':checked') ){
        $("#simList > option").prop("selected","selected");
        $("#simList").trigger("change");
    }else{
      //alert('uncheck');
       
        $('#simList ').select2('destroy').find('option').prop('selected', false).end().select2(); 
     }
});

$("#checkbox_select_all_otherstock").click(function(){
    if($("#checkbox_select_all_otherstock").is(':checked') ){
        $("#otherstock > option").prop("selected","selected");
        $("#otherstock").trigger("change");
    }else{
      
         $('#otherstock ').select2('destroy').find('option').prop('selected', false).end().select2(); 
     }   
});




// form date to date from call 
$("#challan_from").on("submit", function (e) {
   e.preventDefault();

    var str = '';

   	var simList = $("#simList").val();
   	var deviceList = $("#deviceList").val();
    // var deviceListprice = $("#deviceList").select2().find(":selected").data("id");
    // console.log("deviceListprice : "+deviceListprice);
    console.log('simList = '+simList+' deviceList = '+deviceList);

    if (simList == '' &&  deviceList == '' ) {

     alert('please select items from sim or device. after submit form..');

   }

   	
    $("#DeliveryChallanTable tbody").empty();
	

   	if (simList != '' || simList == null) {
   		
   		//$("#from_delivery_challan").show();
   		$("#DeliveryChallanTable tfoot").show();
   		$("#submitbtn").attr('disabled',false);
   		$(".simListtr").remove();
   		$("#sumtotal").val('0'); // if caler to total 
   		var trlenght = $('#DeliveryChallanTable tbody tr').length;

	   	$.each(simList, function ($k, $v) {

            var val = $v.split('|');
            //alert(val[0]); 
            if (val[1] == '') {
              val[1] = '0'; 
            }
	          console.log('trlenght'+trlenght);
	        trlenght++;
	   		str +='<tr class="simListtr">'+
	   					'<td style="width:7%">'+ 
                  '<input type="text" value="'+trlenght+'" placeholder="sr no." class="form-control" readonly name="srno[]" id="srno-'+trlenght+'" >'+
              '</td>'+
	   					'<td>'+
                  '<input type="text" value="Sim" placeholder="Item Type" class="form-control" readonly name="item_type[]" id="type-'+trlenght+'" > </td>'+
	   					'<td>'+
                  '<input type="hidden" value="'+val[0]+'"  placeholder="Stock ID" class="form-control stock_name" readonly name="stock_id[]" id="stock_id-'+trlenght+'" >'+
                  '<input type="text" value="'+val[0]+'" placeholder="Device/Sim" class="form-control items" readonly name="items[]" id="items-'+trlenght+'" >'+
              '</td>'+
              '<td>'+
                  '<input type="number" placeholder="Enter a Quantity" value="1" onkeyup="calcualteQuantityOnPrice('+trlenght+','+val[1]+')" readonly class="form-control quantity" name="quantity[]" id="quantity-'+trlenght+'" >'+
              '</td>'+
	   					'<td>'+
                  '<input type="number" onkeyup="calcualteTotalPrice()" required placeholder="Enter a Price" value="'+val[1]+'" class="form-control price" name="price[]" id="price-'+trlenght+'" >'+
              '</td>'+
	   					'<td>'+
                  '<i class="fas fa-trash-alt delete_btn" style="color:red; font-size:24px;" id="delete_btn-'+trlenght+'"></i>'+
              '</td>'+
	   			  '</tr>';
	   		
	    });

	    $("#DeliveryChallanTable tbody").append(str);
   }
   
   	
   	if (deviceList && deviceList.length > 0) {

   		//$("#from_delivery_challan").show();
   		$("#DeliveryChallanTable tfoot").show();
   		var trlenght = $('#DeliveryChallanTable tbody tr').length;
   		
   		$("#sumtotal").val('0'); // if caler to total 
   		$("#submitbtn").attr('disabled',false);
   		var counter =0;
   		var str1 = '';
	   	$.each(deviceList, function ($k, $v) {

	        counter++;
	        trlenght++;

           var val = $v.split('|');
            //alert(val[0]); 
            if (val[1] == '') {
              val[1] = '0'; 
            }

	   		str1 +='<tr class="deviceListtr">'+
	   					'<td style="width:7%">'+
                    '<input type="text" value="'+trlenght+'" placeholder="sr no." class="form-control" readonly name="srno[]" id="srno-'+trlenght+'" >'+
              '</td>'+
	   					'<td >'+
                    '<input type="text" value="Device" placeholder="Item Type" class="form-control" readonly name="item_type[]" id="type-'+trlenght+'" >'+
              '</td>'+
	   					'<td>'+
                    '<input type="hidden" value="'+val[0]+'"  placeholder="Stock ID" class="form-control stock_id" readonly name="stock_id[]" id="stock_id-'+trlenght+'" >'+
                    '<input type="text" value="'+val[0]+'" placeholder="Device/Sim" class="form-control items" readonly name="items[]" id="items-'+trlenght+'" >'+
              '</td>'+
	   					'<td>'+
                    '<input type="number" placeholder="Enter a Quantity" value="1" onkeyup="calcualteQuantityOnPrice('+trlenght+','+val[1]+')" readonly class="form-control quantity" name="quantity[]" id="quantity-'+trlenght+'" >'+
              '</td>'+
              '<td>'+
                    '<input type="number" required onkeyup="calcualteTotalPrice()" placeholder="Enter a Price" value="'+val[1]+'" class="form-control price" name="price[]" id="price-'+trlenght+'" >'+
              '</td>'+
	   					'<td>'+
                    '<i class="fas fa-trash-alt delete_btn" style="color:red; font-size:24px;" id="delete_btn-'+trlenght+'"></i>'+
              '</td>'+
	   			  '</tr>';
	   		
	    });
	    $("#DeliveryChallanTable tbody").append(str1);
   }

   	calcualteTotalPrice();
   	//$("#DeliveryChallanTable tbody").append(str);



});



// form challan_from_secound call 
$("#challan_from_secound").on("submit", function (e) {
   e.preventDefault();
    
   //console.log("str : "+str+" str1 : "+str1);

    var otherstock = $("#otherstock").val();
    if (otherstock == '' &&  otherstock == '' ) {
     alert('please select items from  sim or device. after submit form..');
   }

    if (otherstock && otherstock.length > 0) {

      var trlenght = $('#DeliveryChallanTable tbody tr').length;
      $("#DeliveryChallanTable tfoot").show();
     
      $("#sumtotal").val('0'); // if caler to total 
      $("#submitbtn").attr('disabled',false);
      var counter =0;
      var str2 = '';
      $.each(otherstock, function ($k, $v) {

          counter++;
          trlenght++;
          //{{ $value->id }}|{{ $value->name }}||{{ $value->available_stock }}|{{ $value->price }}
           var val = $v.split('|');
             console.log('id : '+val[0]+' name : '+val[1]+' available_stock : '+val[2]+' price : '+val[3]);
            if (val[3] == '') {
              val[3] = '0'; 
            }
            
        str2 +='<tr class="deviceListtr">'+
              '<td style="width:7%">'+
                    '<input type="text" value="'+trlenght+'" placeholder="sr no." class="form-control" readonly name="srno[]" id="srno-'+trlenght+'" >'+
              '</td>'+
              '<td>'+
                    '<input type="text" value="Other" placeholder="Item Type" class="form-control" readonly name="item_type[]" id="type-'+trlenght+'" > '+'</td>'+
              '<td>'+
                    '<input type="hidden" value="'+val[0]+'"  placeholder="Stock ID" class="form-control stock_id" readonly name="stock_id[]" id="stock_id-'+trlenght+'" >'+
                    '<input type="text" value="'+val[1]+'" placeholder="Stock Name" class="form-control items" readonly name="items[]" id="items-'+trlenght+'" >'+
              '</td>'+
              '<td>'+
                    '<input type="number" placeholder="Enter a Quantity" value="1" onkeyup="calcualteQuantityOnPrice('+trlenght+','+val[3]+')" value="'+val[2]+'"  class="form-control quantity" name="quantity[]" id="quantity-'+trlenght+'" >'+
              '</td>'+
              '<td>'+
                    '<input type="number" required onkeyup="calcualteTotalPrice()" placeholder="Enter a Price" value="'+val[3]+'" class="form-control price" name="price[]" id="price-'+trlenght+'" >'+
              '</td>'+
              '<td>'+
                    '<i class="fas fa-trash-alt delete_btn" style="color:red; font-size:24px;" id="delete_btn-'+trlenght+'"></i>'+
              '</td>'+
            '</tr>';
        
      });
      console.log("str2"+str2);
      $("#DeliveryChallanTable tbody").append(str2);
   }
    calcualteTotalPrice();
});


$("#DeliveryChallanTable tbody").on("click",".delete_btn", function(){
$(this).closest('tr').remove();	
calcualteTotalPrice();
});



function calcualteTotalPrice() {
	var total =0;
	var price = document.getElementsByName('price[]');
	for (var i = 0; i <price.length; i++) {
		 inp=price[i];
		 total +=inp.value << 0;
    }
    console.log(total);
    
    $("#sumtotal").val(total);
}

function calcualteQuantityOnPrice(id,price){

  var quantity = $("#quantity-"+id+"").val();
  total = price*quantity;
  $("#price-"+id+"").val(total);
  //alert(price*quantity);
  calcualteTotalPrice();
}


var origin   = window.location.origin;
var url      = window.location.href;   
if (url == origin+'/DeliveryChallan/show' || url == origin+'/DeliveryChallan/show#') {

	$("#challanList").select2({
		placeholder:"Select Challan No."
	});
}

if (url == origin+'/DeliveryChallan/show/fromDate' || url == origin+'/DeliveryChallan/show/fromDate#') {

	$("#challanList").select2({
		placeholder:"Select Challan No."
	});
}


// edit staust modal show
$("#data_table tbody").on("click", '.edit_status', function () {
      
    var id = $(this).data('id');
    var payment_status = $(this).data('payment_status');
   
    $(".challan_no").val(id);
    if(payment_status != ''){
      $("#payment_status").val(payment_status);
    }
  
    console.log("id :- "+id+" payment_status :- "+payment_status);

    $("#modal_edit_status").modal("show");
});

// send email modal show
$("#data_table tbody").on("click", '.send_email_btn', function () {
      
    var id = $(this).data('id');
    var customer_email = $(this).data('customer_email');
    var to_name = $(this).data('to_name');
    
    if(to_name != ''){
      $("#to_name").val(to_name);
    }
    
    $(".challanNo").val(id);
    if(customer_email != ''){
      $("#to_email").val(customer_email);
    }
  
    console.log("id :- "+id+" customer_email :- "+customer_email);

    $("#modal_send_email").modal("show");
});

// send email modal show
$("#data_table tbody").on("click", '.delete_challan_btn', function () {
      
    var id = $(this).data('id');
    if (id =='') {
      alert('Id Not Found');
    }
    console.log("id :- "+id);
     $.confirm({
        title: "Delete Challan",
        type: "red",
        icon: "fa fa-trash",
        content: "are you sure to Delete this Challan ?",
        buttons: {
            Yes: {
                btnClass: "btn-red",
                action: function () {
                    delete_table(id);
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
        url: "/challanDelete",
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
                title: "Delete Challan",
                content: $data.message
            });
        }
    });
}


// search vehicle
var path = "/searchChallanItems";
$('input.typeahead').typeahead({
    source: function(query, process) {
        return $.get(path, {
            query: query
        }, function(data) {
            return process(data);



        });
    }
});


$('input[type=search]').on('search', function() {

  if (this.value) {
      /* call ajax request here */
      console.log($(this).val());
      var res = this.value.substring(19, 15);
      $("#searchInput").val(res);
      searchInput(res);
      
  } else {
      alert('Item Name not found! ');
  }

});



function searchInput($value){

    console.log(" searchInput value :- "+$value);
    var value = $value.toLowerCase();
    $("#data_table tbody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });

}

function searchInputItems($value){

    console.log(" searchInput value :- "+$value);
    var value = $value.toLowerCase();
    $("#showChallanItemsTable tbody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });

}



// send email modal show
$("#data_table tbody").on("click", '.info_challan', function () {
      
    var id = $(this).data('id');
    if (id == '') {
      alert('challan_no not found');
    }

     $.ajax({
        url: "/showChallanItems/"+id+"",
        type: "GET",
        dataType: "json", //the output of ajax will parsed to json
        success: function ($data) {
            //$data contains the
            if ($data.length === 0) {
               alert('data not found.');
            }

            var str = ''; var counter = 0;
            $.each($data, function ($k, $v) {
              counter++;
              str +='<tr>'+
                        '<td>'+counter+'</td>'+
                        '<td>'+$v.items+'</td>'+
                        '<td>'+$v.item_type+'</td>'+
                        '<td>'+$v.price+'</td>'+
                        '<td>'+$v.quantity+'</td>'+
                        '<td>'+$v.description+'</td>'+
                        '<td>'+$v.created_at+'</td>'+
                    '</tr>';

            });

            $("#showChallanItemsTableBody").html(str);
            $("#showChallanItemsModal").modal("show");
        }
    });
  
    
    
});



