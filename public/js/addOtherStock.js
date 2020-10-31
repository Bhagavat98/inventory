/***** Add Other Stock js *******/



deviceimei = [];
// 
$("#addStock_form").on("submit", function (e) {
    e.preventDefault();

         var str = '';

		$("#submitbtn").attr('disabled',false);
		var trlenght = $('#addStockTable tbody tr').length+1;
		
   		str +='<tr class="tbodytr'+trlenght+'">'+
   					'<td style="width:5%">'+ 
                        '<input type="text" value="'+trlenght+'" placeholder="sr no." class="form-control" readonly name="srno[]" id="srno-"'+trlenght+'" " >'+
                    '</td>'+
   					'<td >'+
   					    '<input type="text" required placeholder="Stock Name Ex:- Panic Button" class="form-control stockName"   name="stockName[]" id="stockName-"'+trlenght+'" " >'+
   					' </td>'+
   					'<td> '+
   					    '<input type="number" required placeholder="Enter Quantity Ex:-2" class="form-control quantity"  name="quantity[]" id="quantity-"'+trlenght+'" >'+
   					'</td>'+
                    '<td>'+
                        '<input type="number" value="0" required placeholder="Enter a Price" class="form-control price" name="price[]" id="price-"'+trlenght+'" >'+
                    '</td>'+
   					'<td>'+
       					'<select class="form-control billing_frequency" name="billing_frequency[]" required id="billing_frequency-"'+trlenght+'" >'+
       						'<option value="30">Monthly</option>'+
                            '<option value="90">6 Month</option>'+
                            '<option value="365" selected>Yearly</option>'+
                        '</select>'+
   					' </td><td>'+
   					   '<input type="date" class="form-control sale_date" required name="sale_date[]" id="sale_date-'+trlenght+'" >'+
   					'</td>'+
   					'<td>'+
                        '<i class="fas fa-trash-alt delete_btn"  style="color:red; font-size:24px;" id="delete_btn-"'+trlenght+'"></i>'+
                    '</td>'+
   			  '</tr>';
   		
    $("#addStockTable tbody").append(str);

    $(".deviceType").select2({});
 
  
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