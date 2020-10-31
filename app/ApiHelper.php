<?php 
use Illuminate\Support\Facades\DB;

//check if sysadmin
function isSysAdmin() 
{
  if ( Auth::user()->is_super_admin == 1 ) {
    return true;
  }

  return false;
}

function isAdmin()
{
        if ( Auth::user()->is_admin == 1 ) {
                return true;
        }

        return false;
}

function isUser() 
{
  if ( Auth::user()->is_user == 1 && ( !isSysAdmin() && !isAdmin() ) ) {
    return true;
  }

  return false;
}

function userAccountType()
{
  if ( isSysAdmin() )
    return 'System Admin';
  else if ( isAdmin() )
    return 'Admin';
  else if ( isUser() )
    return 'User';
  else
    return 'Unknow User';
}


function userRole($accountid)
{
  $user = DB::table('users')->where('id',$accountid)->first();
  if ( $user->is_super_admin == 1 )
    return 'System Admin';
  else if ( $user->is_admin == 1)
    return 'Admin';
  else if ( $user->is_user == 1 )
    return 'User';
  else
    return 'Unknow User';
}

//get UTC seconds
function getUTCSeconds()
{
  //return UTC offset seconds based on user timeZone selection
  $timezone = Auth::user()->time_zone;  
  
  return get_timezone_offset('UTC', $timezone);

  //return 19800;
}