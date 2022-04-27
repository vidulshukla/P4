<?xsl version="1.0" encoding="UTP-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:template match="/">
<html>
	<head><center><h2>CONTACT US</h2> </center></head>	
	<style type="text/css"> 
		body
			{
			background-image:url("map6.png");  
			background-repeat: no-repeat;
			background-size: 100% 100%;
			}	
	
		table 	{
    			font-family: arial, sans-serif;
    			border-collapse: collapse;
    			width: 100%;
			}

		td, th 	{
    			border: 1px solid #dddddd;
    			text-align: left;
    			padding: 8px;
			}

	tr:nth-child(even){
    			background-color: #dddddd;
			}

	
	</style>
	<body> 
	
		<center>
		<table border="1">
			<tr bgcolor="#41C5AF">
				<th style="text-align:center"  >Branch Name</th>
      				<th style="text-align:center" >Address</th>
				<th style="text-align:center" >Contact no.</th>
				<th style="text-align:center" >Fax no.</th>
				<th style="text-align:center" >Email-id</th>
			</tr>
			<xsl:for-each select="details/branch">
    				<tr bgcolor="#41C5AF">
      					<td><xsl:value-of select="name"/></td> 
      					<td><xsl:value-of select="add"/></td>
					<td><xsl:value-of select="cont"/></td>
					<td><xsl:value-of select="fax"/></td>
					<td><xsl:value-of select="mail"/></td>
    				</tr>
    			</xsl:for-each>
		</table>
		</center>
	</body>
</html>
</xsl:template>
</xsl:stylesheet>