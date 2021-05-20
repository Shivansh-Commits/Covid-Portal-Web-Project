<html>
<head>
 
</head> 
<body>
   <div class=heading_div> 

      <p>
        <b> 
        	<a id=heading href="index.html">Covid Portal</a> 
            <a class=nav_panel id=nav_link_1 href="https://dashboard.cowin.gov.in/">Covid Stats</a> 
            <a class=nav_panel id=nav_link_2 href="https://dashboard.cowin.gov.in/">Vaccinatoin Stats</a>  
       </b>
       <div style="background-color: grey;height: 8px;margin-top:18px"><p></p></div>
      </p>
       
    </div>

    <style>
    	body 
    {
      background-image: url("pic1.jpg");
      background-size: cover;
      margin-top: 0px;
      margin-right: 0px;
      margin-bottom: 0px;
      margin-left: 0px  
    }
    #heading
    {
      text-decoration: none;
      color: black;
      font-family: Helvetica;
      font-size: 70px;
      padding:13px;
    }

   .nav_panel
    {
      text-decoration: none;
      color: black;
      font-family: Helvetica;
      padding:13px;
      text-align: center;
    }

   #nav_link_1
    {
      float:right;
    }
    #nav_link_2
    {
      float:right;
    }


    .heading_div
    {
     width: 100%;
     height: 15%;
     background-color: #ffffff;
     padding-top: 2px;
    }

    table
    {
    	border:4px solid black;
    	border-radius: 6px;
    	font-family: Helvetica;
    	border-collapse: collapse;
       	margin-left: 290px;
       	width: 800px;
    	background-color: rgba(45, 41, 45, 0.7) ;
    	overflow: hidden;
    }
    td
    {
    border: 2px solid black;
    padding:20px;
    color:white;
    }
    th
    {
    border: 2px solid black;
    padding:10px;
    font-size: 16px;
    color:lightgrey;

    }

    #table_heading_text
    {
    	font-family: Helvetica;
    	font-size: 40px;
    	margin-left: 490px;
    	margin-top: 50px;
    	
    }
     #record_not_available
    {
    	font-family:Helvetica; 
    	font-size: 30px;
    	margin-top: 50px;
    	margin-left: 300px;
    	width: 800px;
    	padding: 10px;
    	background-color: rgba(45, 41, 45, 0.7);
    	border:4px solid black;
    	border-radius: 4px;
    }
    
    </style>

<?php

$username="root";
$password="";
$database="covid_portal";
$con=mysqli_connect('localhost',$username,$password,$database) or die("Connection Failed". mysqli_connect_error());

$f_name = $_REQUEST['first_name'];
$l_name = $_REQUEST['last_name'];
$age = $_REQUEST['age'];
$contact_no = $_REQUEST['contact_no'];
$blood_group =strtolower($_REQUEST['blood_group']);
$location = @unserialize (file_get_contents('http://ip-api.com/php/'));
if($location && $location['status'] == 'success') 
{
	$city = $location['city'];
}
else
echo("Please enable location services and reload the Page and try Again");

$insert_query="INSERT INTO blood_donors( first_name, last_name, age, blood_group, city, contact_no) VALUES ('$f_name', '$l_name' , '$age' , '$blood_group' , '$city' ,'$contact_no' )";
$result_1=mysqli_query($con,$insert_query);

if($result_1 === TRUE)
	echo '';
else
 echo "Error" . $insert_query . "<br/>" . $con->error;

//blood seekers table

echo "<table>";
$result = mysqli_query($con,"SELECT id, first_name, last_name, age,blood_group, city,contact_no FROM blood_seekers WHERE blood_group='$blood_group' AND city='$city' ");
if(mysqli_num_rows($result)==0)
{
	echo "<div id=record_not_available><span>Currently No Patients in our Data base Require Plasma</span></div>";
}
else
{
	echo "<th>First name</th> <th>Last name</th> <th>Age</th> <th>Blood Group</th> <th>City</th> <th>Contact No.</th>";	
	echo "<div id=table_heading_text><span>People You Can Donate</span></div>";
	echo "<br>";
	while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{	echo "<tr>";
			echo "<td>";
			echo $row['first_name'];
			echo "</td>";
			echo "<td>";
			echo $row['last_name'];
			echo "</td>";
			echo "<td>";
			echo $row['age'];
			echo "</td>";
			echo "<td>";
			echo $row['blood_group'];
			echo "</td>";
			echo "<td>";
			echo $row['city'];
			echo "</td>";
			echo "<td>";
			echo $row['contact_no'];
			echo "</td>";
			echo "</tr>";
		}
		echo "<br>";
}

echo"</table>";

mysqli_close($con);

?>


</body>
</html>