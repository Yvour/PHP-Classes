<?php 
 if (!isset($_SESSION["SystemSettings"]["LanguageID"])) $_SESSION["SystemSettings"]["LanguageID"] = 4;//default

function Set_Experiment_FieldCaptions(){
$LanguageID = $_SESSION["SystemSettings"]["LanguageID"];
  $_SESSION["FieldCaptions"]["Experiment"]["ExperimentID"]["2"]='ExperimentID';
  $_SESSION["FieldCaptions"]["Experiment"]["ExperimentID"]["3"]='ExperimentID';
  $_SESSION["FieldCaptions"]["Experiment"]["ExperimentID"]["4"]='Эксперимент';
  $_SESSION["FieldCaptions"]["Experiment"]["ExperimentID"]["1"]='ExperimentID';
  $_SESSION["FieldCaptions"]["Experiment"]["ExperimentName"]["1"]='ExperimentName';
  $_SESSION["FieldCaptions"]["Experiment"]["ExperimentName"]["2"]='ExperimentName';
  $_SESSION["FieldCaptions"]["Experiment"]["ExperimentName"]["3"]='ExperimentName';
  $_SESSION["FieldCaptions"]["Experiment"]["ExperimentName"]["4"]='Имя эксперимента';
  $_SESSION["FieldCaptions"]["Experiment"]["IsDangeous"]["1"]='IsDangeous';
  $_SESSION["FieldCaptions"]["Experiment"]["IsDangeous"]["2"]='IsDangeous';
  $_SESSION["FieldCaptions"]["Experiment"]["IsDangeous"]["3"]='IsDangeous';
  $_SESSION["FieldCaptions"]["Experiment"]["IsDangeous"]["4"]='Опасность';
  $_SESSION["FieldCaptions"]["Experiment"]["ShortComment"]["1"]='ShortComment';
  $_SESSION["FieldCaptions"]["Experiment"]["ShortComment"]["2"]='ShortComment';
  $_SESSION["FieldCaptions"]["Experiment"]["ShortComment"]["3"]='ShortComment';
  $_SESSION["FieldCaptions"]["Experiment"]["ShortComment"]["4"]='Кр. комментарий';
  $_SESSION["FieldCaptions"]["Experiment"]["SecondComment"]["1"]='SecondComment';
  $_SESSION["FieldCaptions"]["Experiment"]["SecondComment"]["2"]='SecondComment';
  $_SESSION["FieldCaptions"]["Experiment"]["SecondComment"]["3"]='SecondComment';
  $_SESSION["FieldCaptions"]["Experiment"]["SecondComment"]["4"]='Второй комментарий';
  $_SESSION["FieldCaptions"]["Experiment"]["ThirdComment"]["1"]='ThirdComment';
  $_SESSION["FieldCaptions"]["Experiment"]["ThirdComment"]["2"]='ThirdComment';
  $_SESSION["FieldCaptions"]["Experiment"]["ThirdComment"]["3"]='ThirdComment';
  $_SESSION["FieldCaptions"]["Experiment"]["ThirdComment"]["4"]='Третий комментарий';
  $_SESSION["FieldCaptions"]["Experiment"]["FourthComment"]["1"]='FourthComment';
  $_SESSION["FieldCaptions"]["Experiment"]["FourthComment"]["2"]='FourthComment';
  $_SESSION["FieldCaptions"]["Experiment"]["FourthComment"]["3"]='FourthComment';
  $_SESSION["FieldCaptions"]["Experiment"]["FourthComment"]["4"]='Четвёртый комментарий';
  $_SESSION["FieldCaptions"]["Experiment"]["MainExperimentatorID"]["1"]='MainExperimentatorID';
  $_SESSION["FieldCaptions"]["Experiment"]["MainExperimentatorID"]["2"]='MainExperimentatorID';
  $_SESSION["FieldCaptions"]["Experiment"]["MainExperimentatorID"]["3"]='MainExperimentatorID';
  $_SESSION["FieldCaptions"]["Experiment"]["MainExperimentatorID"]["4"]='MainExperimentatorID';
  $_SESSION["SingleCaptions"]["Experiment"][1]='Experiment';
  $_SESSION["PluralCaptions"]["Experiment"][1]='Experiment';
  $_SESSION["SingleCaptions"]["Experiment"][2]='Experiment';
  $_SESSION["PluralCaptions"]["Experiment"][2]='Experiment';
  $_SESSION["SingleCaptions"]["Experiment"][3]='Experiment';
  $_SESSION["PluralCaptions"]["Experiment"][3]='Experiment';
  $_SESSION["SingleCaptions"]["Experiment"][4]='Эксперимент';
  $_SESSION["PluralCaptions"]["Experiment"][4]='Эксперименты';
};
function Get_Experiment_SingleCaption(){
$LanguageID = $_SESSION["SystemSettings"]["LanguageID"];
return $_SESSION["SingleCaptions"]["Experiment"][$LanguageID];
};

function Get_Experiment_PluralCaption(){
$LanguageID = $_SESSION["SystemSettings"]["LanguageID"];
return $_SESSION["PluralCaptions"]["Experiment"][$LanguageID];
};

function Get_Experiment_FieldCaption($FieldName){
$LanguageID = $_SESSION["SystemSettings"]["LanguageID"];
return $_SESSION["FieldCaptions"]["Experiment"][$FieldName][$LanguageID];
};

if (!isset($_SESSION["FieldCaptions"]["Experiment"])) Set_Experiment_FieldCaptions();

function Get_Experiment_Experiment_FieldBackCaption($FieldName){ //back
$LanguageID = $_SESSION["SystemSettings"]["LanguageID"];
return $_SESSION["FieldBackCaptions"]["Experiment"][$FieldName][$LanguageID];
};

function Get_Experiment_ExpParam_FieldBackCaption($FieldName){ //back
$LanguageID = $_SESSION["SystemSettings"]["LanguageID"];
return $_SESSION["FieldBackCaptions"]["ExpParam"][$FieldName][$LanguageID];
};

 
 ?>