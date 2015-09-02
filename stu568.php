<?php
session_start();
include 'minimum_log.php';
if(isset($_SESSION['sno']))
{
	
?>
<html>
<head>
	<link rel="stylesheet" href="bootstrap-3.2.0-dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/student.css">
</head>
<body>
<div id="profile" >
	<div id="rollno_holder">
		<div style="width:100%;height:5px;background-color:#00ccaa;"></div>
		<div id="roll_number" ><b>
		<?php
			$sno=$_SESSION['sno'];
			$query=mysql_query("SELECT * FROM login_details WHERE sno='$sno'");
			$res=mysql_fetch_assoc($query);
			echo $res['id'];
		?>
		</b></div>
	</div>
	<div id="profile_pic"><img src="pic.php?id=<?php echo $sno;?>" width="250px" height="250px"></div>
	<div id="name"><?php echo $res['first_name']." ".$res['middle_name']." ".$res['last_name'];?></div>
	<div style="position:relative;top:100px;left:75px;height:5px;width:150px;background-color:#00ccaa;"></div>
	<div id="department">
		<?php echo $res['section'];?>
	</div>
	<div id="wrapper">
		<div class="options" style="left:5px;" data-toggle="tooltip" data-placement="left" title="Profile pic"><i class="fa fa-camera"></i></div>
		<div class="options" style="left:50px;" data-toggle="tooltip" data-placement="bottom" title="Status"><i class="fa fa-pencil-square-o"></i></div>
		<div class="options" id="post_button"style="left:95px;" data-toggle="tooltip" data-placement="bottom" title="Post something"><i class="fa fa-plus"></i></div>
	</div>
	<div class="line_green"></div>
</div
<!----------------------------------------POST------------------------------------------>
<div class="container-fluid">
<div class="row">
<div id="post" class="col-md-7">
	<div class="line_green " style="width:90%;margin:0% 5% 0%;left:0px;top:0px;"></div>
	<div class="row" style="background-color:rgb(36,52,83);">
		<div class="nav col-md-2" block="personal" style="padding:15px">
			Personal Post
		</div>
		<!-------------<div class="nav col-md-2" block="global" style="padding:15px">
			Global Post
		</div>-------->
		<div class="nav col-md-2" block="friends" style="padding:15px">
			Friends List
		</div>
		<div class="nav col-md-3" block="request" style="padding:15px">
			Friend &nbsp Requests 
		</div>
		<div class="col-md-offset-3 col-md-2" style="padding:15px">
			<a href="logout.php">LOGOUT</a>
		</div>
	</div>
<!-------------------------------------Personal post------------------------------------->
	<div id="personal" class="post mid_block">
	</div>
<!-------------------------------------global post------------------------------------->	
	<div id="global" class="post mid_block"></div>
<!-------------------------------------Friends List------------------------------------>
	<div id="friends" class="mid_block">
	<?php
		$query_res=mysql_query("SELECT DISTINCT * FROM  friends WHERE (`from`='".$res['id']."' OR `to`='".$res['id']."') AND ()");
		while($res_query=mysql_fetch_assoc($query_res))
		{
			$frnd_sno=mysql_fetch_assoc(mysql_query("SELECT * FROM login_details WHERE (`id`<>'".$res['id']."') AND (`id`='".$res_query['from']."' OR `id`='".$res_query['to']."')"));
			echo "<div class='col-md-3 request_block'>
			<div>".$res_query['from']."</div>
			<div style='height:120px;width:120px;overflow:hidden;'>
			<img src='pic.php?id=".$frnd_sno['sno']."' class='img-responsive' width='100%' height='100%' >
			</div>
			</div>";
		}
	?>
	</div>
<!-------------------------------------Request List------------------------------------>
	<div id="request" class="mid_block">
	<?php
	?>
	</div>
</div>
</div>
</div>
<div id="create_post" class="col-md-2">
		<form action="post.php" method="post" enctype="multipart/form-data">
			<input type="text" name="post_text" placeholder="post something....">
			<input type="file" name="post_file">
			<input type="text" value="<?php echo $sno;?>" name="sno" style="display:none;">
			<input type="submit" name="post_submit">
		</form>
	</div>
<div id="chat"></div>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="bootstrap-3.2.0-dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/student.js"></script>
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>
</body>
</html>
<?php
}
else{
	header('Location: index.php');
}
?>