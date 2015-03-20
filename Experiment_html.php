<?php

session_start();
include "../../HTML/HTMLFunctions.php";
include "../../Common/CheckValue.php";
include "../../printall.php";
include "../../Common/DBFunctions.php";
include "index_common.php";
include "Experiment_Forms.php";
include "Experiment_Functions.php";
function Experiment_GetResultNameByExternalName( $externalname )
{
  switch ($externalname){
  case 'f1_2': return 'tExperimentName';
  case 'f1_8': return 't_f7_ExperimentatorName';
  default: return '';
  };// of switch
};
function Experiment_GetExternalNameByResultName( $externalname )
{
  switch ($externalname){
  case 'tExperimentName': return 'f1_2';
  case 't_f7_ExperimentatorName': return 'f1_8';
  default: return '';
  };// of switch
};
function resetExperimentOrder($widt)
{
  $_SESSION['widts'][$widt]['Experiment']['Order'] = array();
  $_SESSION['widts'][$widt]['Experiment']['Order']['OrderField'] = 'tExperimentID';
  $_SESSION['widts'][$widt]['Experiment']['Order']['OrderValue'] = '0';
  $_SESSION['widts'][$widt]['Experiment']['Order']['OrderID'] = '0';
  $_SESSION['widts'][$widt]['Experiment']['Order']['IsDesc'] = true;
};
function getExperimentLevelInfo($widt)
{
  if (!isset($_SESSION['widts'][$widt]['Experiment']['Order'])) {
    resetExperimentOrder($widt);
  };
  $OrderField = $_SESSION['widts'][$widt]['Experiment']['Order']['OrderField'];
  $Desc = ($_SESSION['widts'][$widt]['Experiment']['Order']['IsDesc'])?('desc'):('asc');
  $Items = array();
  $query = 'select t."ExperimentID" as "tExperimentID",t."ExperimentName" as "tExperimentName",t."IsDangeous" as "tIsDangeous",t."ShortComment" as "tShortComment",t."SecondComment" as "tSecondComment",t."ThirdComment" as "tThirdComment",t."FourthComment" as "tFourthComment",t_f7_."ExperimentatorID" as "t_f7_ExperimentatorID",t_f7_."ExperimentatorName" as "t_f7_ExperimentatorName" from "f_Exp_Experiment_Main" t
left join "f_Exp_Experimentator_Main" t_f7_
on t."MainExperimentatorID" = t_f7_."ExperimentatorID"
where 1 = 1
';  if (isset($_SESSION["widts"][$widt]["Experiment"]["SearchParam"])) {
              foreach ($_SESSION["widts"][$widt]["Experiment"]["SearchParam"] as $i => $param)
               $query .= " and t.\"$i\" = $param";
              };
 $OrderField = $_SESSION["widts"][$widt]["Experiment"]["Order"]["OrderField"];
  $query .= " order by \"$OrderField\"  $Desc";
  $result = ExecuteExperimentQuery($query) ;
  while ($line = pg_fetch_array($result, NULL, PGSQL_ASSOC)) 
    {
      $ExperimentID = $line['tExperimentID'];
      unset($line['tExperimentID']);
      $Items[$ExperimentID]['o'] = $line;
    };
writeLog(Printus($Items)); return $Items; 
};

function ClearFilialWindowData($widt) // Очистка данных по дочерним окнам после принятия данных по главному
{
  if (isset($_SESSION["widts"][$widt]["filial"]))// is_array круче, чем isset
  if (is_array($_SESSION["widts"][$widt]["filial"]))// is_array круче, чем isset
  {
     foreach ($_SESSION["widts"][$widt]["filial"] as $index=>$filial)
     {
        unset($_SESSION["widts"][$filial]);
        unset($_SESSION["widts"][$widt]["filial"][$index]);
     }
  };
};
$pid= (isset($_REQUEST['pid']))?($_REQUEST['pid']):(NULL);
$mode = (isset($_REQUEST['mode']))?($_REQUEST['mode']):("showlist");
$mode = (isset($_REQUEST['mode']))?($_REQUEST['mode']):("showlist");
$submode = (isset($_REQUEST['submode']))?($_REQUEST['submode']):("showlist");
$RequestedID = (isset($_REQUEST['RequestedID']))?($_REQUEST['RequestedID']):(NULL);
$modification = (isset($_REQUEST['modification']))?($_REQUEST['modification']):("");
$ParentItemID = (isset($_REQUEST['ParentItemID']))?($_REQUEST['ParentItemID']):(0);
$id = (isset($_REQUEST['ExperimentID']))?($_REQUEST['ExperimentID']):(0);
$number = (isset($_REQUEST['number']))?($_REQUEST['number']):(0);
$action = (isset($_REQUEST['action']))?($_REQUEST['action']):("");
$name  = (isset($_REQUEST['name']))?($_REQUEST['name']):("");
$SearchParam = (isset($_REQUEST['SearchParam']))?($_REQUEST['SearchParam']):(array());
if (isset($_REQUEST["SystemSettings"]["LanguageID"])) $_SESSION["SystemSettings"]["LanguageID"] = $_REQUEST["SystemSettings"]["LanguageID"];

$widtname = "widt";
if (isset($_REQUEST[$widtname]))
{
  $widt = $_REQUEST[$widtname];
}
else
{  
  if (!isset($_SESSION["widts"]))
  {
    $_SESSION["widts"] = array();
    $widt = 0;
    $_SESSION["maxwidt"] = 0;
  };
  $widt = ++$_SESSION["maxwidt"];
  $_SESSION["widts"][$widt] = array();
  if (isset($_REQUEST['pid'])){
    $pid = $_REQUEST['pid'];
    if (isset($_SESSION["widts"][$pid])){
      if (!isset($_SESSION["widts"][$pid]["filial"])){
        $_SESSION["widts"][$pid]["filial"] = array();
      };  
      $_SESSION["widts"][$pid]["filial"][]=$widt;
    };
  };

};
writeLog( Printus($_REQUEST));
writeLog( Printus($_SESSION));
$err = array();
$_SESSION['widts'][$widt]['ActionDone']  = (isset($_SESSION['widts'][$widt]['ActionDone'] ))?($_SESSION['widts'][$widt]['ActionDone'] ):('No');
// Обработка действия перед показом.
if ($_SESSION['widts'][$widt]['ActionDone']  <> 'Yes')
{
  if ( 'setExperiment'===$action )
  {
$requestdata = array();
$requestdata['ExperimentID'] = $_REQUEST['ExperimentID'];
$requestdata['ExperimentName'] = $_REQUEST['ExperimentName'];
$requestdata['IsDangeous'] = (isset($_REQUEST['IsDangeous']))?(1):(0);
$requestdata['ShortComment'] = $_REQUEST['ShortComment'];
$requestdata['SecondComment'] = $_REQUEST['SecondComment'];
$requestdata['ThirdComment'] = $_REQUEST['ThirdComment'];
$requestdata['FourthComment'] = $_REQUEST['FourthComment'];
$requestdata['MainExperimentatorID'] = $_REQUEST['MainExperimentatorID'];
     $err = checkExperimentValues($requestdata['ExperimentID'], $requestdata['ExperimentName'], $requestdata['IsDangeous'], $requestdata['ShortComment'], $requestdata['SecondComment'], $requestdata['ThirdComment'], $requestdata['FourthComment'], $requestdata['MainExperimentatorID']);
     if (count($err) === 0) 
       setExperiment($requestdata['ExperimentID'], $requestdata['ExperimentName'], $requestdata['IsDangeous'], $requestdata['ShortComment'], $requestdata['SecondComment'], $requestdata['ThirdComment'], $requestdata['FourthComment'], $requestdata['MainExperimentatorID']);
     else { 
     $mode = 'fixExperimentitem'; 
     }; 
  };
};
if (($mode == "showlist")&&(count($SearchParam)==1))
{
  $_SESSION["widts"][$widt]["Experiment"]['SearchParam'] = $SearchParam;
} else writeLog("NoSearchParamDetected");
$_SESSION['widts'][$widt]['ActionDone']  = 'Yes';
$Text = "";
$LanguageArray = array();
$selected = 0;if ($_SESSION["SystemSettings"]["LanguageID"]==1) $selected = 1;
$LanguageArray[1]=array("option"=>'Чăвашла', "selected"=>$selected);
$selected = 0;if ($_SESSION["SystemSettings"]["LanguageID"]==2) $selected = 1;
$LanguageArray[2]=array("option"=>'English', "selected"=>$selected);
$selected = 0;if ($_SESSION["SystemSettings"]["LanguageID"]==3) $selected = 1;
$LanguageArray[3]=array("option"=>'Deutsch', "selected"=>$selected);
$selected = 0;if ($_SESSION["SystemSettings"]["LanguageID"]==4) $selected = 1;
$LanguageArray[4]=array("option"=>'Русский язык', "selected"=>$selected);



if ($modification == 'Clear'.'Experiment'.'SearchParam'){ $_SESSION['widts'][$widt]['Experiment']['SearchParam'] = array(); 
$SearchParam = array(); resetExperimentOrder($widt); };
if ($modification == 'read'.'Experiment'.'forth'){ $_SESSION['widts'][$widt]['Experiment']['Order']['OrderValue'] = $_SESSION['widts'][$widt]['Experiment']['Order']['MaxValue']; $_SESSION['widts'][$widt]['Experiment']['Order']['OrderID'] = $_SESSION['widts'][$widt]['Experiment']['Order']['MaxID'];};
if ($modification == 'change'.'Experiment'.'sort'){ 
if (isset($_SESSION['widts'][$widt]['Experiment']['Order']['IsDesc'])) $desc = $_SESSION['widts'][$widt]['Experiment']['Order']['IsDesc'];
else $desc = true;
resetExperimentOrder($widt);
$_SESSION['widts'][$widt]['Experiment']['Order']['OrderField'] = Experiment_GetResultNameByExternalName($_REQUEST['sort']);;
$_SESSION['widts'][$widt]['Experiment']['Order']['IsDesc'] = !$desc;

; };
if (!SysCheck_ConnectionCorrectness()) { $Text = SysGenerateWrongConnectionWarning();} else { 
  if ($mode=='addExperimentitem') { $Text =  printExperimentEdit( 0, null, $widt);}
  else
  if ($mode=='editExperimentitem') {$Text =  printExperimentEdit( $id, null, $widt);}
  else
  if ($mode=='fixExperimentitem') {$Text =  printExperimentEdit( $id, $err, $widt);}
  else
  if ($mode=='historyExperimentitem') {$hist = getExperimentHistoryByID($id);

  $Text =  printExperimentList( $hist, 'history', null, $widt);}
  else
  if (($mode=='showlist')&&($submode=='showlist'))
  {
  ClearFilialWindowData($widt);
  $d = getExperimentLevelInfo($widt);
  $Text =  printExperimentList($d, 'showlist', NULL, $widt);
  }
  else if (($mode=='showlist')&&($submode=='showselectlist'))
  {
  $d = getExperimentLevelInfo($widt);
  $Text =  printExperimentList($d, $submode, $RequestedID, $widt);
  }
  else $Text =  "$mode не подходит";
  $Text = '<div style = \'width:100%\'><a href = \'index.php\'>System Main Menu</a></div>'.$Text;}; ///of CorrectConnection work 
$Body = $Text;
$Title = Get_Experiment_PluralCaption();
$Head = "";
$Head .= '<link rel="stylesheet" type="text/css" href="../../Javascript/style.css" >';
$Text =  PrintTransitional($Head, $Title, $Body);
print $Text;
?>
