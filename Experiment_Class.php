<?php
 class Experiment {
private $oExperimentID;//typebigint
private $oExperimentName;//typecharacter varying(36)
private $oIsDangeous;//typeboolean
private $oShortComment;//typecharacter varying(144)
private $oSecondComment;//typecharacter varying(144)
private $oThirdComment;//typecharacter varying
private $oFourthComment;//typecharacter varying(144)
private $oMainExperimentatorID;//typebigint
//Constructor
function Experiment($ExperimentID){
 Get_Experiment_Connection();
 if ($ExperimentID > 0) { 
  $query = "f_Exp_Experiment_SelectByID($ExperimentID::bigint)";
  $result = ExecuteExperimentQuery( $query) ;
  $line = pg_fetch_array($result, NULL, PGSQL_ASSOC) ;
  $this->oExperimentID = $line['oExperimentID'];
  $this->oExperimentName = $line['oExperimentName'];
  $this->oIsDangeous = $line['oIsDangeous'];
  $this->oShortComment = $line['oShortComment'];
  $this->oSecondComment = $line['oSecondComment'];
  $this->oThirdComment = $line['oThirdComment'];
  $this->oFourthComment = $line['oFourthComment'];
  $this->oMainExperimentatorID = $line['oMainExperimentatorID'];
 } else {$this->oExperimentID = 0;
} //of else
}
function DBCreate(){
 if ($this->oExperimentID === 0) { 
  $query = "select f_Exp_Experiment_Insert(".
'"oExperimentName" := '.'\''.$this->oExperimentName.'\''.','. 
'"oIsDangeous" := '.'\''.$this->oIsDangeous.'\''.','. 
'"oShortComment" := '.'\''.$this->oShortComment.'\''.','. 
'"oSecondComment" := '.'\''.$this->oSecondComment.'\''.','. 
'"oThirdComment" := '.'\''.$this->oThirdComment.'\''.','. 
'"oFourthComment" := '.'\''.$this->oFourthComment.'\''.','. 
'"oMainExperimentatorID" := '.$this->oMainExperimentatorID.");";
  $result =  ExecuteExperimentQuery( $query) ;
  $line = pg_fetch_array($result, NULL, PGSQL_ASSOC) ;
   $this->oExperimentID =  $line['f_exp_experiment_insert'];
 }
}
function DBUpdate(){
 if ($this->oExperimentID > 0) { 
  $query = "select f_Exp_Experiment_Update(".
'"oExperimentID" := '.$this->oExperimentID.','. 
'"oExperimentName" := '.'\''.$this->oExperimentName.'\''.','. 
'"oIsDangeous" := '.'\''.$this->oIsDangeous.'\''.','. 
'"oShortComment" := '.'\''.$this->oShortComment.'\''.','. 
'"oSecondComment" := '.'\''.$this->oSecondComment.'\''.','. 
'"oThirdComment" := '.'\''.$this->oThirdComment.'\''.','. 
'"oFourthComment" := '.'\''.$this->oFourthComment.'\''.','. 
'"oMainExperimentatorID" := '.$this->oMainExperimentatorID.");";
  $result = ExecuteExperimentQuery( $query) ;
  $line = pg_fetch_array($result, NULL, PGSQL_ASSOC) ;
   $this->ExperimentID =  $line['id'];
 }
}
function DBSave(){
 if ($this->oExperimentID > 0) { 
  $this->DBUpdate();
; } else
 if ($this->oExperimentID == 0) { 
  $this->DBCreate();
; } ;
}
//Setters and getters AND SAVERS!!!
 function getExperimentID(){
   return $this->oExperimentID;
  }//end of setoExperimentID

 function setExperimentName($value){
   $error = CheckValue(null, $value, 'character varying(36)');
   if ($error === ''){
     $this->oExperimentName = $value;
   } //of $error == ''
  }//end of setoExperimentName

 function saveExperimentName($value){
  if ($this->ExperimentID > 0) {
   $error = CheckValue(null, $value , 'character varying(36)');
   if ($error === ''){
     $query = "f_Exp_Experiment_UpdateExperimentName(".$this->ExperimentID."::bigint,'".$value."'::character varying(36))";
     $result = ExecuteExperimentQuery( $query) ;
     $this->oExperimentName = $value;
   } //of $error == ''
   } //of if id > 0 == ''
  }//end of setoExperimentName

 function getExperimentName(){
   return $this->oExperimentName;
  }//end of setoExperimentName

 function setIsDangeous($value){
   $error = CheckValue(null, $value, 'boolean');
   if ($error === ''){
     $this->oIsDangeous = $value;
   } //of $error == ''
  }//end of setoIsDangeous

 function saveIsDangeous($value){
  if ($this->ExperimentID > 0) {
   $error = CheckValue(null, $value , 'boolean');
   if ($error === ''){
     $query = "f_Exp_Experiment_UpdateIsDangeous(".$this->ExperimentID."::bigint,'".$value."'::boolean)";
     $result = ExecuteExperimentQuery( $query) ;
     $this->oIsDangeous = $value;
   } //of $error == ''
   } //of if id > 0 == ''
  }//end of setoIsDangeous

 function getIsDangeous(){
   return $this->oIsDangeous;
  }//end of setoIsDangeous

 function setShortComment($value){
   $error = CheckValue(null, $value, 'character varying(144)');
   if ($error === ''){
     $this->oShortComment = $value;
   } //of $error == ''
  }//end of setoShortComment

 function saveShortComment($value){
  if ($this->ExperimentID > 0) {
   $error = CheckValue(null, $value , 'character varying(144)');
   if ($error === ''){
     $query = "f_Exp_Experiment_UpdateShortComment(".$this->ExperimentID."::bigint,'".$value."'::character varying(144))";
     $result = ExecuteExperimentQuery( $query) ;
     $this->oShortComment = $value;
   } //of $error == ''
   } //of if id > 0 == ''
  }//end of setoShortComment

 function getShortComment(){
   return $this->oShortComment;
  }//end of setoShortComment

 function setSecondComment($value){
   $error = CheckValue(null, $value, 'character varying(144)');
   if ($error === ''){
     $this->oSecondComment = $value;
   } //of $error == ''
  }//end of setoSecondComment

 function saveSecondComment($value){
  if ($this->ExperimentID > 0) {
   $error = CheckValue(null, $value , 'character varying(144)');
   if ($error === ''){
     $query = "f_Exp_Experiment_UpdateSecondComment(".$this->ExperimentID."::bigint,'".$value."'::character varying(144))";
     $result = ExecuteExperimentQuery( $query) ;
     $this->oSecondComment = $value;
   } //of $error == ''
   } //of if id > 0 == ''
  }//end of setoSecondComment

 function getSecondComment(){
   return $this->oSecondComment;
  }//end of setoSecondComment

 function setThirdComment($value){
   $error = CheckValue(null, $value, 'character varying');
   if ($error === ''){
     $this->oThirdComment = $value;
   } //of $error == ''
  }//end of setoThirdComment

 function saveThirdComment($value){
  if ($this->ExperimentID > 0) {
   $error = CheckValue(null, $value , 'character varying');
   if ($error === ''){
     $query = "f_Exp_Experiment_UpdateThirdComment(".$this->ExperimentID."::bigint,'".$value."'::character varying)";
     $result = ExecuteExperimentQuery( $query) ;
     $this->oThirdComment = $value;
   } //of $error == ''
   } //of if id > 0 == ''
  }//end of setoThirdComment

 function getThirdComment(){
   return $this->oThirdComment;
  }//end of setoThirdComment

 function setFourthComment($value){
   $error = CheckValue(null, $value, 'character varying(144)');
   if ($error === ''){
     $this->oFourthComment = $value;
   } //of $error == ''
  }//end of setoFourthComment

 function saveFourthComment($value){
  if ($this->ExperimentID > 0) {
   $error = CheckValue(null, $value , 'character varying(144)');
   if ($error === ''){
     $query = "f_Exp_Experiment_UpdateFourthComment(".$this->ExperimentID."::bigint,'".$value."'::character varying(144))";
     $result = ExecuteExperimentQuery( $query) ;
     $this->oFourthComment = $value;
   } //of $error == ''
   } //of if id > 0 == ''
  }//end of setoFourthComment

 function getFourthComment(){
   return $this->oFourthComment;
  }//end of setoFourthComment

 function setMainExperimentatorID($value){
   $error = CheckValue(null, $value, 'bigint');
   if ($error === ''){
     $this->oMainExperimentatorID = $value;
   } //of $error == ''
  }//end of setoMainExperimentatorID

 function saveMainExperimentatorID($value){
  if ($this->ExperimentID > 0) {
   $error = CheckValue(null, $value , 'bigint');
   if ($error === ''){
     $query = "f_Exp_Experiment_UpdateMainExperimentatorID(".$this->ExperimentID."::bigint,".$value."::bigint)";
     $result = ExecuteExperimentQuery( $query) ;
     $this->oMainExperimentatorID = $value;
   } //of $error == ''
   } //of if id > 0 == ''
  }//end of setoMainExperimentatorID

 function getMainExperimentatorID(){
   return $this->oMainExperimentatorID;
  }//end of setoMainExperimentatorID

};//end of class Experiment 

?>
