<?php
 function SysCheck_ConnectionCorrectness(){
if ($_SERVER["REMOTE_ADDR"] === "127.0.0.1") {
 $CorrectConnection = true; } else $CorrectConnection = false;
return $CorrectConnection;}

  function SysGenerateWrongConnectionWarning(){
  
  return "<div style = \"border:2px solid blue\">You have wrong connection, Sir</div>";
  
  } 
?>