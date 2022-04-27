<?php
   include("../config/config.php");
   $dep_sql = "SELECT dept_id,dept_name FROM departments";
   $dep_result = $conn->query($dep_sql);
?>

<html>
<head>

<title>Appointment</title>
<img src="../images/logo.png" height="50px"></img>
</head>
<style> 
body {
    background: url("../images/form1.jpg");
    background-size: 100% 100%;
    background-repeat: no-repeat;
    padding-top: 40px;
}
</style>


<body>
<h2><center>Patient Appointment Form</center></h2>
<br>
<form name="appointment" id="appointment" method="POST">
<fieldset>
<legend><b>Personal Details</b></legend>
<table border="0" align="left" width="100%">
<tr align="left">
<th><b>Name of Patient:</b></th>
<th>
<div>
<input type="text" name="patient_name" value="">
</div>
</th>
<th><b>Gender:</th>
<th>
<div>
<input type="radio" name="patient_gender" value="M">Male
<input type="radio" name="patient_gender" value="F">Female
<input type="radio" name="patient_gender" value="O">Other
</div>
</th>
<th><b>DoB:</b></th>
<th>
<div>
<input type="date" name="patient_dob">
</div>
</th>
</tr>
<tr align="left">
<th>
<div>
<br>
<b>Blood Group:</b>
</div>
</th>
<th>
<div>
<br>
<input type="character" size="4" name="patient_bloodgrp">
</div>
</th>
<th>
<div>
<br>
<b>Mobile Number:</b>
</div>
</th>
<th>
<div>
<br>
<input type="text" name="patient_contact" value="" size="10">
</div>
</th>
<th>
<div>
<br>
<b>E-mail:</b>
</div>
</th>
<th>
<div>
<br>
<input type="text" name="patient_email" value="">
</div>
</th>
</tr>
<tr align="left">
<th>
<div>
<br>
<b>Address:</b>
</div>
</th>
<th>
<div>
<br>
<textarea name="patient_address" rows="2" cols="25"></textarea>
</div>
</th>
<th>
<div>
<br>
<b>City:</b>
</div>
</th>
<th>
<div>
<br>
<input type="text" name="patient_city" value="">
</div>
</th>
</tr>
</table>
</fieldset>
<fieldset>
<legend><b>Select your doctor</legend>
<table border="0" align="left" width="100%">
<tr align="left">
<th><b>Department:</b></th>
<th><select name="dept" onchange="populateDoc(this.value)">
<option value="-1">Choose</option>

<?php
	if($dep_result>0){
		while($dept=$dep_result->fetch_assoc()){
			echo "<option value=".$dept['dept_id'].">".$dept['dept_name']."</option>";
		}
	}
?>
</select>
</tr>
<tr align="left">
<th>
<div>
<br>
<b>Doctor:</b>
</div>
</th>
<th>
<br>
<div id="doc">
<select name="doctor">
<option value='-1'>Choose</option>
</select>
</div>
</th>
</tr>
<tr align="left">
<th>
<div>
<br>
<b>Preferred Date of Appointment:</b>
</div>
</th>
<th>
<div>
<br>
<input type="date" name="app_date" onchange="populateTime(this.value)">
</div>
</th>
</tr>
<tr align="left">
<th>
<div>
<br>
<b>Appointment Time:</b>
</div>
</th>
<th>
<br>
<div id="app_time">
<select name="appointment_time">
<option value='-1'>Choose</option>
</select>
</div>
</tr>
</table>
</fieldset>
<br><br>
<table border="0" align="center" width="25%">
<tr align="center">
<th><button value="submit" onclick="return validateForm()">Submit</button></th>
<th><input type="Reset" value="Reset"></th>
<th><button value="back" onclick="return goBack()"> Back </button></th>
</tr>
</table>
</form>
</body>

</html>
<script type="text/javascript">

function goBack() {
    document.getElementById("appointment").action="../index.html";
}

function populateDoc(dept) 
{
    if (dept == "") {
        document.getElementById("doc").innerHTML = "No doctors available";
        return;
    } else { 
        if (window.XMLHttpRequest) 
	{
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("doc").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","doctors.php?dept_id="+dept,true);
        xmlhttp.send();
    }
}

function populateTime(app_date) {
	var doc_id=document.appointment.doctor.value;
    if (app_date == "") {
        document.getElementById("app_time").innerHTML = "No Appointment time available";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("app_time").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","appointment_time.php?doc_id="+doc_id+"&app_date="+app_date,true);
        xmlhttp.send();
    }
}

function validateForm()
{
	if(document.appointment.patient_name.value=="")
	{ 
	alert("Name must be filled out");
	document.appointment.patient_name.focus();
	return false; 
	}

	if(document.appointment.patient_gender.value=="")
	{ 
	alert("Gender must be filled out");
	return false; 
	}

	if(document.appointment.patient_dob.value=="")
	{ 
	alert("DoB must be filled out");
	document.appointment.patient_dob.focus();
	return false; 
	}

	var x=document.appointment.patient_contact.value;
	if(x="" || x.length!=10)
	{
	alert("Enter correct mobile number.");
	document.appointment.patient_contact.focus();
	return false;
	}

	var x=document.appointment.patient_email.value;
	atpos=x.indexOf("@");
	dotpos=x.lastIndexOf(".");
	if(x=="" || atpos<1 || dotpos-atpos<2)
	{
	alert("Enter correct email id");
	document.appointment.patient_email.focus();
	return false;
	}

	if(document.appointment.patient_address.value=="")
	{ 
	alert("Address must be filled out");
	document.appointment.patient_address.focus();
	return false; 
	}

	if(document.appointment.patient_city.value=="")
	{ 
	alert("City must be filled out");
	document.appointment.patient_city.focus();
	return false; 
	}

	if(document.appointment.dept.value==-1)
	{
	alert("Select Department");
	document.appointment.dept.focus();
	return false;
	}
	
	if(document.appointment.doctor.value==-1)
	{
	alert("Select Doctor");
	document.appointment.doctor.focus();
	return false;
	}

	if(document.appointment.app_date.value=="")
	{ 
	alert("Appointment Date must be filled out");
	document.appointment.app_date.focus();
	return false; 
	}

	if(document.appointment.appointment_time.value=="")
	{ 
	alert("Appointment Time must be filled out");
	document.appointment.appointment_time.focus();
	return false; 
	}

	document.getElementById("appointment").action="book_appointment.php";
}
</script>