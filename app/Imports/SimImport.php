<?php
   
namespace Inventory\Imports;
   
use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class SimImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

     
       Validator::make($row->toArray(), [

            '0' => 'required|email', // index start row email so email
            '1' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|unique:sim,mobile',
            '3' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|unique:sim,sim_no',
         ],[
            '0.required' => 'The Email field is required.',
            '1.min' => 'Required Sin No. 10 digits, match requested format!',
            '0.unique'=>'The Sim No. already exists.',
            '1.required' =>'The Sim No. field is required.',
            '3.unique'=>'The Mobile number already exists.',
            '3.min' => 'Required Sin No. 10 digits, match requested format!',
            '3.required' =>'The Sim No. field is required.',
            ])->validate();

        return $row;


    //         $selling_date = date("Y-m-d",strtotime($row['selling_date']));
    //         $purchase_date = date("Y-m-d",strtotime($row['purchase_date'])); 

    //         $billing_frequency = $row['billing_frequency'];
        
    //         // billing frequency
    //         if ($billing_frequency  ==  'monthly' || $billing_frequency  ==  'month' || $billing_frequency  ==  'months') {

    //            $p_date = strtotime($purchase_date);
    //            $new_date = strtotime('+ 30 days', $p_date);
    //            $expiry_date = date('Y-m-d', $new_date);

    //         }else if ($billing_frequency  ==  'yearly' || $billing_frequency  ==  'year' || $billing_frequency  ==  'years') {
               
    //            $p_date = strtotime($purchase_date);
    //            $new_date = strtotime('+ 1 year', $p_date);
    //            $expiry_date = date('Y-m-d', $new_date);
    //         }

    //         $arr = array(
    //                     'email' => $row['email'],
    //                     'sim_no' => $row['sim_no'],
    //                     'sim_provider'=>$row['sim_provider'],
    //                     'mobile_no'=>$row['mobile_no'],
    //                     'sale_date' => $row['sale_date'], 
    //                     'billing_frequency' => $billing_frequency,
    //                     'expiry_date'=>$expiry_date,
    //                     'updated_at'=>date('Y-m-d H:i:s'),
    //                     'created_at'=>date('Y-m-d H:i:s')
    //                     );
    // try {
    //        $sql = DB::table('sim')->insert($arr);

    // } catch (QueryException $e) {

    //   Log::error('QueryException: ' . $e->getMessage());
    //   //dd($e->getMessage());
          
    // }


}



}