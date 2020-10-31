

$("#deviceList").select2({

});


deviceimei = [];
// 
$("#addStock_form").on("submit", function (e) {
   e.preventDefault();

    var str = '';
   	var deviceList = $("#deviceList").val();
    console.log('deviceList = '+deviceList);

 
    for (var i = 0; i < deviceimei.length; i++){

    	if (deviceimei[i] == deviceList) { 
	        alert(''+deviceList+' Item (imei) already selected');
	        return false;
        }
    }
    
   	deviceimei.push(deviceList);
   	console.log(deviceimei);
   	if (deviceList != '' || deviceList == null) {

   		$("#submitbtn").attr('disabled',false);
   		var trlenght = $('#addStockTable tbody tr').length+1;
   		
	   		str +='<tr class="tbodytr'+trlenght+'">'+
	   					'<td style="width:5%"> <input type="text" value="'+trlenght+'" placeholder="sr no." class="form-control" readonly name="srno[]" id="srno-"'+trlenght+'" " > </td>'+
	   					'<td style="width:12%">'+
	   					'<input type="text" placeholder="item (imei)" class="form-control" value="'+deviceList+'" readonly name="items[]" id="items-"'+trlenght+'" " >'+
	   					' </td>'+
	   					'<td> '+
	   					'<input type="text"  placeholder="vehicle Name" class="form-control "  name="vehicleName[]" id="vehicleName-"'+trlenght+'" >'+
	   					'</td>'+
	   					'<td>'+
	   					'<select class="form-control deviceType" name="deviceType[]" required id="deviceType-"'+trlenght+'" >'+
	   						'<option value="CANTRACK">CANTRACK</option>'+
	   						'<option value="TK103">TK103</option>'+
	   						'<option value="TK103">TK103</option>'+
                            '<option value="TK103">TK103</option>'+
                            '<option value="TK103-1">TK103-1</option>'+
                            '<option value="TK103-2">TK103-2</option>'+
                            '<option value="TK103-3">TK103-3</option>'+
                            '<option value="Kesan TK">Kesan TK</option>'+
                            '<option value="GT06">GT06</option>'+
                            '<option value="GT06N">GT06N</option>'+
                            '<option value="GT06F">GT06F</option>'+
                            '<option value="GT03A">GT03A</option>'+
                            '<option value="GT03B">GT03B</option>'+
                            '<option value="TR02">TR02</option>'+
                            '<option value="TR06">TR06</option>'+
                            '<option value="Autocop-TL500">Autocop-TL500</option>'+
                            '<option value="Autocop-TL250">Autocop-TL250</option>'+
                            '<option value="Autocop-TL3000">Autocop-TL3000</option>'+
                            '<option value="RP01">RP01</option>'+
                            '<option value="RP100">RP100</option>'+
                            '<option value="ET300">ET300</option>'+
                            '<option value="RP02-Concox">RP02-Concox</option>'+
                            '<option value="GT08">GT08</option>'+
                            '<option value="PT06">PT06</option>'+
                            '<option value="TK06A">TK06A</option>'+
                            '<option value="Android">Android</option>'+
                            '<option value="JV200">JV200</option>'+
                            '<option value="AV200">AV200</option>'+
                            '<option value="AV100">AV100</option>'+
                            '<option value="FMB920">FMB920</option>'+
                            '<option value="FMB1120">FMB1120</option>'+
                            '<option value="Teltonika">Teltonika</option>'+
                            '<option value="AIS-Concox800">AIS-Concox800</option>'+
                            '<option value="Wetrack2">Wetrack2</option>'+
                            '</select>'+
	   					' </td>'+
	   					'<td>'+
	   					'<input type="number" value="0" required placeholder="Enter a Price" class="form-control price" name="price[]" id="price-"'+trlenght+'" >'+
	   					' </td>'+
	   					'<td> '+
	   					'<input type="date" class="form-control purchase_date" required name="purchase_date[]" id="purchase_date-"'+trlenght+'" >'+
	   					' </td>'+
	   					'<td> '+
	   					'<input type="date" class="form-control selling_date" required name="selling_date[]" id="selling_date-"'+trlenght+'" >'+
	   					'</td>'+
	   					'<td>'+
	   					'<select class="form-control billing_frequency"  name="billing_frequency[]" required id="billing_frequency-"'+trlenght+'" >'+
	   						'<option value="30">Monthly</option>'+
                        	'<option value="90">6 Month</option>'+
                        	'<option value="365" selected>Yearly</option>'+
                        '</select>'+
	   					' </td>'+
	   					'<td>'+
	   					'<input type="text"   placeholder="Enter a ICCD/Sim No" class="form-control ICCD" name="ICCD[]" id="ICCD-"'+trlenght+'" >'+
	   					' </td>'+
	   					'<td>'+
	   					'<input type="text"  placeholder="Enter a Purchased From" class="form-control purchased_from" name="purchased_from[]" id="purchased_from-"'+trlenght+'" >'+
	   					'</td>'+
	   					'<td>'+
	   					'<input type="text" placeholder="Enter a Assigned To" class="form-control assigned_to" name="assigned_to[]" id="assigned_to-"'+trlenght+'" >'+
	   					'</td>'+

	   					'<td><i class="fas fa-trash-alt delete_btn" data-imei="'+deviceList+'" style="color:red; font-size:24px;" id="delete_btn-"'+trlenght+'"></i></td>'+
	   			  '</tr>';
	   		
	  
	    $("#addStockTable tbody").append(str);

	    $(".deviceType").select2({});
   }
  
});

$("#addStockTable tbody").on("click",".delete_btn", function(){
$(this).closest('tr').remove();	
var removeItem = $(this).data("imei");
//deviceimei.splice( $.inArray(removeItem, deviceimei), 1 );
for (var i = 0; i < deviceimei.length; i++)
    if (deviceimei[i] == removeItem) { 
        deviceimei.splice(i, 1);
        break;
    }
console.log('removeItem : '+removeItem+' deviceimei : '+deviceimei);

});