<?php
  
namespace Inventory\Exports;
  
use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
  
class DeviceExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
       // return User::all();
       return DB::table('device')->get();
    }
}