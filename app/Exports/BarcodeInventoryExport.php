<?php
  
namespace Inventory\Exports;
  
use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
  
class BarcodeInventoryExport implements FromCollection
{


    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
      

    //dd(request()->segment(count(request()->segments())));
    $filterBy = request()->segment(count(request()->segments()));
    if ($filterBy == '1') {
      
      //echo die("today's ");

      $barcodeimeiDisplay = DB::table('advgps.barcode_imei_inventory')
                           ->whereDate('created_at', Carbon::today())
                           ->get();

      $filterByName = "Today's";
   
    }else if ($filterBy == '7') {
    
      //echo die("last week ");
      $barcodeimeiDisplay = DB::table('advgps.barcode_imei_inventory')
                           ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                           ->get();

      $filterByName = "Last Weel";

    }else if($filterBy == '15'){
    
      $last15day = \Carbon\Carbon::today()->subDays(15);
      //echo die("15 day's ");
      $barcodeimeiDisplay = DB::table('advgps.barcode_imei_inventory')
                           ->where('created_at', '>=', $last15day)
                           ->get();

      $filterByName = "Last 15 Days's";

    }else if($filterBy == '31'){
    
      //echo die("one month "); 
      $last31day = \Carbon\Carbon::today()->subDays(15);
      //echo die("15 day's ");
      $barcodeimeiDisplay = DB::table('advgps.barcode_imei_inventory')
                           ->where('created_at', '>=', $last31day)
                           ->get();

     $filterByName = "Last 1 Month";

    }else if($filterBy == '182'){
    
      //echo die("six month's "); 
      $last182day = \Carbon\Carbon::today()->subDays(182);
      //echo die("15 day's ");
      $barcodeimeiDisplay = DB::table('advgps.barcode_imei_inventory')
                           ->where('created_at', '>=', $last182day)
                           ->get();

      $filterByName = "Last 6 Month";

    }else if($filterBy == '365'){
    
      //echo die("six month's "); 
      $last365day = \Carbon\Carbon::today()->subDays(365);
      //echo die("15 day's ");
      $barcodeimeiDisplay = DB::table('advgps.barcode_imei_inventory')
                           ->where('created_at', '>=', $last365day)
                           ->get();

      $filterByName = "Last 1 Year";

    }else if($filterBy == 'all'){
    
      //echo die("All ");
      $barcodeimeiDisplay = DB::table('advgps.barcode_imei_inventory')
                           ->get();

      $filterByName = "All";

    }else{
      //echo die("today's "); // defulat
      $barcodeimeiDisplay = DB::table('advgps.barcode_imei_inventory')
                           ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                           ->get();
      $filterByName = "Last Week Defulat";
    }

    return $barcodeimeiDisplay;

    }
}