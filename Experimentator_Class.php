<?php
 class Experimentator {
private $oExperimentatorID;//typebigint
private $oExperimentatorName;//typecharacter varying(144)
 private $yExpParamSet ;//array of ExpParam
//Constructor
function Experimentator($ExperimentatorID){
 Get_Experimentator_Connection();
 if ($ExperimentatorID > 0) { 
  $query = "f_Exp_Experimentator_SelectByID($ExperimentatorID::bigint)";
  $result = ExecuteExperimentatorQuery( $query) ;
  $line = pg_fetch_array($result, NULL, PGSQL_ASSOC) ;
  $this->oExperimentatorID = $line['oExperimentatorID'];
  $this->oExperimentatorName = $line['oExperimentatorName'];
  $this->yExpParamSet = array() ;//array of ExpParam
  $query = 'select * from f_Exp_ExpParam_SelectListByExperimentatorID('.$ExperimentatorID.')';  $this->yExpParamSet = array() ;//array of ExpParam
  $result = ExecuteExperimentatorQuery( $query) ;
 while( $line = pg_fetch_array($result, NULL, PGSQL_ASSOC)) {
 $yExpParamSet[] = new ExpParam($line["ExpParamID"]);
 };
 } else {$this->oExperimentatorID = 0;
  $this->yExpParamSet = array() ;//array of ExpParam
} //of else
}
function DBCreate(){
 if ($this->oExperimentatorID === 0) { 
  $query = "select f_Exp_Experimentator_Insert(".
'"oExperimentatorName" := '.'\''.$this->oExperimentatorName.'\''.");";
  $result =  ExecuteExperimentatorQuery( $query) ;
  $line = pg_fetch_array($result, NULL, PGSQL_ASSOC) ;
   $this->oExperimentatorID =  $line['f_exp_experimentator_insert'];
 }
}
function DBUpdate(){
 if ($this->oExperimentatorID > 0) { 
  $query = "select f_Exp_Experimentator_Update(".
'"oExperimentatorID" := '.$this->oExperimentatorID.','. 
'"oExperimentatorName" := '.'\''.$this->oExperimentatorName.'\''.");";
  $result = ExecuteExperimentatorQuery( $query) ;
  $line = pg_fetch_array($result, NULL, PGSQL_ASSOC) ;
   $this->ExperimentatorID =  $line['id'];
 }
}
function DBSave(){
 if ($this->oExperimentatorID > 0) { 
  $this->DBUpdate();
; } else
 if ($this->oExperimentatorID == 0) { 
  $this->DBCreate();
; } ;
}
//Setters and getters AND SAVERS!!!
 function getExperimentatorID(){
   return $this->oExperimentatorID;
  }//end of setoExperimentatorID

 function setExperimentatorName($value){
   $error = CheckValue(null, $value, 'character varying(144)');
   if ($error === ''){
     $this->oExperimentatorName = $value;
   } //of $error == ''
  }//end of setoExperimentatorName

 function saveExperimentatorName($value){
  if ($this->ExperimentatorID > 0) {
   $error = CheckValue(null, $value , 'character varying(144)');
   if ($error === ''){
     $query = "f_Exp_Experimentator_UpdateExperimentatorName(".$this->ExperimentatorID."::bigint,'".$value."'::character varying(144))";
     $result = ExecuteExperimentatorQuery( $query) ;
     $this->oExperimentatorName = $value;
   } //of $error == ''
   } //of if id > 0 == ''
  }//end of setoExperimentatorName

 function getExperimentatorName(){
   return $this->oExperimentatorName;
  }//end of setoExperimentatorName

};//end of class Experimentator 

?>
