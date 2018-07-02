<?php include("admin_header.php");?>
<div class="" style="margin:5% 2%">
	<h3>All Questions & Answer<br><br><a href="javascript:void(0)" class="btn btn-info">Unanswered Questions</a><a href="view-answered-questions.php" class="btn btn-default">Answered Questions</a></h3>
	<table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>S. No.</th>
				<th>Lawyer Name</th>
				<th>Client Name</th>
				<th>Subject</th>
				<th>Date | Time</th>
				<th>View</th>
				<th>Action</th>
				
			</tr>
		</thead>
		<tbody>
		<?php 
			$sno = 0;
			$query = mysql_query("select * from ra_question where status=0") or die(mysql_error());
			while($rows = mysql_fetch_assoc($query)){
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
				<td><?=$rows['subject']?></td>
				<td><?=date('d F Y | h:i A', strtotime($rows['added_date']))?></td>
				<td>
					<a href="single-question-answer.php?qid=<?=$rows['id']?>" class="btn btn-info"> <i class="fa fa-eye"></i> </a>
				</td>
				<td>
					<a href="javascript:void(0)" onclick="deleteQuestion('<?=$rows['id']?>','Unanswered')" class="btn btn-danger"> <i class="fa fa-trash"></i> </a>
				</td>
			</tr>
		<?php }?>
		</tbody>
	</table>
</div>
