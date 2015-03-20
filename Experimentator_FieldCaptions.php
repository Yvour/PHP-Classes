<?php 
 if (!isset($_SESSION["SystemSettings"]["LanguageID"])) $_SESSION["SystemSettings"]["LanguageID"] = 4;//default

function Set_Experimentator_FieldCaptions(){
$LanguageID = $_SESSION["SystemSettings"]["LanguageID"];
  $_SESSION["FieldCaptions"]["Experimentator"]["ExperimentatorID"]["1"]='ExperimentatorID';
  $_SESSION["FieldCaptions"]["Experimentator"]["ExperimentatorID"]["2"]='ExperimentatorID';
  $_SESSION["FieldCaptions"]["Experimentator"]["ExperimentatorID"]["3"]='ExperimentatorID';
  $_SESSION["FieldCaptions"]["Experimentator"]["ExperimentatorID"]["4"]='Экспериментатор';
  $_SESSION["FieldCaptions"]["Experimentator"]["ExperimentatorName"]["1"]='ExperimentatorName';
  $_SESSION["FieldCaptions"]["Experimentator"]["ExperimentatorName"]["2"]='ExperimentatorName';
  $_SESSION["FieldCaptions"]["Experimentator"]["ExperimentatorName"]["3"]='ExperimentatorName';
  $_SESSION["FieldCaptions"]["Experimentator"]["ExperimentatorName"]["4"]='Имя';
  $_SESSION["FieldBackCaptions"]["Experiment"]["MainExperimentatorID"]["1"]='MainExperimentatorID';
  $_SESSION["FieldBackCaptions"]["Experiment"]["MainExperimentatorID"]["2"]='MainExperimentatorID';
  $_SESSION["FieldBackCaptions"]["Experiment"]["MainExperimentatorID"]["3"]='MainExperimentatorID';
  $_SESSION["FieldBackCaptions"]["Experiment"]["MainExperimentatorID"]["4"]='MainExperimentatorID';
  $_SESSION["FieldBackCaptions"]["ExpParam"]["ExperimentatorID"]["1"]='ExperimentatorID';
  $_SESSION["FieldBackCaptions"]["ExpParam"]["ExperimentatorID"]["2"]='ExperimentatorID';
  $_SESSION["FieldBackCaptions"]["ExpParam"]["ExperimentatorID"]["3"]='ExperimentatorID';
  $_SESSION["FieldBackCaptions"]["ExpParam"]["ExperimentatorID"]["4"]='ExperimentatorID';
  $_SESSION["SingleCaptions"]["Experimentator"][1]='Experimentator';
  $_SESSION["PluralCaptions"]["Experimentator"][1]='Experimentator';
  $_SESSION["SingleCaptions"]["Experimentator"][2]='Experimentator';
  $_SESSION["PluralCaptions"]["Experimentator"][2]='Experimentator';
  $_SESSION["SingleCaptions"]["Experimentator"][3]='Experimentator';
  $_SESSION["PluralCaptions"]["Experimentator"][3]='Experimentator';
  $_SESSION["SingleCaptions"]["Experimentator"][4]='Экспериментатор';
  $_SESSION["PluralCaptions"]["Experimentator"][4]='Экспериментаторы';
};
function Get_Experimentator_SingleCaption(){
$LanguageID = $_SESSION["SystemSettings"]["LanguageID"];
return $_SESSION["SingleCaptions"]["Experimentator"][$LanguageID];
};

function Get_Experimentator_PluralCaption(){
$LanguageID = $_SESSION["SystemSettings"]["LanguageID"];
return $_SESSION["PluralCaptions"]["Experimentator"][$LanguageID];
};

function Get_Experimentator_FieldCaption($FieldName){
$LanguageID = $_SESSION["SystemSettings"]["LanguageID"];
return $_SESSION["FieldCaptions"]["Experimentator"][$FieldName][$LanguageID];
};

if (!isset($_SESSION["FieldCaptions"]["Experimentator"])) Set_Experimentator_FieldCaptions();

function Get_Experimentator_Experiment_FieldBackCaption($FieldName){ //back
$LanguageID = $_SESSION["SystemSettings"]["LanguageID"];
return $_SESSION["FieldBackCaptions"]["Experiment"][$FieldName][$LanguageID];
};

function Get_Experimentator_ExpParam_FieldBackCaption($FieldName){ //back
$LanguageID = $_SESSION["SystemSettings"]["LanguageID"];
return $_SESSION["FieldBackCaptions"]["ExpParam"][$FieldName][$LanguageID];
};

 
 ?>