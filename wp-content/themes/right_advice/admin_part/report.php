<?php include("admin_header.php"); ?>

<div class="" style="margin:5% 2%">
<h3>Average Response Time Report</h3><br/>
<table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th>S. No.</th>
			<th>Lawyer Name (ID)</th>
			<th>Answered Questions</th>
			<th>Unanswered Questions</th>
			<th>Average Response Time (in hours)</th>
		</tr>
	</thead>
	<tbody>
		<?php 
			$sno = 1;
			$lawyer = mysql_query("select * from ra_lawyers where status='1' AND email_confirm='1' ") or die(mysql_error());
			while($lawyer_name = mysql_fetch_assoc($lawyer)){
			
			$ans = mysql_query("select * from ra_question where lawyer_id='".$lawyer_name['id']."' AND status = '1' ") or die(mysql_error());
			$ans_ques = mysql_num_rows($ans);
			
			$unans = mysql_query("select * from ra_question where lawyer_id='".$lawyer_name['id']."' AND status = '0' ") or die(mysql_error());
			$unans_ques = mysql_num_rows($unans);
			
			$ansdate = mysql_query("select * from ra_lawyer_answer where lawyer_id='".$lawyer_name['id']."' ") or die(mysql_error());
			$ans_date = mysql_fetch_assoc($ansdate);
			
			$unans_date = mysql_fetch_assoc($ans);
			
			$ques_date = strtotime($unans_date['added_date']);
			$reply_date = strtotime($ans_date['reply_date']);
			
			$date_diff = $reply_date - $ques_date;
			$date_diff = $date_diff/60;
			$date_diff = $date_diff/$ans_ques;
			$date_diff =  number_format((float)$date_diff, 2, '.', '');
		?>
		<tr>
			<td align="center"><?=$sno++?>.</td>
			<td><?=$lawyer_name['full_name']?> (<?=$lawyer_name['id']?>)</td>
			<td align="center"><?=$ans_ques?></td>
			<td align="center"><?=$unans_ques?></td>
			<td align="center"><?=$date_diff?><?//=date('h:i',strtotime($unans_date['added_date'])) ." | ". date('h:i',strtotime($ans_date['added_date']))?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>
</div>