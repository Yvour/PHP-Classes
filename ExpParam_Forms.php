<?php
function printExpParamListLevel($Items, $Mode='showlist', $RequestedID = NULL, $widt)
{
};
function printExpParamList($Items, $Mode='showlist', $RequestedID = NULL, $widt)
{
  $Textus = '';
  $Counter = 1;
  $Strings = array();
  $IsFirst = 1;
  $AddNew = printInput(array('name' => 'mode', 'value' => 'addExpParamitem'));// По умолчанию hidden 
  $AddNew .= printInput(array('name' => 'edit', 'value' => 'Добавить', 'type' => 'submit'));
  $AddNew .= printInput(array('name' => 'widt', 'value' => $widt));//Обязательно идентификатор окна передать 
  $AddNew = printForm(array('action'=>'ExpParam_html.php', 'elements' => $AddNew));
  $BackToList = printInput(array('name' => 'mode', 'value' => 'showlist'));// По умолчанию hidden 
  $BackToList .= printInput(array('name' => 'edit', 'value' => 'К списку', 'type' => 'submit'));
  $BackToList .= printInput(array('name' => 'widt', 'value' => $widt));//Обязательно идентификатор окна передать 
  $BackToList = printForm(array('action'=>'ExpParam_html.php', 'elements' => $BackToList));
  $Forth = printInput(array('name' => 'modification', 'value' => 'readExpParamforth'));// По умолчанию hidden 
  $Forth .= printInput(array('name' => 'mode', 'value' => 'showlist'));// По умолчанию hidden 
  $Forth .= printInput(array('name' => 'submode', 'value' => $Mode));// По умолчанию hidden 
  if (NULL != $RequestedID) 
  $Forth .= printInput(array('name' => 'RequestedID', 'value' => $RequestedID));// По умолчанию hidden, не меняется 
  $Forth .= printInput(array('name' => 'widt', 'value' => $widt));// По умолчанию hidden, не меняется 
  $Forth .= printInput(array('name' => 'edit', 'value' => 'Дальше', 'type' => 'submit'));
  $Forth = printForm(array('action'=>'ExpParam_html.php', 'elements' => $Forth));
  if ($Mode === "history") {$AddNew = $BackToList;$Forth = "";} else {$BackToList = "";};
  if (isset($_SESSION['widts'][$widt]['ExpParam']['SearchParam'])) {
  if (count($_SESSION['widts'][$widt]['ExpParam']['SearchParam'])>0) {
  $ClearSearch = printInput(array('name' => 'modification', 'value' => 'ClearExpParamSearchParam'));// По умолчанию hidden 
  $ClearSearch .= printInput(array('name' => 'submode', 'value' => $Mode));// По умолчанию hidden, не меняется 
  $ClearSearch .= printInput(array('name' => 'mode', 'value' => 'showlist'));// По умолчанию hidden, не меняется 
  $ClearSearch .= printInput(array('name' => 'RequestedID', 'value' => $RequestedID));// По умолчанию hidden, не меняется 
  $ClearSearch .= printInput(array('name' => 'widt', 'value' => $widt));//Обязательно идентификатор окна передать 
  $ClearSearch .= printInput(array('name' => 'edit', 'value' => 'Все (убрать условие поиска)', 'type' => 'submit'));
  $ClearSearch = printForm(array('action'=>'ExpParam_html.php', 'elements' => $ClearSearch));
  } else $ClearSearch = '';
  } else $ClearSearch = '';
  $Textus .= $AddNew; 
  $Textus .= $Forth; 
 if ($Mode === "history") $cellclass = "historydatacell"; else $cellclass = "datacell";
 if ($Mode === "history") $foreigncellclass = "historydatacell"; else $foreigncellclass = "foreigndatacell";
 if ($Mode !== 'history') $Textus .= $ClearSearch; 
$Text = '';
$Text .= "<tr>";
$Text .= '<td colspan = 1 rowspan = 1>';
$Text .= '*';
$Text .= '</td>';
$Text .= '<td colspan = 1 rowspan = 1>';
    $Text .=Get_ExpParam_FieldCaption('ExpParamName');
$Text .= '</td>';
$Text .= '<td colspan = 1 rowspan = 1>';
    $Text .=Get_ExpParam_FieldCaption('ExpParamValue');
$Text .= '</td>';
$Text .= '<td colspan = 1 rowspan = 1>';
  $Capt = printInput(array('name' => 'modification', 'value' => 'changeExpParamsort'));// По умолчанию hidden 
  $Capt .= printInput(array('name' => 'submode', 'value' => $Mode));// По умолчанию hidden 
  $Capt .= printInput(array('name' => 'mode', 'value' => 'showlist'));// По умолчанию hidden 
  $Capt .= printInput(array('name' => 'RequestedID', 'value' => $RequestedID));// По умолчанию hidden, не меняется 
  $Capt .= printInput(array('name' => 'widt', 'value' => $widt));//Обязательно идентификатор окна передать 
  $Capt .= printInput(array('name' => 'edit', 'value' => Get_ExpParam_FieldCaption('ExperimentatorID'),  'type' => 'submit'));
  $Capt .= printInput(array('name' => 'sort', 'value' => 'f1_4'));// По умолчанию hidden 
  $Capt = printForm(array('action'=>'ExpParam_html.php', 'elements' => $Capt));
$Text.= $Capt;
$Text .= '</td>';
$Text .= '</tr>';
$TableHeaderText = $Text;
foreach ($Items as $id => $values)
{
    $vals = $values['o'];
   $MainValue = implode('|',  $vals);
    $Massive = array();
    $Massive[] = $Counter;
  $Text = '';
if ($vals['tExpParamName']) $divtxt = syshtmlentities( $vals['tExpParamName']); else $divtxt = '&nbsp;'; $Text .= "<div class = $cellclass data-id = $id>".$divtxt."</div>";// Обработка на д'Артаньянство
  $Massive[] = $Text;
  $Text = '';
if ($vals['tExpParamValue']) $divtxt = syshtmlentities( $vals['tExpParamValue']); else $divtxt = '&nbsp;'; $Text .= "<div class = $cellclass data-id = $id>".$divtxt."</div>";// Обработка на д'Артаньянство
  $Massive[] = $Text;
  $Text = '';
if ($vals['t_f3_ExperimentatorName']) $divtxt = syshtmlentities( $vals['t_f3_ExperimentatorName']); else $divtxt = '&nbsp;';$BCaption = Get_ExpParam_FieldCaption("ExperimentatorID");
 $Text .= "<div class = '$cellclass $foreigncellclass' data-foreignname = 'SearchParam[ExperimentatorID]' data-foreignaction = 'Experimentator_html.php' data-foreigncaption = '$BCaption' data-foreignid = ".$vals['t_f3_ExperimentatorID']." data-id = $id>".$divtxt."</div>";// Обработка на д'Артаньянство
  $Massive[] = $Text;
 if ($Mode == 'showselectlist'){
   $value = $MainValue;
   $Text = "<div onclick = 'setValue(\"".$RequestedID."\", $id, \"".$value."\")'>Выбрать</div>";// По умолчанию hidden
   $Massive[] = $Text;
  } 
 else if ("history" === $Mode) {
 $Massive[]=$values["a"]["ActionTime"];
};
    
    $Strings[]= $Massive;
    $Counter++;

  };
  $Textus .= printTable($Strings, array('header'=>$TableHeaderText, 'classalternation' => array('grey0', 'grey1')));
  $Textus .= $AddNew; 
  $Textus .= '<script type="text/javascript" src = "../../Javascript/jquery-1.9.1.js"></script>';
  if ($Mode=='showselectlist')
    $Textus .= '<script type="text/javascript" src = "../../Javascript/showselectlist.js"></script>';
  else
    $Textus .= '<script type="text/javascript" src = "../../Javascript/application.js"></script>';
$Textus .= '<div id = menu1 class = menu data-scriptname="ExpParam_JSON.php"><table id = menutable><tr><td id = editbutton data-mode = editExpParamitem data-action = "ExpParam_html.php">Редактировать</td></tr><tr><td id = historybutton data-mode = historyExpParamitem data-action = "ExpParam_html.php">История</td></tr><tr><td id = menuclose>Закрыть</td></tr>';
$Textus .= '<tr class = foreignlink><td id = foreignlink>zzzzz</td></tr>';
$Textus .= '</table><form method = post id = menuform action=ExpParam_html.php><input type = hidden name = ExpParamID value = 0 id = ItemID><input type = hidden name = mode value = editExpParamitem id = buttonmode><input type = hidden name = \'widt\' value = \''.$widt.'\'></form></div>';
$Textus .= '<span id = dataspan data-host = '.$_SERVER["HTTP_HOST"].'></span>';
  return $Textus;};



function printExpParamEdit($id, $err=array(), $widt)
{
  $FormName = 'ExpParam';
  if (count($err) == 0) $fix = 0; else $fix = 1;
  $Text = '';
  $mode = 'showlist';
  $action = 'setExpParam';
$line = array();
  if (($id > 0) && (0==$fix))
  {
    $query = "select * from f_Exp_ExpParam_SelectByID($id::bigint)";
$Items = array();
    $result = ExecuteExpParamQuery( $query) ;//or die("Query failed get more: " . pg_error());
    $line = pg_fetch_array($result, NULL, PGSQL_ASSOC) ;
    writeLog(Printus($line));
    $PHPItemID = $line['ExpParamID'];
$table = array();
  }
  else if ($fix == 1)
  foreach ($err as $n=>$v) $line[$n]=$v['value'];
  else 
  { 
    $PHPItemID = null;
  };
$Text .= "<script type = 'text/javascript' src='../../Javascript/Object.js'></script>";$tr = array();
$tr[] = Get_ExpParam_FieldCaption("ExpParamName");
$td = printTextInput(array('id' => 'fi_1_',  'onkeyup' => 'checkvalue(this, this.value,\'character varying(36)\')', 'class' => 'character varying(36)','name' => 'ExpParamName', 'value' => isset($line["ExpParamName"])?($line["ExpParamName"]):("")));
$td .= printInput(array("class"=>"datatype", "value" => "character varying(36)"));
$tr[]=$td;
if ($fix == 1)
$tr[]=$err['ExpParamName']['error'];
$table[]=$tr;
$tr = array();
$tr[] = Get_ExpParam_FieldCaption("ExpParamValue");
$td = printTextInput(array('id' => 'fi_2_',  'onkeyup' => 'checkvalue(this, this.value,\'bigint\')', 'class' => 'bigint','name' => 'ExpParamValue', 'value' => isset($line["ExpParamValue"])?($line["ExpParamValue"]):("")));
$td .= printInput(array("class"=>"datatype", "value" => "bigint"));
$tr[]=$td;
if ($fix == 1)
$tr[]=$err['ExpParamValue']['error'];
$table[]=$tr;
$tr = array();
$tr[] = Get_ExpParam_FieldCaption("ExperimentatorID");
$ExperimentatorID = (isset($line['ExperimentatorID']))?($line['ExperimentatorID']):
             ((isset($_SESSION['widts'][$widt]['ExpParam']['SearchParam']['ExperimentatorID']))?($_SESSION['widts'][$widt]['ExpParam']['SearchParam']['ExperimentatorID']):(0));
if ($ExperimentatorID > 0) {
  $query = 'SELECT * FROM f_Exp_Experimentator_SelectByID('.$ExperimentatorID.'::bigint)';;
  $result = ExecuteExpParamQuery( $query);
  $line0 = pg_fetch_array($result, NULL, PGSQL_ASSOC);
  unset($line0['ExperimentatorID']);
  $Name = $line0["ExperimentatorName"];
}
 else $Name = 'пусто';
$tddata = printInput(array('name'=>'ExperimentatorID', 'id' => 'ExperimentatorID', 'value'=>$ExperimentatorID));
$td = $tddata."<div id = ExperimentatorIDtext onClick =  \"window.open('Experimentator_html.php?pid=$widt&mode=showlist&submode=showselectlist&SearchParam[ExperimentatorID]=$ExperimentatorID&RequestedID=ExperimentatorID"."'". ")\">".$Name."</div>";
$tr[]=$td;
if ($fix == 1)
$tr[]=$err['ExperimentatorID']['error'];
$table[]=$tr;
$Text.= printTable($table);
   $Text .= printInput(array('name'=>'ExpParamID', 'value'=>$id));
      $Text .= printInput(array('name'=>'mode', 'value'=>$mode));
      $Text .= printInput(array('name'=>'action', 'value'=>$action));
      $Text .= printInput(array('name'=>'submit', 'value'=>'Сохранить изменения', 'type'=>'submit'));
      $Text .= printInput(array('name' => 'widt', 'value' => $widt));//Обязательно идентификатор окна передать 
      $Text = printForm(array('action'=>'ExpParam_html.php', 'elements'=>$Text));
      $Cancel = printInput(array('name'=>'mode', 'value'=>$mode));
      $Cancel .= printInput(array('name'=>'action', 'value'=>'none'));
      $Cancel .= printInput(array('name'=>'submit', 'value'=>'Отмена', 'type'=>'submit'));
      $Cancel .= printInput(array('name' => 'widt', 'value' => $widt));//Обязательно идентификатор окна передать 
      $Cancel = printForm(array('action'=>'ExpParam_html.php', 'elements'=>$Cancel));
 $Text .= $Cancel;
      $_SESSION['widts'][$widt]['ActionDone'] ='No';
$Text .= '<script type="text/javascript" src = "../../Javascript/jquery-1.9.1.js"></script>';
$Text .= '<script type="text/javascript" src = "../../Javascript/singleedit.js"></script>';
   return $Text;
};

?>
