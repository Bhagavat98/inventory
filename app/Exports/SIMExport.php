<?php
  
namespace Inventory\Exports;
  
use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
  
class SIMExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
       // return User::all();
       return DB::table('sim')->get();
    }
}