<?php include("../config.php"); ?>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
<link rel="stylesheet" href="http://35.154.128.159:83/wp-content/themes/right_advice/css/custom.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.css
" rel="stylesheet"/>

<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.1/jquery.form.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap.min.js"></script>

<!--script src="https://cdn.bootcss.com/moment.js/2.18.1/locale/af.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script-->
<script src="admin.js"></script>


<script type="text/javascript">
  /* $(function () {
    $('#datetimepicker1').datepicker({
      viewMode: 'years'
    });
  }); */
 </script>
 
<script>
$( function() {
	$( "#accordion" ).accordion();
} );
</script>
<script>
$(document).ready(function() {
    $('#example').DataTable();
} );

//document.getElementById('myiframe').src = document.getElementById('myiframe').src;
</script>

<style>
.bootstrap-wrapper h3, .bootstrap-wrapper .h3 {
    font-size: 23px;
    border: 1px solid #ccc;
    padding: 10px;
    border-radius: 3px;
    background: rgba(221, 221, 221, 0.23);
}
div#accordion .acco {
    border: 1px solid #ccc;
    padding: 10px;
    margin: -22px 0px 12px 0px;
}
#t1{height:350px !important;}
#t2{height:330px !important;}
#t3{height:200px !important;}
#t4{height:480px !important;}
#t5{height:1050px !important;}
.tab_head{cursor:pointer;}
</style>

