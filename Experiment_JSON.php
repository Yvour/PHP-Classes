<?php
session_start();
require_once "Experiment_Functions.php";
require_once "../../Common/CheckValue.php";
require_once "../../Common/DBFunctions.php";
require_once "../../printall.php";
require_once "index_common.php";

if (!SysCheck_ConnectionCorrectness()) {print SysGenerateWrongConnectionWarning(); exit;};

Get_Experiment_Connection();
$request = $_REQUEST["request"];
$id      = $_REQUEST["id"];

if ($id > 0) {
   if ($request === "json_linkedobjectcount") 
   {
      $counts =  Get_Experiment_LinkedObjectCount($id);
      print json_encode($counts);
   };

};

if ($request === "json_createobjectwithdata")
  {
    $data = $_REQUEST['data'];
    $arr  = json_decode($data, true);// true нужно, чтобы был массив, а не объект
   require_once "Experiment_Class.php";
    $Experiment = new Experiment(0);
     if (isset($arr['ExperimentName'])) {
        $Experiment->setExperimentName($arr["ExperimentName"]);
       };
      if (isset($arr['IsDangeous'])) {
        $Experiment->setIsDangeous($arr["IsDangeous"]);
       };
      if (isset($arr['ShortComment'])) {
        $Experiment->setShortComment($arr["ShortComment"]);
       };
      if (isset($arr['SecondComment'])) {
        $Experiment->setSecondComment($arr["SecondComment"]);
       };
      if (isset($arr['ThirdComment'])) {
        $Experiment->setThirdComment($arr["ThirdComment"]);
       };
      if (isset($arr['FourthComment'])) {
        $Experiment->setFourthComment($arr["FourthComment"]);
       };
      if (isset($arr['MainExperimentatorID'])) {
        $Experiment->setMainExperimentatorID($arr["MainExperimentatorID"]);
       };
    $Experiment->DBSave();
   $list = array(); 
   $list["ExperimentID"]=$Experiment->getExperimentID();
      print json_encode($list);

  };

?>