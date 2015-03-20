<?php
function printExperimentListLevel($Items, $Mode='showlist', $RequestedID = NULL, $widt)
{
};
function printExperimentList($Items, $Mode='showlist', $RequestedID = NULL, $widt)
{
  $Textus = '';
  $Counter = 1;
  $Strings = array();
  $IsFirst = 1;
  $AddNew = printInput(array('name' => 'mode', 'value' => 'addExperimentitem'));// По умолчанию hidden 
  $AddNew .= printInput(array('name' => 'edit', 'value' => 'Добавить', 'type' => 'submit'));
  $AddNew .= printInput(array('name' => 'widt', 'value' => $widt));//Обязательно идентификатор окна передать 
  $AddNew = printForm(array('action'=>'Experiment_html.php', 'elements' => $AddNew));
  $BackToList = printInput(array('name' => 'mode', 'value' => 'showlist'));// По умолчанию hidden 
  $BackToList .= printInput(array('name' => 'edit', 'value' => 'К списку', 'type' => 'submit'));
  $BackToList .= printInput(array('name' => 'widt', 'value' => $widt));//Обязательно идентификатор окна передать 
  $BackToList = printForm(array('action'=>'Experiment_html.php', 'elements' => $BackToList));
  $Forth = printInput(array('name' => 'modification', 'value' => 'readExperimentforth'));// По умолчанию hidden 
  $Forth .= printInput(array('name' => 'mode', 'value' => 'showlist'));// По умолчанию hidden 
  $Forth .= printInput(array('name' => 'submode', 'value' => $Mode));// По умолчанию hidden 
  if (NULL != $RequestedID) 
  $Forth .= printInput(array('name' => 'RequestedID', 'value' => $RequestedID));// По умолчанию hidden, не меняется 
  $Forth .= printInput(array('name' => 'widt', 'value' => $widt));// По умолчанию hidden, не меняется 
  $Forth .= printInput(array('name' => 'edit', 'value' => 'Дальше', 'type' => 'submit'));
  $Forth = printForm(array('action'=>'Experiment_html.php', 'elements' => $Forth));
  if ($Mode === "history") {$AddNew = $BackToList;$Forth = "";} else {$BackToList = "";};
  if (isset($_SESSION['widts'][$widt]['Experiment']['SearchParam'])) {
  if (count($_SESSION['widts'][$widt]['Experiment']['SearchParam'])>0) {
  $ClearSearch = printInput(array('name' => 'modification', 'value' => 'ClearExperimentSearchParam'));// По умолчанию hidden 
  $ClearSearch .= printInput(array('name' => 'submode', 'value' => $Mode));// По умолчанию hidden, не меняется 
  $ClearSearch .= printInput(array('name' => 'mode', 'value' => 'showlist'));// По умолчанию hidden, не меняется 
  $ClearSearch .= printInput(array('name' => 'RequestedID', 'value' => $RequestedID));// По умолчанию hidden, не меняется 
  $ClearSearch .= printInput(array('name' => 'widt', 'value' => $widt));//Обязательно идентификатор окна передать 
  $ClearSearch .= printInput(array('name' => 'edit', 'value' => 'Все (убрать условие поиска)', 'type' => 'submit'));
  $ClearSearch = printForm(array('action'=>'Experiment_html.php', 'elements' => $ClearSearch));
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
  $Capt = printInput(array('name' => 'modification', 'value' => 'changeExperimentsort'));// По умолчанию hidden 
  $Capt .= printInput(array('name' => 'submode', 'value' => $Mode));// По умолчанию hidden 
  $Capt .= printInput(array('name' => 'mode', 'value' => 'showlist'));// По умолчанию hidden 
  $Capt .= printInput(array('name' => 'RequestedID', 'value' => $RequestedID));// По умолчанию hidden, не меняется 
  $Capt .= printInput(array('name' => 'widt', 'value' => $widt));//Обязательно идентификатор окна передать 
  $Capt .= printInput(array('name' => 'edit', 'value' => Get_Experiment_FieldCaption('ExperimentName'),  'type' => 'submit'));
  $Capt .= printInput(array('name' => 'sort', 'value' => 'f1_2'));// По умолчанию hidden 
  $Capt = printForm(array('action'=>'Experiment_html.php', 'elements' => $Capt));
$Text.= $Capt;
$Text .= '</td>';
$Text .= '<td colspan = 1 rowspan = 1>';
    $Text .=Get_Experiment_FieldCaption('IsDangeous');
$Text .= '</td>';
$Text .= '<td colspan = 1 rowspan = 1>';
    $Text .=Get_Experiment_FieldCaption('ShortComment');
$Text .= '</td>';
$Text .= '<td colspan = 1 rowspan = 1>';
    $Text .=Get_Experiment_FieldCaption('SecondComment');
$Text .= '</td>';
$Text .= '<td colspan = 1 rowspan = 1>';
    $Text .=Get_Experiment_FieldCaption('ThirdComment');
$Text .= '</td>';
$Text .= '<td colspan = 1 rowspan = 1>';
    $Text .=Get_Experiment_FieldCaption('FourthComment');
$Text .= '</td>';
$Text .= '<td colspan = 1 rowspan = 1>';
  $Capt = printInput(array('name' => 'modification', 'value' => 'changeExperimentsort'));// По умолчанию hidden 
  $Capt .= printInput(array('name' => 'submode', 'value' => $Mode));// По умолчанию hidden 
  $Capt .= printInput(array('name' => 'mode', 'value' => 'showlist'));// По умолчанию hidden 
  $Capt .= printInput(array('name' => 'RequestedID', 'value' => $RequestedID));// По умолчанию hidden, не меняется 
  $Capt .= printInput(array('name' => 'widt', 'value' => $widt));//Обязательно идентификатор окна передать 
  $Capt .= printInput(array('name' => 'edit', 'value' => Get_Experiment_FieldCaption('MainExperimentatorID'),  'type' => 'submit'));
  $Capt .= printInput(array('name' => 'sort', 'value' => 'f1_8'));// По умолчанию hidden 
  $Capt = printForm(array('action'=>'Experiment_html.php', 'elements' => $Capt));
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
$MainValue = $vals["tExperimentName"];
  $Text = '';
if ($vals['tExperimentName']) $divtxt = syshtmlentities( $vals['tExperimentName']); else $divtxt = '&nbsp;'; $Text .= "<div class = $cellclass data-id = $id>".$divtxt."</div>";// Обработка на д'Артаньянство
  $Massive[] = $Text;
  $Text = '';
if ($vals['tIsDangeous']) $divtxt = syshtmlentities( $vals['tIsDangeous']); else $divtxt = '&nbsp;';  $Text .= ($vals['tIsDangeous']=='t')?('<input type = checkbox checked disabled>'):('<input type = checkbox disabled>');
;// Обработка на д'Артаньянство
  $Massive[] = $Text;
  $Text = '';
if ($vals['tShortComment']) $divtxt = syshtmlentities( $vals['tShortComment']); else $divtxt = '&nbsp;'; $Text .= "<div class = $cellclass data-id = $id>".$divtxt."</div>";// Обработка на д'Артаньянство
  $Massive[] = $Text;
  $Text = '';
if ($vals['tSecondComment']) $divtxt = syshtmlentities( $vals['tSecondComment']); else $divtxt = '&nbsp;'; $Text .= "<div class = $cellclass data-id = $id>".$divtxt."</div>";// Обработка на д'Артаньянство
  $Massive[] = $Text;
  $Text = '';
if ($vals['tThirdComment']) $divtxt = syshtmlentities( $vals['tThirdComment']); else $divtxt = '&nbsp;'; $Text .= "<div class = $cellclass data-id = $id>".$divtxt."</div>";// Обработка на д'Артаньянство
  $Massive[] = $Text;
  $Text = '';
if ($vals['tFourthComment']) $divtxt = syshtmlentities( $vals['tFourthComment']); else $divtxt = '&nbsp;'; $Text .= "<div class = $cellclass data-id = $id>".$divtxt."</div>";// Обработка на д'Артаньянство
  $Massive[] = $Text;
  $Text = '';
if ($vals['t_f7_ExperimentatorName']) $divtxt = syshtmlentities( $vals['t_f7_ExperimentatorName']); else $divtxt = '&nbsp;';$BCaption = Get_Experiment_FieldCaption("MainExperimentatorID");
 $Text .= "<div class = '$cellclass $foreigncellclass' data-foreignname = 'SearchParam[ExperimentatorID]' data-foreignaction = 'Experimentator_html.php' data-foreigncaption = '$BCaption' data-foreignid = ".$vals['t_f7_ExperimentatorID']." data-id = $id>".$divtxt."</div>";// Обработка на д'Артаньянство
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
$Textus .= '<div id = menu1 class = menu data-scriptname="Experiment_JSON.php"><table id = menutable><tr><td id = editbutton data-mode = editExperimentitem data-action = "Experiment_html.php">Редактировать</td></tr><tr><td id = historybutton data-mode = historyExperimentitem data-action = "Experiment_html.php">История</td></tr><tr><td id = menuclose>Закрыть</td></tr>';
$Textus .= '<tr class = foreignlink><td id = foreignlink>zzzzz</td></tr>';
$Textus .= '</table><form method = post id = menuform action=Experiment_html.php><input type = hidden name = ExperimentID value = 0 id = ItemID><input type = hidden name = mode value = editExperimentitem id = buttonmode><input type = hidden name = \'widt\' value = \''.$widt.'\'></form></div>';
$Textus .= '<span id = dataspan data-host = '.$_SERVER["HTTP_HOST"].'></span>';
  return $Textus;};



function printExperimentEdit($id, $err=array(), $widt)
{
  $FormName = 'Experiment';
  if (count($err) == 0) $fix = 0; else $fix = 1;
  $Text = '';
  $mode = 'showlist';
  $action = 'setExperiment';
$line = array();
  if (($id > 0) && (0==$fix))
  {
    $query = "select * from f_Exp_Experiment_SelectByID($id::bigint)";
$Items = array();
    $result = ExecuteExperimentQuery( $query) ;//or die("Query failed get more: " . pg_error());
    $line = pg_fetch_array($result, NULL, PGSQL_ASSOC) ;
    writeLog(Printus($line));
    $PHPItemID = $line['ExperimentID'];
$table = array();
  }
  else if ($fix == 1)
  foreach ($err as $n=>$v) $line[$n]=$v['value'];
  else 
  { 
    $PHPItemID = null;
  };
$Text .= "<script type = 'text/javascript' src='../../Javascript/Object.js'></script>";$tr = array();
$tr[] = Get_Experiment_FieldCaption("ExperimentName");
$td = printTextInput(array('id' => 'fi_1_',  'onkeyup' => 'checkvalue(this, this.value,\'character varying(36)\')', 'class' => 'character varying(36)','name' => 'ExperimentName', 'value' => isset($line["ExperimentName"])?($line["ExperimentName"]):("")));
$td .= printInput(array("class"=>"datatype", "value" => "character varying(36)"));
$tr[]=$td;
if ($fix == 1)
$tr[]=$err['ExperimentName']['error'];
$table[]=$tr;
$tr = array();
$tr[] = Get_Experiment_FieldCaption("IsDangeous");
$checked = (isset($line['IsDangeous']))?(($line['IsDangeous']=='t')?("checked"):("")):("");
$td = '<input type = checkbox name = IsDangeous id = fi_2 '.$checked.'>';
$tr[]=$td;
if ($fix == 1)
$tr[]=$err['IsDangeous']['error'];
$table[]=$tr;
$tr = array();
$tr[] = Get_Experiment_FieldCaption("ShortComment");
$td = printTextInput(array('id' => 'fi_3_',  'onkeyup' => 'checkvalue(this, this.value,\'character varying(144)\')', 'class' => 'character varying(144)','name' => 'ShortComment', 'value' => isset($line["ShortComment"])?($line["ShortComment"]):("")));
$td .= printInput(array("class"=>"datatype", "value" => "character varying(144)"));
$tr[]=$td;
if ($fix == 1)
$tr[]=$err['ShortComment']['error'];
$table[]=$tr;
$tr = array();
$tr[] = Get_Experiment_FieldCaption("SecondComment");
$td = printTextInput(array('id' => 'fi_4_',  'onkeyup' => 'checkvalue(this, this.value,\'character varying(144)\')', 'class' => 'character varying(144)','name' => 'SecondComment', 'value' => isset($line["SecondComment"])?($line["SecondComment"]):("")));
$td .= printInput(array("class"=>"datatype", "value" => "character varying(144)"));
$tr[]=$td;
if ($fix == 1)
$tr[]=$err['SecondComment']['error'];
$table[]=$tr;
$tr = array();
$tr[] = Get_Experiment_FieldCaption("ThirdComment");
$td = printTextInput(array('id' => 'fi_5_',  'onkeyup' => 'checkvalue(this, this.value,\'character varying\')', 'class' => 'character varying','name' => 'ThirdComment', 'value' => isset($line["ThirdComment"])?($line["ThirdComment"]):("")));
$td .= printInput(array("class"=>"datatype", "value" => "character varying"));
$tr[]=$td;
if ($fix == 1)
$tr[]=$err['ThirdComment']['error'];
$table[]=$tr;
$tr = array();
$tr[] = Get_Experiment_FieldCaption("FourthComment");
$td = printTextInput(array('id' => 'fi_6_',  'onkeyup' => 'checkvalue(this, this.value,\'character varying(144)\')', 'class' => 'character varying(144)','name' => 'FourthComment', 'value' => isset($line["FourthComment"])?($line["FourthComment"]):("")));
$td .= printInput(array("class"=>"datatype", "value" => "character varying(144)"));
$tr[]=$td;
if ($fix == 1)
$tr[]=$err['FourthComment']['error'];
$table[]=$tr;
$tr = array();
$tr[] = Get_Experiment_FieldCaption("MainExperimentatorID");
$MainExperimentatorID = (isset($line['MainExperimentatorID']))?($line['MainExperimentatorID']):
             ((isset($_SESSION['widts'][$widt]['Experiment']['SearchParam']['MainExperimentatorID']))?($_SESSION['widts'][$widt]['Experiment']['SearchParam']['MainExperimentatorID']):(0));
if ($MainExperimentatorID > 0) {
  $query = 'SELECT * FROM f_Exp_Experimentator_SelectByID('.$MainExperimentatorID.'::bigint)';;
  $result = ExecuteExperimentQuery( $query);
  $line0 = pg_fetch_array($result, NULL, PGSQL_ASSOC);
  unset($line0['ExperimentatorID']);
  $Name = $line0["ExperimentatorName"];
}
 else $Name = 'пусто';
$tddata = printInput(array('name'=>'MainExperimentatorID', 'id' => 'MainExperimentatorID', 'value'=>$MainExperimentatorID));
$td = $tddata."<div id = MainExperimentatorIDtext onClick =  \"window.open('Experimentator_html.php?pid=$widt&mode=showlist&submode=showselectlist&SearchParam[ExperimentatorID]=$MainExperimentatorID&RequestedID=MainExperimentatorID"."'". ")\">".$Name."</div>";
$tr[]=$td;
if ($fix == 1)
$tr[]=$err['MainExperimentatorID']['error'];
$table[]=$tr;
$Text.= printTable($table);
   $Text .= printInput(array('name'=>'ExperimentID', 'value'=>$id));
      $Text .= printInput(array('name'=>'mode', 'value'=>$mode));
      $Text .= printInput(array('name'=>'action', 'value'=>$action));
      $Text .= printInput(array('name'=>'submit', 'value'=>'Сохранить изменения', 'type'=>'submit'));
      $Text .= printInput(array('name' => 'widt', 'value' => $widt));//Обязательно идентификатор окна передать 
      $Text = printForm(array('action'=>'Experiment_html.php', 'elements'=>$Text));
      $Cancel = printInput(array('name'=>'mode', 'value'=>$mode));
      $Cancel .= printInput(array('name'=>'action', 'value'=>'none'));
      $Cancel .= printInput(array('name'=>'submit', 'value'=>'Отмена', 'type'=>'submit'));
      $Cancel .= printInput(array('name' => 'widt', 'value' => $widt));//Обязательно идентификатор окна передать 
      $Cancel = printForm(array('action'=>'Experiment_html.php', 'elements'=>$Cancel));
 $Text .= $Cancel;
      $_SESSION['widts'][$widt]['ActionDone'] ='No';
$Text .= '<script type="text/javascript" src = "../../Javascript/jquery-1.9.1.js"></script>';
$Text .= '<script type="text/javascript" src = "../../Javascript/singleedit.js"></script>';
   return $Text;
};

?>
