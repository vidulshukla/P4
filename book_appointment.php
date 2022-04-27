<?php
   include("../config/config.php");
   $insert_stmt = $conn->prepare("insert into patient_appointment(pat_app_name,pat_app_gender,pat_app_dob,pat_app_bloodgrp,pat_app_mobno,pat_app_email,pat_app_addr,pat_app_city,pat_app_docid,pat_app_schid) values(?,?,?,?,?,?,?,?,?,?)");
   $insert_stmt->bind_param('ssssssssii',$_POST['patient_name'],$_POST['patient_gender'],$_POST['patient_dob'],$_POST['patient_bloodgrp'],$_POST['patient_contact'],$_POST['patient_email'],$_POST['patient_address'],$_POST['patient_city'],$_POST['dept'],$_POST['doctor']);
   $insert_stmt->execute();
   $insert_result = $insert_stmt->get_result();
   $insert_stmt->close();
   $conn->close();
?>

<html>
<head>
<title>Appointment</title>
</head>
<style> 
body {
    background: url("../images/form1.jpg");
    background-size: 1400px 700px;
    background-repeat: no-repeat;
    padding-top: 40px;
}
</style>
<body>
<img src="../images/logo.png" height="50px"></img><br>
<pre style="font-size:16;">
<h2><center>Patient Appointment Form</center></h2>
<?php
if(!$insert_result){
	echo "<center><b>You have successfully made appointment</b><center>";
}else{
	echo "<center><b>There was problem in making appointment.Please try again!!</b><center>";
}
?>
<form id="appointment">
<button value="Home" onclick="return goHome()">Home</button>
</form>
</body>
</html>

<script type="text/javascript">

function goHome(){
	document.getElementById("appointment").action="../index.html";
}
</script>