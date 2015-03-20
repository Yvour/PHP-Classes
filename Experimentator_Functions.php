<?php
function getExperimentatorByID( $ExperimentatorID )
{
  $query = 'select * from f_Exp_Experimentator_SelectByID('.$ExperimentatorID.'::bigint)';
  $result = ExecuteExperimentatorQuery( $query) or die("Query failed get more: " .$query. pg_last_error() );
  $line = pg_fetch_array($result, NULL, PGSQL_ASSOC) ;
  return $line;
};
function getExperimentatorHistoryByID($ExperimentatorID)
{
  $history = array();
  $query = 'select t."oExperimentatorID" as "otExperimentatorID",t."ActionTime",t."oExperimentatorName" as "otExperimentatorName",t."ActionTime" from "f_Exp_Experimentator_HistoryState" t
where 1 = 1
and t."oExperimentatorID" =
'.$ExperimentatorID.';';
  $result = ExecuteExperimentatorQuery( $query) or die("Query failed get more: " .$query. pg_last_error() );
   while( $line = pg_fetch_array($result, NULL, PGSQL_ASSOC)) { 
      $trueline = array(); $trueline['o'] = array(); $trueline['a'] = array();
      foreach ($line as $n => $v) if ($n[0] === 'o') $trueline['o'][substr($n, 1)]=$v; else $trueline['a'][$n]=$v;
      $history[] = $trueline;
   };
writeLog(Printus($history));  return $history;
};
function getExperimentators($widt)
{
  if (!isset($_SESSION['widts'][$widt]['Experimentator']['Order'])) {
    resetExperimentatorOrder($widt);
  };
  $OrderField = $_SESSION['widts'][$widt]['Experimentator']['Order']['OrderField'];
  $OrderValue = $_SESSION['widts'][$widt]['Experimentator']['Order']['OrderValue'];
  $OrderID = $_SESSION['widts'][$widt]['Experimentator']['Order']['OrderID'];
  $Items = array();
  $query = 'SELECT * FROM f_Exp_Experimentator_SelectList(); ';
 if ($OrderField === 'ExperimentatorID') {
    if ($OrderValue!=='') $OrderValueStr = (float)$OrderValue.'::bigint'; else $OrderValueStr = 'null'.'::bigint';
  $query = "SELECT * FROM f_Exp_Experimentator_SelectListFromExperimentatorID($OrderValueStr,$OrderID::bigint, 25::bigint); ";
};
 if ($OrderField === 'ExperimentatorName') {
    if ($OrderValue!='') $OrderValueStr = '\''.pg_escape_string($OrderValue).'\''.'::character varying(144)'; else $OrderValueStr = '\'\''.'::character varying(144)';
  $query = "SELECT * FROM f_Exp_Experimentator_SelectListFromExperimentatorName($OrderValueStr,$OrderID::bigint, 25::bigint); ";
};
if (isset($_SESSION['widts'][$widt]['Experimentator']['SearchParam']['ExperimentatorID']))      
{     
  $SearchID =  $_SESSION['widts'][$widt]['Experimentator']['SearchParam']['ExperimentatorID'];  
  $query = 'SELECT * FROM f_Exp_Experimentator_SelectByID('.$SearchID.'::bigint); ';
     
}     
  $result = ExecuteExperimentatorQuery($query) ;
  while ($line = pg_fetch_array($result, NULL, PGSQL_ASSOC)) 
    {
      $ExperimentatorID = $line['ExperimentatorID'];
      $_SESSION['widts'][$widt]['Experimentator']['Order']['MaxValue'] = $line[$OrderField];
      unset($line['ExperimentatorID']);
      $Items[$ExperimentatorID]['o'] = $line;
      $_SESSION['widts'][$widt]['Experimentator']['Order']['MaxID'] = $ExperimentatorID;
    };
return $Items;
};
function insertExperimentator($ExperimentatorName)
{
  $connection = $_SESSION['connection'];
  $result = ExecuteExperimentatorQuery("select '.f_Exp_Experimentator.'_Insert('".pg_escape_string($ExperimentatorName)."'::character varying(144))");// конец транзакции
  return $result;
};
function setExperimentator( $ExperimentatorID, $ExperimentatorName)
{
  if ($ExperimentatorID == 0)
  {
  $result = ExecuteExperimentatorQuery( "select f_Exp_Experimentator_Insert('".pg_escape_string($ExperimentatorName)."'::character varying(144))");// конец транзакции
  }
  else
  {
     ExecuteExperimentatorQuery( "select f_Exp_Experimentator_Update($ExperimentatorID::bigint,"."'".pg_escape_string($ExperimentatorName)."'::character varying(144))");

  } 
  return 0;
};
function Get_Experimentator_LinkedObjectCount($id)
{;
$count = array();
$query = 'select count(*) as counter from "f_Exp_Experiment_Main" where "MainExperimentatorID" = '.$id.';';    $result = ExecuteExperimentatorQuery( $query) ;//or die("Query failed get more: " . pg_error());
    $line = pg_fetch_array($result, NULL, PGSQL_ASSOC) ;
    $count["Experiment_MainExperimentatorID"] = $line["counter"];
$query = 'select count(*) as counter from "f_Exp_ExpParam_Main" where "ExperimentatorID" = '.$id.';';    $result = ExecuteExperimentatorQuery( $query) ;//or die("Query failed get more: " . pg_error());
    $line = pg_fetch_array($result, NULL, PGSQL_ASSOC) ;
    $count["ExpParam_ExperimentatorID"] = $line["counter"];
return $count;};





function Experimentator_GetLinked_Experiment_By_MainExperimentatorID($id)
{;
$list = array();
$query = 'select count(*) as counter from "f_Exp_Experiment_Main" where "MainExperimentatorID" = '.$id.';';    $result = ExecuteExperimentatorQuery( $query) ;//or die("Query failed get more: " . pg_error());
    $line = pg_fetch_array($result, NULL, PGSQL_ASSOC) ;
    if ($line["counter"]<100) { //technical limit
      $query = 'select "ExperimentID", "ExperimentName"';
      $query .= ' from  "f_Exp_Experiment_Main"';
      $query .= ' where  "MainExperimentatorID" = '.$id.';';
      $result = ExecuteExperimentatorQuery( $query) ;//or die("Query failed get more: " . pg_error());
      while ($line = pg_fetch_array($result, NULL, PGSQL_ASSOC)) {
         $list[]=$line;
    };// of while
  };
return $list;};



function Experimentator_GetLinked_ExpParam_By_ExperimentatorID($id)
{;
$list = array();
$query = 'select count(*) as counter from "f_Exp_ExpParam_Main" where "ExperimentatorID" = '.$id.';';    $result = ExecuteExperimentatorQuery( $query) ;//or die("Query failed get more: " . pg_error());
    $line = pg_fetch_array($result, NULL, PGSQL_ASSOC) ;
    if ($line["counter"]<100) { //technical limit
      $query = 'select "ExpParamID", ""';
      $query .= ' from  "f_Exp_ExpParam_Main"';
      $query .= ' where  "ExperimentatorID" = '.$id.';';
      $result = ExecuteExperimentatorQuery( $query) ;//or die("Query failed get more: " . pg_error());
      while ($line = pg_fetch_array($result, NULL, PGSQL_ASSOC)) {
         $list[]=$line;
    };// of while
  };
return $list;};

function Check_Experimentator_ConnectionCorrectness(){
if ($_SERVER["REMOTE_ADDR"] === "127.0.0.1") {
 $CorrectConnection = true; } else $CorrectConnection = false;
return $CorrectConnection;}
Get_Experimentator_Connection();

function Get_Experimentator_Connection() {
if (!Check_Experimentator_ConnectionCorrectness()) return false;

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
  $_SESSION["connections"]["Objects"]["Experimentator"] = $connection; // Для одного Объекта БД всегда одна и та же.
  if (!$connection)
  {
  die("Не удалось соединиться с базой данных");
  }else
  {
  //print "Connection successful";
  };
  return $connection;
};


function ExecuteExperimentatorQuery($query){
  $connection = $_SESSION["connections"]["Objects"]["Experimentator"];
  return ExecuteQuery($query, $connection);
};function checkExperimentatorValues( $ExperimentatorID, $ExperimentatorName)
{
$checked = true;
$errors = array();
$error = CheckValue(null, $ExperimentatorID, 'bigint');
if ($error !== '') $checked = false;
$errors['ExperimentatorID']= array('name' => 'ExperimentatorID','value' => $ExperimentatorID, 'type' => 'bigint', 'error' => $error);
$error = CheckValue(null, $ExperimentatorName, 'character varying(144)');
if ($error !== '') $checked = false;
$errors['ExperimentatorName']= array('name' => 'ExperimentatorName','value' => $ExperimentatorName, 'type' => 'character varying(144)', 'error' => $error);
writeLog(Printus($errors));
if ($checked == true) return array(); else return $errors;
}

require_once "Experimentator_FieldCaptions.php";

?>
