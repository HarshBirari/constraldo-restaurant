<?php 

include('header.php');

if(isset($_GET['book_table_id']))
{
  $book_table_id = $_GET['book_table_id'];
  $del = "delete from book_table where `book_table_id` = '$book_table_id'";
  mysqli_query($con,$del);
}

$sel= "select * from book_table";
$sel1 = mysqli_query($con,$sel);



?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary card-header-icon">
            <div class="card-icon">
              <i class="material-icons">assignment</i>
            </div>
            <h4 class="card-title">Booking Table</h4>
          </div>
          <div class="card-body">
            <div class="toolbar">
              <!--        Here you can write extra buttons/actions for the toolbar              -->
            </div>
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <tr>
                  <th>Book_table_id</th>
                  <th>Name</th>
                  <th>Date</th>
                  <th>Time</th>
                  <th>Contact no</th>
                  <th>Message</th>
                  <th>Email</th>
                  <th>Booking_id</th>
                  <th>Response</th>
                  <th class="text-right">Action</th>
                  <th>Response</th>
                </tr>
                <?php while($data = mysqli_fetch_array($sel1)) { ?>
                  <tr>
                    <td><?php echo $data['book_table_id']; ?></td>
                    <td><?php echo $data['name']; ?></td>
                    <td><?php echo $data['date']; ?></td>
                    <td><?php echo $data['time']; ?></td>
                    <td><?php echo $data['contact_no']; ?></td>
                    <td><?php echo $data['message']; ?></td>
                    <td><?php echo $data['email']; ?></td>
                    <td><?php echo $data['booking_id']; ?></td>
                    <?php if($data['response']=="Booked") { ?><td style="color: green"><?php echo $data['response']; ?></td><?php } elseif($data['response']=="") { ?><td style="color: #ff8100;">Not Response Yet</td><?php } 
                    elseif($data['response']=="Cancelled") { ?><td style="color: red;"><?php echo $data['response']; ?></td><?php } ?>
                    
                    <td class="td-actions text-right">
                      
                      <a href="booking_table.php?book_table_id=<?php echo $data['book_table_id']; ?>" rel="tooltip" class="btn btn-danger">
                        <i class="material-icons">close</i>
                      </a>
                    </td>
                    <?php if($data['response']=="") { ?><td style="text-align: center;"><a href="response_table_booking.php?book_table_id=<?php echo $data['book_table_id']; ?>"><i class="fa fa-reply" aria-hidden="true"></i></a></td><?php } else{ ?><td style="text-align: center;color: green"><i class="fa fa-check-square-o" aria-hidden="true"></i></td><?php } ?>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
        <!-- end content-->
      </div>
      <!--  end card  -->
    </div>
    <!-- end col-md-12 -->
  </div>
  <!-- end row -->
</div>
</div>
<?php include('footer.php'); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


