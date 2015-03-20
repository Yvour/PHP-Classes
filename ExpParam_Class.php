<?php
 class ExpParam {
private $oExpParamID;//typebigint
private $oExpParamName;//typecharacter varying(36)
private $oExpParamValue;//typebigint
private $oExperimentatorID;//typebigint
//Constructor
function ExpParam($ExpParamID){
 Get_ExpParam_Connection();
 if ($ExpParamID > 0) { 
  $query = "f_Exp_ExpParam_SelectByID($ExpParamID::bigint)";
  $result = ExecuteExpParamQuery( $query) ;
  $line = pg_fetch_array($result, NULL, PGSQL_ASSOC) ;
  $this->oExpParamID = $line['oExpParamID'];
  $this->oExpParamName = $line['oExpParamName'];
  $this->oExpParamValue = $line['oExpParamValue'];
  $this->oExperimentatorID = $line['oExperimentatorID'];
 } else {$this->oExpParamID = 0;
} //of else
}
function DBCreate(){
 if ($this->oExpParamID === 0) { 
  $query = "select f_Exp_ExpParam_Insert(".
'"oExpParamName" := '.'\''.$this->oExpParamName.'\''.','. 
'"oExpParamValue" := '.$this->oExpParamValue.','. 
'"oExperimentatorID" := '.$this->oExperimentatorID.");";
  $result =  ExecuteExpParamQuery( $query) ;
  $line = pg_fetch_array($result, NULL, PGSQL_ASSOC) ;
   $this->oExpParamID =  $line['f_exp_expparam_insert'];
 }
}
function DBUpdate(){
 if ($this->oExpParamID > 0) { 
  $query = "select f_Exp_ExpParam_Update(".
'"oExpParamID" := '.$this->oExpParamID.','. 
'"oExpParamName" := '.'\''.$this->oExpParamName.'\''.','. 
'"oExpParamValue" := '.$this->oExpParamValue.','. 
'"oExperimentatorID" := '.$this->oExperimentatorID.");";
  $result = ExecuteExpParamQuery( $query) ;
  $line = pg_fetch_array($result, NULL, PGSQL_ASSOC) ;
   $this->ExpParamID =  $line['id'];
 }
}
function DBSave(){
 if ($this->oExpParamID > 0) { 
  $this->DBUpdate();
; } else
 if ($this->oExpParamID == 0) { 
  $this->DBCreate();
; } ;
}
//Setters and getters AND SAVERS!!!
 function getExpParamID(){
   return $this->oExpParamID;
  }//end of setoExpParamID

 function setExpParamName($value){
   $error = CheckValue(null, $value, 'character varying(36)');
   if ($error === ''){
     $this->oExpParamName = $value;
   } //of $error == ''
  }//end of setoExpParamName

 function saveExpParamName($value){
  if ($this->ExpParamID > 0) {
   $error = CheckValue(null, $value , 'character varying(36)');
   if ($error === ''){
     $query = "f_Exp_ExpParam_UpdateExpParamName(".$this->ExpParamID."::bigint,'".$value."'::character varying(36))";
     $result = ExecuteExpParamQuery( $query) ;
     $this->oExpParamName = $value;
   } //of $error == ''
   } //of if id > 0 == ''
  }//end of setoExpParamName

 function getExpParamName(){
   return $this->oExpParamName;
  }//end of setoExpParamName

 function setExpParamValue($value){
   $error = CheckValue(null, $value, 'bigint');
   if ($error === ''){
     $this->oExpParamValue = $value;
   } //of $error == ''
  }//end of setoExpParamValue

 function saveExpParamValue($value){
  if ($this->ExpParamID > 0) {
   $error = CheckValue(null, $value , 'bigint');
   if ($error === ''){
     $query = "f_Exp_ExpParam_UpdateExpParamValue(".$this->ExpParamID."::bigint,".$value."::bigint)";
     $result = ExecuteExpParamQuery( $query) ;
     $this->oExpParamValue = $value;
   } //of $error == ''
   } //of if id > 0 == ''
  }//end of setoExpParamValue

 function getExpParamValue(){
   return $this->oExpParamValue;
  }//end of setoExpParamValue

 function setExperimentatorID($value){
   $error = CheckValue(null, $value, 'bigint');
   if ($error === ''){
     $this->oExperimentatorID = $value;
   } //of $error == ''
  }//end of setoExperimentatorID

 function saveExperimentatorID($value){
  if ($this->ExpParamID > 0) {
   $error = CheckValue(null, $value , 'bigint');
   if ($error === ''){
     $query = "f_Exp_ExpParam_UpdateExperimentatorID(".$this->ExpParamID."::bigint,".$value."::bigint)";
     $result = ExecuteExpParamQuery( $query) ;
     $this->oExperimentatorID = $value;
   } //of $error == ''
   } //of if id > 0 == ''
  }//end of setoExperimentatorID

 function getExperimentatorID(){
   return $this->oExperimentatorID;
  }//end of setoExperimentatorID

};//end of class ExpParam 

?>
