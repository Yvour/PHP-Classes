<?php
function getExperimentByID( $ExperimentID )
{
  $query = 'select * from f_Exp_Experiment_SelectByID('.$ExperimentID.'::bigint)';
  $result = ExecuteExperimentQuery( $query) or die("Query failed get more: " .$query. pg_last_error() );
  $line = pg_fetch_array($result, NULL, PGSQL_ASSOC) ;
  return $line;
};
function getExperimentHistoryByID($ExperimentID)
{
  $history = array();
  $query = 'select t."oExperimentID" as "otExperimentID",t."ActionTime",t."oExperimentName" as "otExperimentName",t."ActionTime",t."oIsDangeous" as "otIsDangeous",t."ActionTime",t."oShortComment" as "otShortComment",t."ActionTime",t."oSecondComment" as "otSecondComment",t."ActionTime",t."oThirdComment" as "otThirdComment",t."ActionTime",t."oFourthComment" as "otFourthComment",t."ActionTime",t_f7_."oExperimentatorID" as "ot_f7_ExperimentatorID",t."ActionTime",t_f7_."oExperimentatorName" as "ot_f7_ExperimentatorName",t."ActionTime" from "f_Exp_Experiment_HistoryState" t
left join "f_Exp_Experimentator_HistoryState" t_f7_
on t."oMainExperimentatorID" = t_f7_."ExperimentatorHistoryStateID"
where 1 = 1
and t."oExperimentID" =
'.$ExperimentID.';';
  $result = ExecuteExperimentQuery( $query) or die("Query failed get more: " .$query. pg_last_error() );
   while( $line = pg_fetch_array($result, NULL, PGSQL_ASSOC)) { 
      $trueline = array(); $trueline['o'] = array(); $trueline['a'] = array();
      foreach ($line as $n => $v) if ($n[0] === 'o') $trueline['o'][substr($n, 1)]=$v; else $trueline['a'][$n]=$v;
      $history[] = $trueline;
   };
writeLog(Printus($history));  return $history;
};
function getExperiments($widt)
{
  if (!isset($_SESSION['widts'][$widt]['Experiment']['Order'])) {
    resetExperimentOrder($widt);
  };
  $OrderField = $_SESSION['widts'][$widt]['Experiment']['Order']['OrderField'];
  $OrderValue = $_SESSION['widts'][$widt]['Experiment']['Order']['OrderValue'];
  $OrderID = $_SESSION['widts'][$widt]['Experiment']['Order']['OrderID'];
  $Items = array();
  $query = 'SELECT * FROM f_Exp_Experiment_SelectList(); ';
 if ($OrderField === 'ExperimentID') {
    if ($OrderValue!=='') $OrderValueStr = (float)$OrderValue.'::bigint'; else $OrderValueStr = 'null'.'::bigint';
  $query = "SELECT * FROM f_Exp_Experiment_SelectListFromExperimentID($OrderValueStr,$OrderID::bigint, 25::bigint); ";
};
 if ($OrderField === 'ExperimentName') {
    if ($OrderValue!='') $OrderValueStr = '\''.pg_escape_string($OrderValue).'\''.'::character varying(36)'; else $OrderValueStr = '\'\''.'::character varying(36)';
  $query = "SELECT * FROM f_Exp_Experiment_SelectListFromExperimentName($OrderValueStr,$OrderID::bigint, 25::bigint); ";
};
 if ($OrderField === 'IsDangeous') {
  $query = "SELECT * FROM f_Exp_Experiment_SelectListFromIsDangeous($OrderValueStr,$OrderID::bigint, 25::bigint); ";
};
 if ($OrderField === 'ShortComment') {
    if ($OrderValue!='') $OrderValueStr = '\''.pg_escape_string($OrderValue).'\''.'::character varying(144)'; else $OrderValueStr = '\'\''.'::character varying(144)';
  $query = "SELECT * FROM f_Exp_Experiment_SelectListFromShortComment($OrderValueStr,$OrderID::bigint, 25::bigint); ";
};
 if ($OrderField === 'SecondComment') {
    if ($OrderValue!='') $OrderValueStr = '\''.pg_escape_string($OrderValue).'\''.'::character varying(144)'; else $OrderValueStr = '\'\''.'::character varying(144)';
  $query = "SELECT * FROM f_Exp_Experiment_SelectListFromSecondComment($OrderValueStr,$OrderID::bigint, 25::bigint); ";
};
 if ($OrderField === 'ThirdComment') {
    if ($OrderValue!='') $OrderValueStr = '\''.pg_escape_string($OrderValue).'\''.'::character varying'; else $OrderValueStr = '\'\''.'::character varying';
  $query = "SELECT * FROM f_Exp_Experiment_SelectListFromThirdComment($OrderValueStr,$OrderID::bigint, 25::bigint); ";
};
 if ($OrderField === 'FourthComment') {
    if ($OrderValue!='') $OrderValueStr = '\''.pg_escape_string($OrderValue).'\''.'::character varying(144)'; else $OrderValueStr = '\'\''.'::character varying(144)';
  $query = "SELECT * FROM f_Exp_Experiment_SelectListFromFourthComment($OrderValueStr,$OrderID::bigint, 25::bigint); ";
};
 if ($OrderField === 'MainExperimentatorID') {
    if ($OrderValue!=='') $OrderValueStr = (float)$OrderValue.'::bigint'; else $OrderValueStr = 'null'.'::bigint';
  $query = "SELECT * FROM f_Exp_Experiment_SelectListFromMainExperimentatorID($OrderValueStr,$OrderID::bigint, 25::bigint); ";
};
if (isset($_SESSION['widts'][$widt]['Experiment']['SearchParam']['ExperimentID']))      
{     
  $SearchID =  $_SESSION['widts'][$widt]['Experiment']['SearchParam']['ExperimentID'];  
  $query = 'SELECT * FROM f_Exp_Experiment_SelectByID('.$SearchID.'::bigint); ';
     
}     
if (isset($_SESSION['widts'][$widt]['Experiment']['SearchParam']['MainExperimentatorID']))      
{     
  $SearchID =  $_SESSION['widts'][$widt]['Experiment']['SearchParam']['MainExperimentatorID'];  
  $query = 'SELECT * FROM f_Exp_Experiment_SelectListByMainExperimentatorID('.$SearchID.'::bigint); ';
     
}     
$_SESSION['Experiment']['Cache']['Experimentator'] = array();
  $result = ExecuteExperimentQuery($query) ;
  while ($line = pg_fetch_array($result, NULL, PGSQL_ASSOC)) 
    {
      $ExperimentID = $line['ExperimentID'];
      $_SESSION['widts'][$widt]['Experiment']['Order']['MaxValue'] = $line[$OrderField];
      unset($line['ExperimentID']);
      $Items[$ExperimentID]['o'] = $line;
  $SearchID =  $line['MainExperimentatorID'];  
  if ($SearchID > 0) 
  {  
    if (!isset($_SESSION['Experiment']['Cache']['Experimentator'][$SearchID]));
    {  
      $query1 = 'SELECT * FROM f_Exp_Experimentator_SelectByID('.$SearchID.'::bigint); ';
      $result1 = ExecuteExperimentQuery( $query1);
      $line1 = pg_fetch_array($result1, NULL, PGSQL_ASSOC);
      unset($line1['ExperimentatorID']);
      $Value = implode('|', $line1);
      $_SESSION['Experiment']['Cache']['Experimentator'][$SearchID]['info']=array();
      foreach ($line1 as $key1 => $value1){
      $_SESSION['Experiment']['Cache']['Experimentator'][$SearchID]['info'][$key1]=$value1;
      };
      $_SESSION['Experiment']['Cache']['Experimentator'][$SearchID]['implode']=$Value;
   };  
 };  
      $_SESSION['widts'][$widt]['Experiment']['Order']['MaxID'] = $ExperimentID;
    };
return $Items;
};
function insertExperiment($ExperimentName, $IsDangeous, $ShortComment, $SecondComment, $ThirdComment, $FourthComment, $MainExperimentatorID)
{
  $connection = $_SESSION['connection'];
  $result = ExecuteExperimentQuery("select '.f_Exp_Experiment.'_Insert('".pg_escape_string($ExperimentName)."'::character varying(36), '".pg_escape_string($IsDangeous)."'::boolean, '".pg_escape_string($ShortComment)."'::character varying(144), '".pg_escape_string($SecondComment)."'::character varying(144), '".pg_escape_string($ThirdComment)."'::character varying, '".pg_escape_string($FourthComment)."'::character varying(144), ".pg_escape_string($MainExperimentatorID)."::bigint)");// конец транзакции
  return $result;
};
function setExperiment( $ExperimentID, $ExperimentName, $IsDangeous, $ShortComment, $SecondComment, $ThirdComment, $FourthComment, $MainExperimentatorID)
{
  if ($ExperimentID == 0)
  {
  $result = ExecuteExperimentQuery( "select f_Exp_Experiment_Insert('".pg_escape_string($ExperimentName)."'::character varying(36), '".pg_escape_string($IsDangeous)."'::boolean, '".pg_escape_string($ShortComment)."'::character varying(144), '".pg_escape_string($SecondComment)."'::character varying(144), '".pg_escape_string($ThirdComment)."'::character varying, '".pg_escape_string($FourthComment)."'::character varying(144), ".pg_escape_string($MainExperimentatorID)."::bigint)");// конец транзакции
  }
  else
  {
     ExecuteExperimentQuery( "select f_Exp_Experiment_Update($ExperimentID::bigint,"."'".pg_escape_string($ExperimentName)."'::character varying(36), '".pg_escape_string($IsDangeous)."'::boolean, '".pg_escape_string($ShortComment)."'::character varying(144), '".pg_escape_string($SecondComment)."'::character varying(144), '".pg_escape_string($ThirdComment)."'::character varying, '".pg_escape_string($FourthComment)."'::character varying(144), ".pg_escape_string($MainExperimentatorID)."::bigint)");

  } 
  return 0;
};
function Get_Experiment_LinkedObjectCount($id)
{;
$count = array();
return $count;};



function Check_Experiment_ConnectionCorrectness(){
if ($_SERVER["REMOTE_ADDR"] === "127.0.0.1") {
 $CorrectConnection = true; } else $CorrectConnection = false;
return $CorrectConnection;}
Get_Experiment_Connection();

function Get_Experiment_Connection() {
if (!Check_Experiment_ConnectionCorrectness()) return false;

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
  $_SESSION["connections"]["Objects"]["Experiment"] = $connection; // Для одного Объекта БД всегда одна и та же.
  if (!$connection)
  {
  die("Не удалось соединиться с базой данных");
  }else
  {
  //print "Connection successful";
  };
  return $connection;
};


function ExecuteExperimentQuery($query){
  $connection = $_SESSION["connections"]["Objects"]["Experiment"];
  return ExecuteQuery($query, $connection);
};function checkExperimentValues( $ExperimentID, $ExperimentName, $IsDangeous, $ShortComment, $SecondComment, $ThirdComment, $FourthComment, $MainExperimentatorID)
{
$checked = true;
$errors = array();
$error = CheckValue(null, $ExperimentID, 'bigint');
if ($error !== '') $checked = false;
$errors['ExperimentID']= array('name' => 'ExperimentID','value' => $ExperimentID, 'type' => 'bigint', 'error' => $error);
$error = CheckValue(null, $ExperimentName, 'character varying(36)');
if ($error !== '') $checked = false;
$errors['ExperimentName']= array('name' => 'ExperimentName','value' => $ExperimentName, 'type' => 'character varying(36)', 'error' => $error);
$error = CheckValue(null, $IsDangeous, 'boolean');
if ($error !== '') $checked = false;
$errors['IsDangeous']= array('name' => 'IsDangeous','value' => $IsDangeous, 'type' => 'boolean', 'error' => $error);
$error = CheckValue(null, $ShortComment, 'character varying(144)');
if ($error !== '') $checked = false;
$errors['ShortComment']= array('name' => 'ShortComment','value' => $ShortComment, 'type' => 'character varying(144)', 'error' => $error);
$error = CheckValue(null, $SecondComment, 'character varying(144)');
if ($error !== '') $checked = false;
$errors['SecondComment']= array('name' => 'SecondComment','value' => $SecondComment, 'type' => 'character varying(144)', 'error' => $error);
$error = CheckValue(null, $ThirdComment, 'character varying');
if ($error !== '') $checked = false;
$errors['ThirdComment']= array('name' => 'ThirdComment','value' => $ThirdComment, 'type' => 'character varying', 'error' => $error);
$error = CheckValue(null, $FourthComment, 'character varying(144)');
if ($error !== '') $checked = false;
$errors['FourthComment']= array('name' => 'FourthComment','value' => $FourthComment, 'type' => 'character varying(144)', 'error' => $error);
$error = CheckValue(null, $MainExperimentatorID, 'bigint');
if ($error !== '') $checked = false;
$errors['MainExperimentatorID']= array('name' => 'MainExperimentatorID','value' => $MainExperimentatorID, 'type' => 'bigint', 'error' => $error);
writeLog(Printus($errors));
if ($checked == true) return array(); else return $errors;
}

require_once "Experimentator_FieldCaptions.php";

require_once "Experiment_FieldCaptions.php";

?>
