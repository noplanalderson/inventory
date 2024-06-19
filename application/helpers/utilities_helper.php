<?php
defined('BASEPATH') OR die('No direct script access allowed');
/**
 * Indonesian Date Function
 * 
 *
 * @access  public
 * @param   string  $date
 * @param   bool  $print_day
 * @param   bool  $time
 * @param   string $timezone
 * @return  string  
 * 
*/
function indonesian_date($date, $print_day = FALSE, $print_date = TRUE, $time = FALSE, $timezone = 'WIB')
{
  $day = array ( 1 => 'Senin',
      'Selasa',
      'Rabu',
      'Kamis',
      'Jumat',
      'Sabtu',
      'Minggi'
    );

  $month = array (1 =>   'Januari',
      'Februari',
      'Maret',
      'April',
      'Mei',
      'Juni',
      'Juli',
      'Agustus',
      'September',
      'Oktober',
      'November',
      'Desember'
    );
  if(!empty($date))
  {
    if(preg_match('/^\d+$/', $date)) 
    {
      if($time === true)
      {
        $date = date('Y-m-d H:i:s', $date);

        $split = explode('-', $date);
        $time = explode(' ', $split[2]);
        $indo_date = $time[0] . ' ' . $month[ (int)$split[1] ] . ' ' . $split[0] . ' - ' . $time[1] . ' ' . $timezone;
      }
      else
      {
        $date = date('Y-m-d', $date);

        $split = explode('-', $date);
        $indo_date = $split[2] . ' ' . $month[ (int)$split[1] ] . ' ' . $split[0];
      }

      if ($print_day) {
        $num = date('N', strtotime($date));
        return $day[$num] . ', ' . $indo_date;
      }

      return $indo_date;
    }
    elseif(empty($date))
    {
      return '-';
    }
    else
    {
      if($time ===  true)
      {
        $split = explode('-', $date);
        $time = explode(' ', $split[2]);
        $indo_date = $time[0] . ' ' . $month[ (int)$split[1] ] . ' ' . $split[0] . ' - ' . $time[1] . ' ' . $timezone;
      }
      elseif($print_date === true)
      {
        $split = explode('-', $date);
        $time = explode(' ', $split[2]);
        $indo_date = $time[0] . ' ' . $month[ (int)$split[1] ] . ' ' . $split[0];
      } else {
        $split = explode('-', $date);
        $time = explode(' ', $split[2]);
        $indo_date = $month[ (int)$split[1] ] . ' ' . $split[0];
      }

      if ($print_day) {
        $num = date('N', strtotime($date));
        return $day[$num] . ', ' . $indo_date;
      }

      return $indo_date;
    }
  }
  else
  {
    return '-';
  }
}

/**
 * Indonesian Month Function
 * 
 *
 * @access  public
 * @param   string  $date
 * @param   string $type
 * @return  string  
 * 
*/
function indonesian_month($date, $type = 'STANDAR')
{
  switch ($type) {
    case 'ROME':
      $month = array (
        1 => 'I',
        2 => 'II',
        3 => 'III',
        4 => 'IV',
        5 => 'V',
        6 => 'VI',
        7 => 'VII',
        8 => 'VIII',
        9 => 'IX',
        10=> 'X',
        11=> 'XI',
        12=> 'XII'
      );
      
      $split = explode('-', $date);
      $month_format = $month[ (int)$split[1] ];
      
      break;
    
    default:
      $month = array (
        1 => 'January',
        2 => 'February',
        3 => 'March',
        4 => 'April',
        5 => 'May',
        6 => 'June',
        7 => 'July',
        8 => 'August',
        9 => 'September',
        10=> 'October',
        11=> 'November',
        12=> 'December'
      );
      
      $split = explode('-', $date);
      $month_format = $month[ (int)$split[1] ].' '.$split[0];

      break;
  }

  return $month_format;
}

function remove_dir($dir)
{
  if(is_dir($dir))
  {
      foreach(scandir($dir) as $file) {
          if ('.' === $file || '..' === $file) continue;
          if (is_dir("$dir/$file")) remove_dir("$dir/$file");
          else @unlink("$dir/$file");
      }
      return (bool) @rmdir($dir);
  }
}

function rupiah($angka, $rp = true){
  
  $hasil_rupiah = number_format($angka,2,',','.');
  $hasil_rupiah = ($rp === true) ? "Rp. " . $hasil_rupiah : $hasil_rupiah;
  return $hasil_rupiah;
 
}

function validate_date($date)
{
	return (bool) preg_match('/^((([1-9]\d{3})\-(0[13578]|1[02])\-(0[1-9]|[12]\d|3[01]))|(((19|[2-9]\d)\d{2})\-(0[13456789]|1[012])\-(0[1-9]|[12]\d|30))|(([1-9]\d{3})\-02\-(0[1-9]|1\d|2[0-8]))|(([1-9]\d(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))\-02\-29))$/', $date);
}

/**
 * Get Real IP Function
 * 
 * Get real ip address from user
 *
 * @access  public
 * @return  string   
 * 
*/ 
function get_real_ip()
{
   if(!empty($_SERVER['HTTP_CLIENT_IP']))
   {
      $ip = $_SERVER['HTTP_CLIENT_IP'];
   }
   elseif ( ! empty($_SERVER['HTTP_X_FORWARDED_FOR']))
   {
      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
   }
   else
   {
      $ip = $_SERVER['REMOTE_ADDR'];
   }
   
   return $ip;
}