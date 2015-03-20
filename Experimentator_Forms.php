<?php
function printExperimentatorListLevel($Items, $Mode='showlist', $RequestedID = NULL, $widt)
{
};
function printExperimentatorList($Items, $Mode='showlist', $RequestedID = NULL, $widt)
{
  $Textus = '';
  $Counter = 1;
  $Strings = array();
  $IsFirst = 1;
  $AddNew = printInput(array('name' => 'mode', 'value' => 'addExperimentatoritem'));// По умолчанию hidden 
  $AddNew .= printInput(array('name' => 'edit', 'value' => 'Добавить', 'type' => 'submit'));
  $AddNew .= printInput(array('name' => 'widt', 'value' => $widt));//Обязательно идентификатор окна передать 
  $AddNew = printForm(array('action'=>'Experimentator_html.php', 'elements' => $AddNew));
  $BackToList = printInput(array('name' => 'mode', 'value' => 'showlist'));// По умолчанию hidden 
  $BackToList .= printInput(array('name' => 'edit', 'value' => 'К списку', 'type' => 'submit'));
  $BackToList .= printInput(array('name' => 'widt', 'value' => $widt));//Обязательно идентификатор окна передать 
  $BackToList = printForm(array('action'=>'Experimentator_html.php', 'elements' => $BackToList));
  $Forth = printInput(array('name' => 'modification', 'value' => 'readExperimentatorforth'));// По умолчанию hidden 
  $Forth .= printInput(array('name' => 'mode', 'value' => 'showlist'));// По умолчанию hidden 
  $Forth .= printInput(array('name' => 'submode', 'value' => $Mode));// По умолчанию hidden 
  if (NULL != $RequestedID) 
  $Forth .= printInput(array('name' => 'RequestedID', 'value' => $RequestedID));// По умолчанию hidden, не меняется 
  $Forth .= printInput(array('name' => 'widt', 'value' => $widt));// По умолчанию hidden, не меняется 
  $Forth .= printInput(array('name' => 'edit', 'value' => 'Дальше', 'type' => 'submit'));
  $Forth = printForm(array('action'=>'Experimentator_html.php', 'elements' => $Forth));
  if ($Mode === "history") {$AddNew = $BackToList;$Forth = "";} else {$BackToList = "";};
  if (isset($_SESSION['widts'][$widt]['Experimentator']['SearchParam'])) {
  if (count($_SESSION['widts'][$widt]['Experimentator']['SearchParam'])>0) {
  $ClearSearch = printInput(array('name' => 'modification', 'value' => 'ClearExperimentatorSearchParam'));// По умолчанию hidden 
  $ClearSearch .= printInput(array('name' => 'submode', 'value' => $Mode));// По умолчанию hidden, не меняется 
  $ClearSearch .= printInput(array('name' => 'mode', 'value' => 'showlist'));// По умолчанию hidden, не меняется 
  $ClearSearch .= printInput(array('name' => 'RequestedID', 'value' => $RequestedID));// По умолчанию hidden, не меняется 
  $ClearSearch .= printInput(array('name' => 'widt', 'value' => $widt));//Обязательно идентификатор окна передать 
  $ClearSearch .= printInput(array('name' => 'edit', 'value' => 'Все (убрать условие поиска)', 'type' => 'submit'));
  $ClearSearch = printForm(array('action'=>'Experimentator_html.php', 'elements' => $ClearSearch));
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
  $Capt = printInput(array('name' => 'modification', 'value' => 'changeExperimentatorsort'));// По умолчанию hidden 
  $Capt .= printInput(array('name' => 'submode', 'value' => $Mode));// По умолчанию hidden 
  $Capt .= printInput(array('name' => 'mode', 'value' => 'showlist'));// По умолчанию hidden 
  $Capt .= printInput(array('name' => 'RequestedID', 'value' => $RequestedID));// По умолчанию hidden, не меняется 
  $Capt .= printInput(array('name' => 'widt', 'value' => $widt));//Обязательно идентификатор окна передать 
  $Capt .= printInput(array('name' => 'edit', 'value' => Get_Experimentator_FieldCaption('ExperimentatorName'),  'type' => 'submit'));
  $Capt .= printInput(array('name' => 'sort', 'value' => 'f1_2'));// По умолчанию hidden 
  $Capt = printForm(array('action'=>'Experimentator_html.php', 'elements' => $Capt));
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
$MainValue = $vals["tExperimentatorName"];
  $Text = '';
if ($vals['tExperimentatorName']) $divtxt = syshtmlentities( $vals['tExperimentatorName']); else $divtxt = '&nbsp;'; $Text .= "<div class = $cellclass data-id = $id>".$divtxt."</div>";// Обработка на д'Артаньянство
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
$Textus .= '<div id = menu1 class = menu data-scriptname="Experimentator_JSON.php"><table id = menutable><tr><td id = editbutton data-mode = editExperimentatoritem data-action = "Experimentator_html.php">Редактировать</td></tr><tr><td id = historybutton data-mode = historyExperimentatoritem data-action = "Experimentator_html.php">История</td></tr><tr><td id = menuclose>Закрыть</td></tr>';
$BackCaption = Get_Experimentator_Experiment_FieldBackCaption('MainExperimentatorID');
$Textus .= "<tr><td><div class = 'linkbutton' data-mode = showlist data-action = 'Experiment_html.php' data-foreignname = 'SearchParam[MainExperimentatorID]' data-objectlink = 'Experiment_MainExperimentatorID' >$BackCaption(<span id = 'Experiment_MainExperimentatorID' class = 'linkcount'>0</span>)</div></td></tr>";
$BackCaption = Get_Experimentator_ExpParam_FieldBackCaption('ExperimentatorID');
$Textus .= "<tr><td><div class = 'linkbutton' data-mode = showlist data-action = 'ExpParam_html.php' data-foreignname = 'SearchParam[ExperimentatorID]' data-objectlink = 'ExpParam_ExperimentatorID' >$BackCaption(<span id = 'ExpParam_ExperimentatorID' class = 'linkcount'>0</span>)</div></td></tr>";
$Textus .= '<tr class = foreignlink><td id = foreignlink>zzzzz</td></tr>';
$Textus .= '</table><form method = post id = menuform action=Experimentator_html.php><input type = hidden name = ExperimentatorID value = 0 id = ItemID><input type = hidden name = mode value = editExperimentatoritem id = buttonmode><input type = hidden name = \'widt\' value = \''.$widt.'\'></form></div>';
$Textus .= '<span id = dataspan data-host = '.$_SERVER["HTTP_HOST"].'></span>';
  return $Textus;};



function printExperimentatorEdit($id, $err=array(), $widt)
{
  $FormName = 'Experimentator';
  if (count($err) == 0) $fix = 0; else $fix = 1;
  $Text = '';
  $mode = 'showlist';
  $action = 'setExperimentator';
$line = array();
  if (($id > 0) && (0==$fix))
  {
    $query = "select * from f_Exp_Experimentator_SelectByID($id::bigint)";
$Items = array();
    $result = ExecuteExperimentatorQuery( $query) ;//or die("Query failed get more: " . pg_error());
    $line = pg_fetch_array($result, NULL, PGSQL_ASSOC) ;
    writeLog(Printus($line));
    $PHPItemID = $line['ExperimentatorID'];
$table = array();
  }
  else if ($fix == 1)
  foreach ($err as $n=>$v) $line[$n]=$v['value'];
  else 
  { 
    $PHPItemID = null;
  };
$Text .= "<script type = 'text/javascript' src='../../Javascript/Object.js'></script>";$tr = array();
$tr[] = Get_Experimentator_FieldCaption("ExperimentatorName");
$td = printTextInput(array('id' => 'fi_1_',  'onkeyup' => 'checkvalue(this, this.value,\'character varying(144)\')', 'class' => 'character varying(144)','name' => 'ExperimentatorName', 'value' => isset($line["ExperimentatorName"])?($line["ExperimentatorName"]):("")));
$td .= printInput(array("class"=>"datatype", "value" => "character varying(144)"));
$tr[]=$td;
if ($fix == 1)
$tr[]=$err['ExperimentatorName']['error'];
$table[]=$tr;
$Text.= printTable($table);
   $Text .= printInput(array('name'=>'ExperimentatorID', 'value'=>$id));
      $Text .= printInput(array('name'=>'mode', 'value'=>$mode));
      $Text .= printInput(array('name'=>'action', 'value'=>$action));
      $Text .= printInput(array('name'=>'submit', 'value'=>'Сохранить изменения', 'type'=>'submit'));
      $Text .= printInput(array('name' => 'widt', 'value' => $widt));//Обязательно идентификатор окна передать 
      $Text = printForm(array('action'=>'Experimentator_html.php', 'elements'=>$Text));
      $Cancel = printInput(array('name'=>'mode', 'value'=>$mode));
      $Cancel .= printInput(array('name'=>'action', 'value'=>'none'));
      $Cancel .= printInput(array('name'=>'submit', 'value'=>'Отмена', 'type'=>'submit'));
      $Cancel .= printInput(array('name' => 'widt', 'value' => $widt));//Обязательно идентификатор окна передать 
      $Cancel = printForm(array('action'=>'Experimentator_html.php', 'elements'=>$Cancel));
 $Text .= $Cancel;
      $_SESSION['widts'][$widt]['ActionDone'] ='No';
$Text .= '<script type="text/javascript" src = "../../Javascript/jquery-1.9.1.js"></script>';
$Text .= '<script type="text/javascript" src = "../../Javascript/singleedit.js"></script>';
   return $Text;
};

?>
