<?php
function date_check_between($date_pre,$target_date,$date_post){
  if($target_date >= $date_pre && $target_date <= $date_post){
    return true;
  }else {
    return false;
  }
}
?>
