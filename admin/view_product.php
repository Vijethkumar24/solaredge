<?php 
    session_start();
    include 'config.php';

    if(!isset($_SESSION['login']))
    {
        header("Location: login.php");
    }
    if(isset($_GET['del']))
    {
        if(mysqli_query($conn,"delete from product where id = '".$_GET['id']."'"))
        {
            echo "<script>alert('Product deleted successfully..!')</script>";
        }
        else
        {
            echo "<script>alert('Unable to delete product..!')</script>";
            echo mysqli_error($conn);
        }
    }
    include 'link.php';
    include 'admin_header.php';
?>
    <div class="outter-wp">
    <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
										<th>Categroy</th>
										<th>Name</th>
										<th>Description</th>
										<th>Image</th>
										<th>Warranty</th>
										<th>Date</th>
										<th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php 
                                    $query=mysqli_query($conn,"select product.id, category.name as catname, product.name, product.descrption, product.image, product.warranty, product.date, product.status from product join category on category.id=product.category_id  where product.status=true order by product.id desc");
                                    $cnt=1;
                                    while($row=mysqli_fetch_array($query))
                                    {?>									
                                        <tr>
                                            <td><?php echo htmlentities($cnt);?></td>
                                            <td><?php echo htmlentities($row['catname']);?></td>
                                            <td><?php echo htmlentities($row['name']);?></td>
                                            <td><?php echo htmlentities($row['descrption']);?></td>
                                            <td><img src="<?php echo htmlentities($row['image']);?>" height="50" width="50"></td>
                                            <td><?php echo htmlentities($row['warranty']);?></td>
                                            <td><?php echo htmlentities($row['date']);?></td>
                                            <td> <?php if($row['status']){echo 'Active';}else{echo 'In-Active';}?></td>
                                            <td>
                                                <a href="view_product.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')">Delete</a></td>
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