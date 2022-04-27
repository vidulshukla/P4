<?php
   include("../config/config.php");
   $doc_id=$_GET['doc_id'];
   $app_date=$_GET['app_date'];
   $day=date('l',strtotime($app_date));
   $app_sql = "SELECT doc_sch_id,doc_sch_time FROM doctors_schedule a,doctors b where a.doc_sch_doc=b.doc_id and b.doc_id=? and a.doc_sch_day=?";
   $app_stmt=$conn->prepare($app_sql);
   $app_stmt->bind_param('is',$doc_id,$day);
   $app_stmt->execute();   
   $app_stmt->bind_result($app_id,$app_time);
   mysqli_stmt_store_result($app_stmt);
   $no_of_rows=mysqli_stmt_num_rows($app_stmt);
   echo "<select name='appointment_time'>";
   if($no_of_rows > 0){
	echo "<option value='-1'>Choose</option>";
	while($app_stmt->fetch()){
	   echo "<option value=".$app_id.">".$app_time."</option>";
    }   
   }else{
	echo "<option value=''>Doctor Not available</option>";
   }
   echo "</select>";
   $app_stmt->close();
   $conn->close();
?>