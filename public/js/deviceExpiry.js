
/***** Expriry Sim  *******/

//$("#data_table").DataTable()
$(".status").select2();

//search table
function search() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("search_input");
  filter = input.value.toUpperCase();
  table = document.getElementById("data_table");
  tr = table.getElementsByTagName("tr");
  // Loop through all table rows, and hide those who don't match the search query
    for ( i = 1; i < tr.length; i++ ) {
    
    if ( tr[ i ] ) {
      if ( tr[ i ].innerHTML.toUpperCase().indexOf( filter ) > -1 ) {
              tr[ i ].style.display = "";
          } else {
              tr[ i ].style.display = "none";
          } 
    }        

    }

}


setTimeout(function(){  $(".csrfTokan").val($("[name='_token']").val());  }, 1000);

$("#data_table tbody").on("click", '.btn_icon_edit', function () {

var data = $("#data_table").DataTable().row($(this).parents('tr')).data();
    

});


