<?php 
    session_start();
    include 'config.php';
    $uid = $_SESSION['id'];

    if(!isset($_SESSION['login']))
    {
        header("Location: login.php");
    }
    include 'link.php';
    include 'admin_header.php';
    ?>
    
    <button style="float:right" onclick="printDiv('printableArea')" type="button" class="btn btn-success">
    Print   <span class="glyphicon glyphicon-chevron-right"></span>
    </button>
    <div class="outter-wp" id="printableArea">
    <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
										<th>Service No</th>
										<th>User Name</th>
										<th>Contact</th>
										<th>Product</th>
										<th>Problem</th>
										<th>Date</th>
										<th>Status</th>
										<th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php 

                                    $query=mysqli_query($conn,"select service.id, service.amount, product.name as pname, user.contact, service.id,  service.service_no, user.first_name, user.last_name, user.username, user.contact, service.problem, service.date, service.status from service join user on service.userid=user.id join product on product.id = service.product_id WHERE MONTH(service.date) = MONTH(CURRENT_DATE()) AND YEAR(service.date) = YEAR(CURRENT_DATE()) order by service.id desc");
                                    $cnt=1;
                                    while($row=mysqli_fetch_array($query))
                                    {?>									
                                        <tr>
                                        <td><?php echo htmlentities($cnt);?></td>
                                            <td><?php echo htmlentities($row['first_name']." ".$row['last_name']);?></td>
                                            <td><?php echo htmlentities($row['contact']);?></td>
                                            <td><?php echo htmlentities($row['pname']);?></td>
                                            <td><?php echo htmlentities($row['service_no']);?></td>
                                            <td><?php echo htmlentities($row['problem']);?></td>
                                            <td><?php echo htmlentities($row['date']);?></td>
                                            <td> <?php if($row['status']){echo 'Pending';}else{echo 'Solved';}?></td>
                                            <td><?php echo htmlentities($row['amount']);?></td>
                                        </tr>
                                        <?php $cnt=$cnt+1; 
                                    } ?>
                                </tbody>			
                            </table>
    </div>
        
<?php
    include 'footer.php';
    include 'admin_sidebar.php';
?>
<script>
    function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
<!--js -->
<link rel="stylesheet" href="css/vroom.css">
<script type="text/javascript" src="js/vroom.js"></script>
<script type="text/javascript" src="js/TweenLite.min.js"></script>
<script type="text/javascript" src="js/CSSPlugin.min.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>

<!-- Bootstrap Core JavaScript -->
   <script src="js/bootstrap.min.js"></script>
</body>
</html>