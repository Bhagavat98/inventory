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

class DeviceImport implements ToModel, WithHeadingRow
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
            '1' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|unique:device,imei',
            '6' => 'date_format:d-m-Y',
            '7' => 'date_format:d-m-Y',
         ],[
            '0.required' => 'The Email field is required.',
            '0.unique'=>'The Imei already exists.',
            '1.min' => 'Required Imei No. 10 digits, match requested format!',
            '6.date_format' =>'The Date Format Is DD-MM-YY.',
            '7.date_format' =>'The Date Format Is DD-MM-YY.'
            ])->validate();

        return $row;

            $selling_date = date("Y-m-d",strtotime($row['selling_date']));
            $purchase_date = date("Y-m-d",strtotime($row['purchase_date'])); 

            $billing_frequency = $row['billing_frequency'];
        
            // billing frequency
            if ($billing_frequency  ==  'monthly' || $billing_frequency  ==  'month' || $billing_frequency  ==  'months') {

               $p_date = strtotime($purchase_date);
               $new_date = strtotime('+ 30 days', $p_date);
               $expiry_date = date('Y-m-d', $new_date);
               $billing_frequency = 'monthly';

            }else if ($billing_frequency  ==  'yearly' || $billing_frequency  ==  'year' || $billing_frequency  ==  'years') {
               
               $p_date = strtotime($purchase_date);
               $new_date = strtotime('+ 1 year', $p_date);
               $expiry_date = date('Y-m-d', $new_date);
               $billing_frequency = 'billing_frequency';
            }

            $arr = array(
                        'email' => $row['email'],
                        'imei' => $row['imei'],
                        'vehicleName'=>$row['vehicle_name'],
                        'cost'=>$row['cost'],
                        'device_type' => $row['device_type'], 
                        'renewal_charges'  => $row['renewal_charges'],
                        'purchase_date' => $purchase_date,
                        'expiry_date'=>$expiry_date,
                        'selling_date' => $selling_date,
                        'billing_frequency' => $billing_frequency,
                        'unique_serial'=>$row['unique_serial'],
                        'ICCD'=>$row['iccd'],
                        'updated_at'=>date('Y-m-d H:i:s'),
                        'created_at'=>date('Y-m-d H:i:s')
                        );
    try {
           $sql = DB::table('device')->insert($arr);

    } catch (QueryException $e) {

      Log::error('QueryException: ' . $e->getMessage());
      //dd($e->getMessage());
          
    }


}



}