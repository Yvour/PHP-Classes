<?php
function getExpParamByID( $ExpParamID )
{
  $query = 'select * from f_Exp_ExpParam_SelectByID('.$ExpParamID.'::bigint)';
  $result = ExecuteExpParamQuery( $query) or die("Query failed get more: " .$query. pg_last_error() );
  $line = pg_fetch_array($result, NULL, PGSQL_ASSOC) ;
  return $line;
};
function getExpParamHistoryByID($ExpParamID)
{
  $history = array();
  $query = 'select t."oExpParamID" as "otExpParamID",t."ActionTime",t."oExpParamName" as "otExpParamName",t."ActionTime",t."oExpParamValue" as "otExpParamValue",t."ActionTime",t_f3_."oExperimentatorID" as "ot_f3_ExperimentatorID",t."ActionTime",t_f3_."oExperimentatorName" as "ot_f3_ExperimentatorName",t."ActionTime" from "f_Exp_ExpParam_HistoryState" t
left join "f_Exp_Experimentator_HistoryState" t_f3_
on t."oExperimentatorID" = t_f3_."ExperimentatorHistoryStateID"
where 1 = 1
and t."oExpParamID" =
'.$ExpParamID.';';
  $result = ExecuteExpParamQuery( $query) or die("Query failed get more: " .$query. pg_last_error() );
   while( $line = pg_fetch_array($result, NULL, PGSQL_ASSOC)) { 
      $trueline = array(); $trueline['o'] = array(); $trueline['a'] = array();
      foreach ($line as $n => $v) if ($n[0] === 'o') $trueline['o'][substr($n, 1)]=$v; else $trueline['a'][$n]=$v;
      $history[] = $trueline;
   };
writeLog(Printus($history));  return $history;
};
function getExpParams($widt)
{
  if (!isset($_SESSION['widts'][$widt]['ExpParam']['Order'])) {
    resetExpParamOrder($widt);
  };
  $OrderField = $_SESSION['widts'][$widt]['ExpParam']['Order']['OrderField'];
  $OrderValue = $_SESSION['widts'][$widt]['ExpParam']['Order']['OrderValue'];
  $OrderID = $_SESSION['widts'][$widt]['ExpParam']['Order']['OrderID'];
  $Items = array();
  $query = 'SELECT * FROM f_Exp_ExpParam_SelectList(); ';
 if ($OrderField === 'ExpParamID') {
    if ($OrderValue!=='') $OrderValueStr = (float)$OrderValue.'::bigint'; else $OrderValueStr = 'null'.'::bigint';
  $query = "SELECT * FROM f_Exp_ExpParam_SelectListFromExpParamID($OrderValueStr,$OrderID::bigint, 25::bigint); ";
};
 if ($OrderField === 'ExpParamName') {
    if ($OrderValue!='') $OrderValueStr = '\''.pg_escape_string($OrderValue).'\''.'::character varying(36)'; else $OrderValueStr = '\'\''.'::character varying(36)';
  $query = "SELECT * FROM f_Exp_ExpParam_SelectListFromExpParamName($OrderValueStr,$OrderID::bigint, 25::bigint); ";
};
 if ($OrderField === 'ExpParamValue') {
    if ($OrderValue!=='') $OrderValueStr = (float)$OrderValue.'::bigint'; else $OrderValueStr = 'null'.'::bigint';
  $query = "SELECT * FROM f_Exp_ExpParam_SelectListFromExpParamValue($OrderValueStr,$OrderID::bigint, 25::bigint); ";
};
 if ($OrderField === 'ExperimentatorID') {
    if ($OrderValue!=='') $OrderValueStr = (float)$OrderValue.'::bigint'; else $OrderValueStr = 'null'.'::bigint';
  $query = "SELECT * FROM f_Exp_ExpParam_SelectListFromExperimentatorID($OrderValueStr,$OrderID::bigint, 25::bigint); ";
};
if (isset($_SESSION['widts'][$widt]['ExpParam']['SearchParam']['ExpParamID']))      
{     
  $SearchID =  $_SESSION['widts'][$widt]['ExpParam']['SearchParam']['ExpParamID'];  
  $query = 'SELECT * FROM f_Exp_ExpParam_SelectByID('.$SearchID.'::bigint); ';
     
}     
if (isset($_SESSION['widts'][$widt]['ExpParam']['SearchParam']['ExperimentatorID']))      
{     
  $SearchID =  $_SESSION['widts'][$widt]['ExpParam']['SearchParam']['ExperimentatorID'];  
  $query = 'SELECT * FROM f_Exp_ExpParam_SelectListByExperimentatorID('.$SearchID.'::bigint); ';
     
}     
$_SESSION['ExpParam']['Cache']['Experimentator'] = array();
  $result = ExecuteExpParamQuery($query) ;
  while ($line = pg_fetch_array($result, NULL, PGSQL_ASSOC)) 
    {
      $ExpParamID = $line['ExpParamID'];
      $_SESSION['widts'][$widt]['ExpParam']['Order']['MaxValue'] = $line[$OrderField];
      unset($line['ExpParamID']);
      $Items[$ExpParamID]['o'] = $line;
  $SearchID =  $line['ExperimentatorID'];  
  if ($SearchID > 0) 
  {  
    if (!isset($_SESSION['ExpParam']['Cache']['Experimentator'][$SearchID]));
    {  
      $query1 = 'SELECT * FROM f_Exp_Experimentator_SelectByID('.$SearchID.'::bigint); ';
      $result1 = ExecuteExpParamQuery( $query1);
      $line1 = pg_fetch_array($result1, NULL, PGSQL_ASSOC);
      unset($line1['ExperimentatorID']);
      $Value = implode('|', $line1);
      $_SESSION['ExpParam']['Cache']['Experimentator'][$SearchID]['info']=array();
      foreach ($line1 as $key1 => $value1){
      $_SESSION['ExpParam']['Cache']['Experimentator'][$SearchID]['info'][$key1]=$value1;
      };
      $_SESSION['ExpParam']['Cache']['Experimentator'][$SearchID]['implode']=$Value;
   };  
 };  
      $_SESSION['widts'][$widt]['ExpParam']['Order']['MaxID'] = $ExpParamID;
    };
return $Items;
};
function insertExpParam($ExpParamName, $ExpParamValue, $ExperimentatorID)
{
  $connection = $_SESSION['connection'];
  $result = ExecuteExpParamQuery("select '.f_Exp_ExpParam.'_Insert('".pg_escape_string($ExpParamName)."'::character varying(36), ".pg_escape_string($ExpParamValue)."::bigint, ".pg_escape_string($ExperimentatorID)."::bigint)");// конец транзакции
  return $result;
};
function setExpParam( $ExpParamID, $ExpParamName, $ExpParamValue, $ExperimentatorID)
{
  if ($ExpParamID == 0)
  {
  $result = ExecuteExpParamQuery( "select f_Exp_ExpParam_Insert('".pg_escape_string($ExpParamName)."'::character varying(36), ".pg_escape_string($ExpParamValue)."::bigint, ".pg_escape_string($ExperimentatorID)."::bigint)");// конец транзакции
  }
  else
  {
     ExecuteExpParamQuery( "select f_Exp_ExpParam_Update($ExpParamID::bigint,"."'".pg_escape_string($ExpParamName)."'::character varying(36), ".pg_escape_string($ExpParamValue)."::bigint, ".pg_escape_string($ExperimentatorID)."::bigint)");

  } 
  return 0;
};
function Get_ExpParam_LinkedObjectCount($id)
{;
$count = array();
return $count;};



function Check_ExpParam_ConnectionCorrectness(){
if ($_SERVER["REMOTE_ADDR"] === "127.0.0.1") {
 $CorrectConnection = true; } else $CorrectConnection = false;
return $CorrectConnection;}
Get_ExpParam_Connection();

function Get_ExpParam_Connection() {
if (!Check_ExpParam_ConnectionCorrectness()) return false;

$host = 'localhost';
  $user = 'financist';
  $pass = 'd@llar';
  $db   = 'experiment';
  $port = '5432';

  $connection = pg_connect ("host=$host port=$port dbname=$db user=$user password=$pass") or $connection = false;
  while (!$connection){
  print "z";
    $connection = pg_connect ("host=$host port=$port dbname=$db user=$user password=$pass") or $connection = false;
  };  
  $_SESSION["connections"]["Objects"]["ExpParam"] = $connection; // Для одного Объекта БД всегда одна и та же.
  if (!$connection)
  {
  die("Не удалось соединиться с базой данных");
  }else
  {
  //print "Connection successful";
  };
  return $connection;
};


function ExecuteExpParamQuery($query){
  $connection = $_SESSION["connections"]["Objects"]["ExpParam"];
  return ExecuteQuery($query, $connection);
};function checkExpParamValues( $ExpParamID, $ExpParamName, $ExpParamValue, $ExperimentatorID)
{
$checked = true;
$errors = array();
$error = CheckValue(null, $ExpParamID, 'bigint');
if ($error !== '') $checked = false;
$errors['ExpParamID']= array('name' => 'ExpParamID','value' => $ExpParamID, 'type' => 'bigint', 'error' => $error);
$error = CheckValue(null, $ExpParamName, 'character varying(36)');
if ($error !== '') $checked = false;
$errors['ExpParamName']= array('name' => 'ExpParamName','value' => $ExpParamName, 'type' => 'character varying(36)', 'error' => $error);
$error = CheckValue(null, $ExpParamValue, 'bigint');
if ($error !== '') $checked = false;
$errors['ExpParamValue']= array('name' => 'ExpParamValue','value' => $ExpParamValue, 'type' => 'bigint', 'error' => $error);
$error = CheckValue(null, $ExperimentatorID, 'bigint');
if ($error !== '') $checked = false;
$errors['ExperimentatorID']= array('name' => 'ExperimentatorID','value' => $ExperimentatorID, 'type' => 'bigint', 'error' => $error);
writeLog(Printus($errors));
if ($checked == true) return array(); else return $errors;
}

require_once "Experimentator_FieldCaptions.php";

require_once "ExpParam_FieldCaptions.php";

?>
