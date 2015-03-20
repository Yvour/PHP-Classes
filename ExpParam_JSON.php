<?php
session_start();
require_once "ExpParam_Functions.php";
require_once "../../Common/CheckValue.php";
require_once "../../Common/DBFunctions.php";
require_once "../../printall.php";
require_once "index_common.php";

if (!SysCheck_ConnectionCorrectness()) {print SysGenerateWrongConnectionWarning(); exit;};

Get_ExpParam_Connection();
$request = $_REQUEST["request"];
$id      = $_REQUEST["id"];

if ($id > 0) {
   if ($request === "json_linkedobjectcount") 
   {
      $counts =  Get_ExpParam_LinkedObjectCount($id);
      print json_encode($counts);
   };

};

if ($request === "json_createobjectwithdata")
  {
    $data = $_REQUEST['data'];
    $arr  = json_decode($data, true);// true нужно, чтобы был массив, а не объект
   require_once "ExpParam_Class.php";
    $ExpParam = new ExpParam(0);
     if (isset($arr['ExpParamName'])) {
        $ExpParam->setExpParamName($arr["ExpParamName"]);
       };
      if (isset($arr['ExpParamValue'])) {
        $ExpParam->setExpParamValue($arr["ExpParamValue"]);
       };
      if (isset($arr['ExperimentatorID'])) {
        $ExpParam->setExperimentatorID($arr["ExperimentatorID"]);
       };
    $ExpParam->DBSave();
   $list = array(); 
   $list["ExpParamID"]=$ExpParam->getExpParamID();
      print json_encode($list);

  };

?>