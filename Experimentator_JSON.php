<?php
session_start();
require_once "Experimentator_Functions.php";
require_once "../../Common/CheckValue.php";
require_once "../../Common/DBFunctions.php";
require_once "../../printall.php";
require_once "index_common.php";

if (!SysCheck_ConnectionCorrectness()) {print SysGenerateWrongConnectionWarning(); exit;};

Get_Experimentator_Connection();
$request = $_REQUEST["request"];
$id      = $_REQUEST["id"];

if ($id > 0) {
   if ($request === "json_linkedobjectcount") 
   {
      $counts =  Get_Experimentator_LinkedObjectCount($id);
      print json_encode($counts);
   };
if ($request == "json_linked_Experiment_by_MainExperimentatorID")
{
  $list = Experimentator_GetLinked_Experiment_By_MainExperimentatorID($id);
      print json_encode($list);
};if ($request == "json_linked_ExpParam_by_ExperimentatorID")
{
  $list = Experimentator_GetLinked_ExpParam_By_ExperimentatorID($id);
      print json_encode($list);
};
};

if ($request === "json_createobjectwithdata")
  {
    $data = $_REQUEST['data'];
    $arr  = json_decode($data, true);// true нужно, чтобы был массив, а не объект
   require_once "Experimentator_Class.php";
    $Experimentator = new Experimentator(0);
     if (isset($arr['ExperimentatorName'])) {
        $Experimentator->setExperimentatorName($arr["ExperimentatorName"]);
       };
    $Experimentator->DBSave();
   $list = array(); 
   $list["ExperimentatorID"]=$Experimentator->getExperimentatorID();
      print json_encode($list);

  };

?>