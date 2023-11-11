<?php
use Illuminate\Support\Facades\Auth;
use App\Models\Settings;

function show_status($status){
    if($status == "1"){
        return "<span class='badge badge-success'>Enabled</span>";
    }elseif($status == "0"){
        return "<span class='badge badge-danger'>Disabled</span>";
    }else{
        return $status;
    }
}

function admin_id(){
    return Auth::id();
}

function sqldate($date, $seperator = "/", $format = "d/m/Y")
{
    if ($date) {
        $d = explode($seperator, $date);
        $f = explode($seperator, $format);

        $dd[$f[2]] = $d[2];
        $dd[$f[1]] = $d[1];
        $dd[$f[0]] = $d[0];

        //$finaldate = $m;
        return $dd['Y'] . "-" . $dd['m'] . "-" . $dd['d'];
    } else {
        return null;
    }
}


/**
 * Get d-m-Y formatted date from sql formatted date
 * @param string $d sql formatted date
 * @return string d-m-Y formatted date
 * @author Jamiul Hasan
 */
function mydate($d, $seperator = "-")
{
    if ($d == "0000-00-00") {
        return "";
    }
    $d = explode("-", $d);
    $year = $d[0];
    $month = $d[1];
    $day = $d[2];

    $finaldate = $day . $seperator . $month . $seperator . $year;
    return $finaldate;
}

function get_settings($name){
    $setting = Settings::where('name',$name)->get();
    if($setting->count()){
        return $setting[0]->value;
    }else{
        return '';
    }
}
