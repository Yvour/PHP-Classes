<?php 
 if (!isset($_SESSION["SystemSettings"]["LanguageID"])) $_SESSION["SystemSettings"]["LanguageID"] = 4;//default

function Set_ExpParam_FieldCaptions(){
$LanguageID = $_SESSION["SystemSettings"]["LanguageID"];
  $_SESSION["FieldCaptions"]["ExpParam"]["ExpParamID"]["1"]='ExpParamID';
  $_SESSION["FieldCaptions"]["ExpParam"]["ExpParamID"]["2"]='ExpParamID';
  $_SESSION["FieldCaptions"]["ExpParam"]["ExpParamID"]["3"]='ExpParamID';
  $_SESSION["FieldCaptions"]["ExpParam"]["ExpParamID"]["4"]='ExpParamID';
  $_SESSION["FieldCaptions"]["ExpParam"]["ExpParamName"]["1"]='ExpParamName';
  $_SESSION["FieldCaptions"]["ExpParam"]["ExpParamName"]["2"]='ExpParamName';
  $_SESSION["FieldCaptions"]["ExpParam"]["ExpParamName"]["3"]='ExpParamName';
  $_SESSION["FieldCaptions"]["ExpParam"]["ExpParamName"]["4"]='ExpParamName';
  $_SESSION["FieldCaptions"]["ExpParam"]["ExpParamValue"]["1"]='ExpParamValue';
  $_SESSION["FieldCaptions"]["ExpParam"]["ExpParamValue"]["2"]='ExpParamValue';
  $_SESSION["FieldCaptions"]["ExpParam"]["ExpParamValue"]["3"]='ExpParamValue';
  $_SESSION["FieldCaptions"]["ExpParam"]["ExpParamValue"]["4"]='ExpParamValue';
  $_SESSION["FieldCaptions"]["ExpParam"]["ExperimentatorID"]["1"]='ExperimentatorID';
  $_SESSION["FieldCaptions"]["ExpParam"]["ExperimentatorID"]["2"]='ExperimentatorID';
  $_SESSION["FieldCaptions"]["ExpParam"]["ExperimentatorID"]["3"]='ExperimentatorID';
  $_SESSION["FieldCaptions"]["ExpParam"]["ExperimentatorID"]["4"]='ExperimentatorID';
  $_SESSION["SingleCaptions"]["ExpParam"][1]='ExpParam';
  $_SESSION["PluralCaptions"]["ExpParam"][1]='ExpParam';
  $_SESSION["SingleCaptions"]["ExpParam"][2]='ExpParam';
  $_SESSION["PluralCaptions"]["ExpParam"][2]='ExpParam';
  $_SESSION["SingleCaptions"]["ExpParam"][3]='ExpParam';
  $_SESSION["PluralCaptions"]["ExpParam"][3]='ExpParam';
  $_SESSION["SingleCaptions"]["ExpParam"][4]='ExpParam';
  $_SESSION["PluralCaptions"]["ExpParam"][4]='ExpParam';
};
function Get_ExpParam_SingleCaption(){
$LanguageID = $_SESSION["SystemSettings"]["LanguageID"];
return $_SESSION["SingleCaptions"]["ExpParam"][$LanguageID];
};

function Get_ExpParam_PluralCaption(){
$LanguageID = $_SESSION["SystemSettings"]["LanguageID"];
return $_SESSION["PluralCaptions"]["ExpParam"][$LanguageID];
};

function Get_ExpParam_FieldCaption($FieldName){
$LanguageID = $_SESSION["SystemSettings"]["LanguageID"];
return $_SESSION["FieldCaptions"]["ExpParam"][$FieldName][$LanguageID];
};

if (!isset($_SESSION["FieldCaptions"]["ExpParam"])) Set_ExpParam_FieldCaptions();

function Get_ExpParam_Experiment_FieldBackCaption($FieldName){ //back
$LanguageID = $_SESSION["SystemSettings"]["LanguageID"];
return $_SESSION["FieldBackCaptions"]["Experiment"][$FieldName][$LanguageID];
};

function Get_ExpParam_ExpParam_FieldBackCaption($FieldName){ //back
$LanguageID = $_SESSION["SystemSettings"]["LanguageID"];
return $_SESSION["FieldBackCaptions"]["ExpParam"][$FieldName][$LanguageID];
};

 
 ?>