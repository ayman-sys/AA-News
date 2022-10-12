<?php
function time_Ago($time) {


    $diff     = time() - $time;


    $sec     = $diff;


    $min     = round($diff / 60 );


    $hrs     = round($diff / 3600);


    $days     = round($diff / 86400 );


    $weeks     = round($diff / 604800);

    $mnths     = round($diff / 2600640 );


    $yrs     = round($diff / 31207680 );


    if($sec <= 30) {
        return "Just Now";
    }

    if($sec <= 60) {
        return "$sec Seconds Ago";
    }


    else if($min <= 60) {
        if($min==1) {
            return "One Minute Ago";
        }
        else {
            return "$min Minutes Ago";
        }
    }


    else if($hrs <= 24) {
        if($hrs == 1) {
            return "An Hour Ago";
        }
        else {
            return "$hrs Hours Ago";
        }
    }


    else if($days <= 7) {
        if($days == 1) {
            return "Yesterday";
        }
        else {
            return "$days Days Ago";
        }
    }


    else if($weeks <= 4.3) {
        if($weeks == 1) {
            return "A Week Ago";
        }
        else {
            return "$weeks Weeks Ago";
        }
    }

    else if($mnths <= 12) {
        if($mnths == 1) {
            return "A Month Ago";
        }
        else {
            return "$mnths Months Ago";
        }
    }

    else {
        if($yrs == 1) {
            return "One Year Ago";
        }
        else {
            return "$yrs Years Ago";
        }
    }
}
?>
