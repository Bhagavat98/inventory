
/***** Other Stock js *******/

$("#filterBy").select2({
    placeholder:" Select Filter By"
});



$("#data_table").DataTable();

$("#data_table tbody").on("click", '.addOtherinfo', function () {
    var data = $("#data_table").DataTable().row($(this).parents('tr')).data();
    
    $("#modalUpdate").modal('show');
      
      console.log(data);
      $("#imeiinventory").val(data[1]);
      $("#deviceType").val(data[2]);
      $("#selling_date").val(data[6]);
      $("#purchased_from_inventory").val(data[3]);
      $("#assigned_to_inventory").val(data[4]);
      //$("#assigned_at_inventory").val(data[5]);

    // console.log(data);
});


