<?php include("admin_header.php");?>
<div class="" style="margin:5% 2%">
	<h3>All Rating & Comments</h3>
	<table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>S. No.</th>
				<th>Lawyer Name</th>
				<th>Client Name</th>
				<th>Rating</th>
				<th>Comment</th>
				<th>Action</th>
				
			</tr>
		</thead>
		<tbody>
		<?php 
			$sno = 0;
			$query = mysql_query("select * from ra_lawyer_answer where feedback != '' OR rating !=  '' ") or die(mysql_error());
			while($rows	 = mysql_fetch_assoc($query)){
				$qr = mysql_query("select full_name from ra_front_users where id='".$rows['client_id']."'") or die(mysql_error());
				$uname = mysql_fetch_assoc($qr);
				$qr1 = mysql_query("select full_name from ra_lawyers where id='".$rows['lawyer_id']."'") or die(mysql_error());
				$lname = mysql_fetch_assoc($qr1);
				$sno++;
		?>
			<tr id="item_<?=$rows['id']?>">
				<td align="center"><?=$sno?>.</td>
				<td><?=$lname['full_name']?></td>
				<td><?=$uname['full_name']?></td>
				<td align="center"><?=$rows['rating']?></td>
				<td><?=$rows['feedback']?></td>
				<td>
					<a href="javascript:void(0)" onclick="deleteFeedback('<?=$rows['id']?>','Unanswered')" class="btn btn-danger"> <i class="fa fa-trash"></i> </a>
				</td>
			</tr>
		<?php }?>
		</tbody>
	</table>
</div>
