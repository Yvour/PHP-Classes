<?php
   session_start();    
   include "../../HTML/HTMLFunctions.php";
   include "index_common.php";
   $Text = "";      print PrintTransitionalBegin("SystemName", '<link rel="stylesheet" type="text/css" href="../../Javascript/style.css" />');

require_once("Experimentator_Class.php");
require_once("Experimentator_Functions.php");
require_once("Experiment_Class.php");
require_once("Experiment_Functions.php");
require_once("ExpParam_Class.php");
require_once("ExpParam_Functions.php");
if (SysCheck_ConnectionCorrectness()){
$elem =  printInput(array("type"=>"submit", "name"=>Get_Experimentator_PluralCaption(4)));
$Text .= printForm(array("action"=>"Experimentator_html.php", "elements"=>$elem));
$elem =  printInput(array("type"=>"submit", "name"=>Get_Experiment_PluralCaption(4)));
$Text .= printForm(array("action"=>"Experiment_html.php", "elements"=>$elem));
$elem =  printInput(array("type"=>"submit", "name"=>Get_ExpParam_PluralCaption(4)));
$Text .= printForm(array("action"=>"ExpParam_html.php", "elements"=>$elem));
} else {$Text .= SysGenerateWrongConnectionWarning();};
print $Text; print PrintTransitionalEnd();

?>