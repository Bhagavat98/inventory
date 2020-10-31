<?php
   
namespace Inventory\Imports;
   
use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
    
class SocietyImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    /*
    valdation fileds
    */
    // public function ValidatorSociety($request){
    
    //   $this->validate($request,[
    //         'name' => 'required|min:3|max:225',
    //         'email' => 'required|email|unique:users',
    //         'password' => 'required|max:6',
    //         'confirm_password' => 'required|max:6|same:password',
    //         'address' => 'required|max:400'
    //       ],[
    //         'name.required' => 'The name field is required.',
    //         'name.min' => ' The name must be at least 3 characters.'
            
    //       ]);

    // }

    public function model(array $row)
    {
       // $this->ValidatorSociety($row);
        $arr = array(
            'society_name' => $row['name'],
            'email'    => $row['email'],
            'mobile'    => $row['mobile'], 
            'society_admin'    => $row['mobile'],
            'address'    => $row['address'],
            'admin_email' => $row['admin_email'],
            'is_admin' => '1',
            'building'    => $row['building'],
            'password'    => Hash::make($row['password']),
            
        );

        $sql = DB::table('users')->insert($arr);
    }
}