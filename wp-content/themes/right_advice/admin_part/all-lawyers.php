<?php include("admin_header.php"); ?>

<div class="" style="margin:5% 2%">
<h3>All Lawyers <br> <!--<br><a href="add-lawyer.php" class="btn btn-info">Add New Lawyer</a>--> </h3>
<?php if(isset($_SESSION['reg_error']) && $_SESSION['reg_error'] != ''){?>
<div class="alert alert-danger col-md-12 data-dismisable"> 
	<i class="fa fa-info"></i><?=$_SESSION['reg_error']?><?php unset($_SESSION['reg_error']);?>
</div>
<?php } else if(isset($_SESSION['reg_succ']) && $_SESSION['reg_succ'] != ''){?>
<div class="alert alert-success col-md-12 data-dismisable"> 
	<i class="glyphicon glyphicon-thumbs-up"></i><?=$_SESSION['reg_succ']?><?php unset($_SESSION['reg_succ']);?>
</div>
<?php } ?>
<table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th>#</th>
			<th>Name</th>
			<th>Email</th>
			<th>Status</th>
			<th>Added On</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	<?php 
		$sno = 0;
		$query = mysql_query("select * from ra_lawyers order by added_date desc") or die(mysql_error());
		while($rows = mysql_fetch_assoc($query)){
			$sno++;
	?>
		<tr id="item_<?=$rows['id']?>">
			<td><?=$sno?></td>
			<td><?=$rows['full_name']?></td>
			<td><?=$rows['email']?></td>
			<td>
				<?php if($rows['status'] == 0){ ?>
					<span class="label label-danger" id="status_<?=$rows['id']?>" onclick="changeLawyerStatus('1','<?=$rows['id']?>','<?=$rows['email']?>')" style="cursor:pointer">Approve</span>
				<?php }else if($rows['status'] == 1){?>
					<span class="label label-success" id="status_<?=$rows['id']?>" onclick="changeLawyerStatus('0','<?=$rows['id']?>','<?=$rows['email']?>')" style="cursor:pointer">Unapprove</span>
				<?php }?>
			</td>
			<td><?=date('d F Y', strtotime($rows['added_date']))?></td>
			<td>
				<a href="add-lawyer.php?lid=<?=$rows['id']?>" class="btn btn-info"> <i class="fa fa-pencil"></i> </a>
				<a href="javascript:void(0)" onclick="deleteThis('<?=$rows['id']?>','lawyer')" class="btn btn-danger"> <i class="fa fa-trash"></i> </a>
			</td>
		</tr>
	<?php }?>
	</tbody>
</table>
</div>