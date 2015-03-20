<?php

session_start();
include "../../HTML/HTMLFunctions.php";
include "../../Common/CheckValue.php";
include "../../printall.php";
include "../../Common/DBFunctions.php";
include "index_common.php";
include "Experimentator_Forms.php";
include "Experimentator_Functions.php";
function Experimentator_GetResultNameByExternalName( $externalname )
{
  switch ($externalname){
  case 'f1_2': return 'tExperimentatorName';
  default: return '';
  };// of switch
};
function Experimentator_GetExternalNameByResultName( $externalname )
{
  switch ($externalname){
  case 'tExperimentatorName': return 'f1_2';
  default: return '';
  };// of switch
};
function resetExperimentatorOrder($widt)
{
  $_SESSION['widts'][$widt]['Experimentator']['Order'] = array();
  $_SESSION['widts'][$widt]['Experimentator']['Order']['OrderField'] = 'tExperimentatorID';
  $_SESSION['widts'][$widt]['Experimentator']['Order']['OrderValue'] = '0';
  $_SESSION['widts'][$widt]['Experimentator']['Order']['OrderID'] = '0';
  $_SESSION['widts'][$widt]['Experimentator']['Order']['IsDesc'] = true;
};
function getExperimentatorLevelInfo($widt)
{
  if (!isset($_SESSION['widts'][$widt]['Experimentator']['Order'])) {
    resetExperimentatorOrder($widt);
  };
  $OrderField = $_SESSION['widts'][$widt]['Experimentator']['Order']['OrderField'];
  $Desc = ($_SESSION['widts'][$widt]['Experimentator']['Order']['IsDesc'])?('desc'):('asc');
  $Items = array();
  $query = 'select t."ExperimentatorID" as "tExperimentatorID",t."ExperimentatorName" as "tExperimentatorName" from "f_Exp_Experimentator_Main" t
where 1 = 1
';  if (isset($_SESSION["widts"][$widt]["Experimentator"]["SearchParam"])) {
              foreach ($_SESSION["widts"][$widt]["Experimentator"]["SearchParam"] as $i => $param)
               $query .= " and t.\"$i\" = $param";
              };
 $OrderField = $_SESSION["widts"][$widt]["Experimentator"]["Order"]["OrderField"];
  $query .= " order by \"$OrderField\"  $Desc";
  $result = ExecuteExperimentatorQuery($query) ;
  while ($line = pg_fetch_array($result, NULL, PGSQL_ASSOC)) 
    {
      $ExperimentatorID = $line['tExperimentatorID'];
      unset($line['tExperimentatorID']);
      $Items[$ExperimentatorID]['o'] = $line;
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
$id = (isset($_REQUEST['ExperimentatorID']))?($_REQUEST['ExperimentatorID']):(0);
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
  if ( 'setExperimentator'===$action )
  {
$requestdata = array();
$requestdata['ExperimentatorID'] = $_REQUEST['ExperimentatorID'];
$requestdata['ExperimentatorName'] = $_REQUEST['ExperimentatorName'];
     $err = checkExperimentatorValues($requestdata['ExperimentatorID'], $requestdata['ExperimentatorName']);
     if (count($err) === 0) 
       setExperimentator($requestdata['ExperimentatorID'], $requestdata['ExperimentatorName']);
     else { 
     $mode = 'fixExperimentatoritem'; 
     }; 
  };
};
if (($mode == "showlist")&&(count($SearchParam)==1))
{
  $_SESSION["widts"][$widt]["Experimentator"]['SearchParam'] = $SearchParam;
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



if ($modification == 'Clear'.'Experimentator'.'SearchParam'){ $_SESSION['widts'][$widt]['Experimentator']['SearchParam'] = array(); 
$SearchParam = array(); resetExperimentatorOrder($widt); };
if ($modification == 'read'.'Experimentator'.'forth'){ $_SESSION['widts'][$widt]['Experimentator']['Order']['OrderValue'] = $_SESSION['widts'][$widt]['Experimentator']['Order']['MaxValue']; $_SESSION['widts'][$widt]['Experimentator']['Order']['OrderID'] = $_SESSION['widts'][$widt]['Experimentator']['Order']['MaxID'];};
if ($modification == 'change'.'Experimentator'.'sort'){ 
if (isset($_SESSION['widts'][$widt]['Experimentator']['Order']['IsDesc'])) $desc = $_SESSION['widts'][$widt]['Experimentator']['Order']['IsDesc'];
else $desc = true;
resetExperimentatorOrder($widt);
$_SESSION['widts'][$widt]['Experimentator']['Order']['OrderField'] = Experimentator_GetResultNameByExternalName($_REQUEST['sort']);;
$_SESSION['widts'][$widt]['Experimentator']['Order']['IsDesc'] = !$desc;

; };
if (!SysCheck_ConnectionCorrectness()) { $Text = SysGenerateWrongConnectionWarning();} else { 
  if ($mode=='addExperimentatoritem') { $Text =  printExperimentatorEdit( 0, null, $widt);}
  else
  if ($mode=='editExperimentatoritem') {$Text =  printExperimentatorEdit( $id, null, $widt);}
  else
  if ($mode=='fixExperimentatoritem') {$Text =  printExperimentatorEdit( $id, $err, $widt);}
  else
  if ($mode=='historyExperimentatoritem') {$hist = getExperimentatorHistoryByID($id);

  $Text =  printExperimentatorList( $hist, 'history', null, $widt);}
  else
  if (($mode=='showlist')&&($submode=='showlist'))
  {
  ClearFilialWindowData($widt);
  $d = getExperimentatorLevelInfo($widt);
  $Text =  printExperimentatorList($d, 'showlist', NULL, $widt);
  }
  else if (($mode=='showlist')&&($submode=='showselectlist'))
  {
  $d = getExperimentatorLevelInfo($widt);
  $Text =  printExperimentatorList($d, $submode, $RequestedID, $widt);
  }
  else $Text =  "$mode не подходит";
  $Text = '<div style = \'width:100%\'><a href = \'index.php\'>System Main Menu</a></div>'.$Text;}; ///of CorrectConnection work 
$Body = $Text;
$Title = Get_Experimentator_PluralCaption();
$Head = "";
$Head .= '<link rel="stylesheet" type="text/css" href="../../Javascript/style.css" >';
$Text =  PrintTransitional($Head, $Title, $Body);
print $Text;
?>
