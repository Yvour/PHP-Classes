<?php

session_start();
include "../../HTML/HTMLFunctions.php";
include "../../Common/CheckValue.php";
include "../../printall.php";
include "../../Common/DBFunctions.php";
include "index_common.php";
include "ExpParam_Forms.php";
include "ExpParam_Functions.php";
function ExpParam_GetResultNameByExternalName( $externalname )
{
  switch ($externalname){
  case 'f1_4': return 't_f3_ExperimentatorName';
  default: return '';
  };// of switch
};
function ExpParam_GetExternalNameByResultName( $externalname )
{
  switch ($externalname){
  case 't_f3_ExperimentatorName': return 'f1_4';
  default: return '';
  };// of switch
};
function resetExpParamOrder($widt)
{
  $_SESSION['widts'][$widt]['ExpParam']['Order'] = array();
  $_SESSION['widts'][$widt]['ExpParam']['Order']['OrderField'] = 'tExpParamID';
  $_SESSION['widts'][$widt]['ExpParam']['Order']['OrderValue'] = '0';
  $_SESSION['widts'][$widt]['ExpParam']['Order']['OrderID'] = '0';
  $_SESSION['widts'][$widt]['ExpParam']['Order']['IsDesc'] = true;
};
function getExpParamLevelInfo($widt)
{
  if (!isset($_SESSION['widts'][$widt]['ExpParam']['Order'])) {
    resetExpParamOrder($widt);
  };
  $OrderField = $_SESSION['widts'][$widt]['ExpParam']['Order']['OrderField'];
  $Desc = ($_SESSION['widts'][$widt]['ExpParam']['Order']['IsDesc'])?('desc'):('asc');
  $Items = array();
  $query = 'select t."ExpParamID" as "tExpParamID",t."ExpParamName" as "tExpParamName",t."ExpParamValue" as "tExpParamValue",t_f3_."ExperimentatorID" as "t_f3_ExperimentatorID",t_f3_."ExperimentatorName" as "t_f3_ExperimentatorName" from "f_Exp_ExpParam_Main" t
left join "f_Exp_Experimentator_Main" t_f3_
on t."ExperimentatorID" = t_f3_."ExperimentatorID"
where 1 = 1
';  if (isset($_SESSION["widts"][$widt]["ExpParam"]["SearchParam"])) {
              foreach ($_SESSION["widts"][$widt]["ExpParam"]["SearchParam"] as $i => $param)
               $query .= " and t.\"$i\" = $param";
              };
 $OrderField = $_SESSION["widts"][$widt]["ExpParam"]["Order"]["OrderField"];
  $query .= " order by \"$OrderField\"  $Desc";
  $result = ExecuteExpParamQuery($query) ;
  while ($line = pg_fetch_array($result, NULL, PGSQL_ASSOC)) 
    {
      $ExpParamID = $line['tExpParamID'];
      unset($line['tExpParamID']);
      $Items[$ExpParamID]['o'] = $line;
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
$id = (isset($_REQUEST['ExpParamID']))?($_REQUEST['ExpParamID']):(0);
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
  if ( 'setExpParam'===$action )
  {
$requestdata = array();
$requestdata['ExpParamID'] = $_REQUEST['ExpParamID'];
$requestdata['ExpParamName'] = $_REQUEST['ExpParamName'];
$requestdata['ExpParamValue'] = $_REQUEST['ExpParamValue'];
$requestdata['ExperimentatorID'] = $_REQUEST['ExperimentatorID'];
     $err = checkExpParamValues($requestdata['ExpParamID'], $requestdata['ExpParamName'], $requestdata['ExpParamValue'], $requestdata['ExperimentatorID']);
     if (count($err) === 0) 
       setExpParam($requestdata['ExpParamID'], $requestdata['ExpParamName'], $requestdata['ExpParamValue'], $requestdata['ExperimentatorID']);
     else { 
     $mode = 'fixExpParamitem'; 
     }; 
  };
};
if (($mode == "showlist")&&(count($SearchParam)==1))
{
  $_SESSION["widts"][$widt]["ExpParam"]['SearchParam'] = $SearchParam;
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



if ($modification == 'Clear'.'ExpParam'.'SearchParam'){ $_SESSION['widts'][$widt]['ExpParam']['SearchParam'] = array(); 
$SearchParam = array(); resetExpParamOrder($widt); };
if ($modification == 'read'.'ExpParam'.'forth'){ $_SESSION['widts'][$widt]['ExpParam']['Order']['OrderValue'] = $_SESSION['widts'][$widt]['ExpParam']['Order']['MaxValue']; $_SESSION['widts'][$widt]['ExpParam']['Order']['OrderID'] = $_SESSION['widts'][$widt]['ExpParam']['Order']['MaxID'];};
if ($modification == 'change'.'ExpParam'.'sort'){ 
if (isset($_SESSION['widts'][$widt]['ExpParam']['Order']['IsDesc'])) $desc = $_SESSION['widts'][$widt]['ExpParam']['Order']['IsDesc'];
else $desc = true;
resetExpParamOrder($widt);
$_SESSION['widts'][$widt]['ExpParam']['Order']['OrderField'] = ExpParam_GetResultNameByExternalName($_REQUEST['sort']);;
$_SESSION['widts'][$widt]['ExpParam']['Order']['IsDesc'] = !$desc;

; };
if (!SysCheck_ConnectionCorrectness()) { $Text = SysGenerateWrongConnectionWarning();} else { 
  if ($mode=='addExpParamitem') { $Text =  printExpParamEdit( 0, null, $widt);}
  else
  if ($mode=='editExpParamitem') {$Text =  printExpParamEdit( $id, null, $widt);}
  else
  if ($mode=='fixExpParamitem') {$Text =  printExpParamEdit( $id, $err, $widt);}
  else
  if ($mode=='historyExpParamitem') {$hist = getExpParamHistoryByID($id);

  $Text =  printExpParamList( $hist, 'history', null, $widt);}
  else
  if (($mode=='showlist')&&($submode=='showlist'))
  {
  ClearFilialWindowData($widt);
  $d = getExpParamLevelInfo($widt);
  $Text =  printExpParamList($d, 'showlist', NULL, $widt);
  }
  else if (($mode=='showlist')&&($submode=='showselectlist'))
  {
  $d = getExpParamLevelInfo($widt);
  $Text =  printExpParamList($d, $submode, $RequestedID, $widt);
  }
  else $Text =  "$mode не подходит";
  $Text = '<div style = \'width:100%\'><a href = \'index.php\'>System Main Menu</a></div>'.$Text;}; ///of CorrectConnection work 
$Body = $Text;
$Title = Get_ExpParam_PluralCaption();
$Head = "";
$Head .= '<link rel="stylesheet" type="text/css" href="../../Javascript/style.css" >';
$Text =  PrintTransitional($Head, $Title, $Body);
print $Text;
?>
