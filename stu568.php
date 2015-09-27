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
		<div class="options" id="upload_pic" style="left:5px;" data-toggle="tooltip" data-placement="left" title="Profile pic"><i class="fa fa-camera"></i></div>
		<div class="options" id="global_post_button" style="left:50px;" data-toggle="tooltip" data-placement="bottom" title="Status"><i class="fa fa-pencil-square-o"></i></div>
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
		<div class="nav col-md-2" block="global" style="padding:15px">
			Global Post
		</div>
		<div class="nav col-md-2" block="friends" style="padding:15px">
			Friends List
		</div>
		<div class="nav col-md-3" block="request" style="padding:15px">
			Friend &nbsp Requests 
		</div>
		<div class="col-md-offset-1 col-md-2" style="padding:15px;padding-top:20px;">
			<a href="logout.php">LOGOUT</a>
		</div>
	</div>
<!-------------------------------------Personal post------------------------------------->
	<div id="personal" class="mid_block">
		<?php
		echo "<div class='container-fluid'>";
			$query=mysql_query("SELECT * FROM post ORDER BY sno DESC");
			while($query_res=mysql_fetch_assoc($query))
			{
				if(mysql_num_rows(mysql_query("SELECT * FROM friends WHERE ((`from`='".$query_res['from']."' AND `to`='".$res['id']."') OR (`to`='".$query_res['from']."' AND `from`='".$res['id']."')) AND `status`='y'"))||$query_res['from']==$res['id'])
				{
					$name=mysql_fetch_assoc(mysql_query("SELECT * FROM login_details WHERE `id`='".$query_res['from']."'"));
					echo "<div class='col-md-offset-1 col-md-10 post_wrapper'>
					<div class='col-md-8 post_info'>
						<img class='col-md-2'src='pic.php?type=post&post_id=".$query_res['from']."' style='max-height:50px;'>
						<div class='col-md-9' style='padding-top:20px;font-size:20px;'>".$name['first_name']." ".$name['middle_name']." ".$name['last_name']."</div>
					</div>
					<div class='col-md-12 post'>";
					if($query_res['image']!=null){
					echo"<div class='image col-md-6'>
						<img  style='min-height:250px;max-width:100%;' src='pic.php?type=post&sno=".$query_res['sno']."'>
					</div>";
					}
					echo"<div class='col-md-6 message'>".$query_res['post']."</div>
					</div>
					</div>";
				}
			}
			echo "</div>";
		?>
	</div>
<!-------------------------------------global post------------------------------------->	
	<div id="global" class="mid_block">
		<?php
		echo "<div class='container-fluid'>";
			$query=mysql_query("SELECT * FROM global_post ORDER BY sno DESC");
			while($query_res=mysql_fetch_assoc($query))
			{
				
					$name=mysql_fetch_assoc(mysql_query("SELECT * FROM login_details WHERE `id`='".$query_res['from']."'"));
					echo "<div class='col-md-offset-1 col-md-10 post_wrapper'>
					<div class='col-md-8 post_info'>
						<img class='col-md-2' src='pic.php?type=post&post_id=".$query_res['from']."' style='max-height:50px;'>
						<div class='col-md-9' style='padding-top:20px;font-size:20px;'>".$name['first_name']." ".$name['middle_name']." ".$name['last_name']."</div>
					</div>
					<div class='col-md-12 post'>";
					if($query_res['image']!=null){
					echo"<div class='image col-md-6'>
						<img  style='min-height:250px;max-width:100%;' src='pic.php?type=global_post&sno=".$query_res['sno']."'>
					</div>";
					}
					echo"<div class='col-md-6 message'>".$query_res['post']."
					</div>
					</div>
					</div>";
				
			}
			echo "</div>";
		?>
	</div>
<!-------------------------------------Friends List------------------------------------>
	<div id="friends" class="mid_block">
	<?php
		$query_res=mysql_query("SELECT DISTINCT * FROM  friends WHERE (`from`='".$res['id']."' OR `to`='".$res['id']."') AND `status`='y'");
		while($res_query=mysql_fetch_assoc($query_res))
		{
			if($res_query['from']==$res['id'])
			{
				$frnd_sno=mysql_fetch_assoc(mysql_query("SELECT * FROM login_details WHERE id='".$res_query['to']."'"));
				echo "<div class='col-md-3 request_block'>
			
			<div style='height:90px;width:90px;overflow:hidden;'>
			<img src='pic.php?id=".$frnd_sno['sno']."' class='img-responsive' width='100%' height='100%' >
			</div>
			<div style='font-size:18px;'>".$frnd_sno['first_name']." ".$frnd_sno['middle_name']." ".$frnd_sno['last_name']."</div>
			<div>(".$frnd_sno['id'].")</div>
			</div>";
			}
			else{
				$frnd_sno=mysql_fetch_assoc(mysql_query("SELECT * FROM login_details WHERE id='".$res_query['from']."'"));
				echo "<div class='col-md-3 request_block'>
			<div style='height:90px;width:90px;overflow:hidden;'>";
			if($frnd_sno['dp']!=NULL)
			{
				echo "<img src='pic.php?id=".$frnd_sno['sno']."' class='img-responsive' width='100%' height='100%' >";
			}
			else
			{
				echo "<img src='res/default_profile.jpg' class='img-responsive' width='100%' height='100%' >";
			}
			echo "</div>
			<div style='font-size:18px;'>".$frnd_sno['first_name']." ".$frnd_sno['middle_name']." ".$frnd_sno['last_name']."</div>
			<div>(".$frnd_sno['id'].")</div>
			</div>";
			}
			
		}
	?>
	</div>
<!-------------------------------------Request List------------------------------------>
	<div id="request" class="mid_block">
	<?php
		$query_res=mysql_query("SELECT DISTINCT * FROM  friends WHERE `to`='".$res['id']."' AND `status`='n'");
		while($res_query=mysql_fetch_assoc($query_res))
		{
			if($res_query['from']==$res['id'])
			{
				$frnd_sno=mysql_fetch_assoc(mysql_query("SELECT * FROM login_details WHERE id='".$res_query['to']."'"));
				echo "<div class='col-md-3 request_block'>
			
			<div style='height:90px;width:90px;overflow:hidden;'>
			<img src='pic.php?id=".$frnd_sno['sno']."' class='img-responsive' width='100%' height='100%' >
			</div>
			<div style='font-size:18px;'>".$frnd_sno['first_name']." ".$frnd_sno['middle_name']." ".$frnd_sno['last_name']."</div>
			<div>(".$frnd_sno['id'].")</div>
			</div>
			<div class='reply col-md-3'>jkjsd</div>
			";
			}
			else{
				$frnd_sno=mysql_fetch_assoc(mysql_query("SELECT * FROM login_details WHERE id='".$res_query['from']."'"));
				echo "<div class='col-md-3 request_block'>
				<div style='z-index:1;'>
			<div style='height:90px;width:90px;overflow:hidden;'>";
			if($frnd_sno['dp']!=NULL)
			{
				echo "<img src='pic.php?id=".$frnd_sno['sno']."' class='img-responsive' width='100%' height='100%' >";
			}
			else
			{
				echo "<img src='res/default_profile.jpg' class='img-responsive' width='100%' height='100%' >";
			}
			echo "</div>
			<div style='font-size:18px;'>".$frnd_sno['first_name']." ".$frnd_sno['middle_name']." ".$frnd_sno['last_name']."</div>
			<div>(".$frnd_sno['id'].")</div>
			</div>
			<div class='col-md-12 reply'>
			<div class='col-md-12'style='height:100%;z-index:1; position:absolute;top:0px;left:0px;background-color:black;opacity:0.3;'></div>
			<div class='col-md-12'style='height:100%;z-index:2; position:absolute;top:0px;left:0px;padding:50px;padding-left:70px;'>
			<div class='col-md-12'><i class='fa fa-times ' data-toggle='tooltip' data-placement='right' title='Accept'></i></div>
			<div class='col-md-12'><i class='fa fa-check ' data-toggle='tooltip' data-placement='right' title='reject'></i></div>
			</div>
			</div>
			</div>
			
			";
			}
			
		}
	?>
	</div>
</div>
</div>
</div>
<div id="create_post" class="col-md-2">
		<form action="post.php" method="post" enctype="multipart/form-data">
			<input type="text" name="post_text" placeholder="post something....">
			<input type="file" name="post_file">
			<input type="text" value="personal" name="type" style="display:none;">
			<input type="submit" name="post_submit">
		</form>
</div>
<div id="create_global_post" class="col-md-2">
		<form action="post.php" method="post" enctype="multipart/form-data">
			<input type="text" name="post_text" placeholder="post something....">
			<input type="file" name="post_file">
			<input type="text" value="global" name="type" style="display:none;">
			<input type="submit" name="post_submit">
		</form>
</div>
<div id="pic_post" class="col-md-2">
		<form action="post.php" method="post" enctype="multipart/form-data">
			<input type="file" name="post_pic">
			<input type="text" value="<?php echo $sno;?>" name="sno" style="display:none;">
			<input type="submit" name="upload_pic_submit">
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