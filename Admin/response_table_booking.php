<?php 

include('header.php');


   if(isset($_POST['submit']))
  {
    $book_table_id = $_GET['book_table_id'];
    $response = $_POST['response'];
    $remarks = $_POST['remarks'];

    if($remarks=="")
    {
      $remarks = "No Remarks From Restaurant";
    }

    $update = "update book_table set `response` = '$response' ,`remarks`= '$remarks' where `book_table_id` = '$book_table_id'";
    $que = mysqli_query($con,$update);
  }

  if(isset($_GET['book_table_id']))
  {
    $book_table_id = $_GET['book_table_id'];
    $sel = "select * from book_table where `book_table_id` = '$book_table_id'";
    $qu = mysqli_query($con,$sel);
    $record = mysqli_fetch_array($qu);
  }

?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header card-header-primary card-header-icon">
            <div class="card-icon">
              <i class="material-icons">assignment</i>
            </div>
            <h4 class="card-title">Table Booking Details #<?php echo $record['book_table_id']; ?></h4>
          </div>
          <div class="card-body">
            <div class="toolbar">
              <!--        Here you can write extra buttons/actions for the toolbar              -->
            </div>
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <tr>
                  <th>Booking ID</th>
                  <td><?php echo $record['booking_id']; ?></td>
                </tr>
                <tr>
                  <th>First Name</th>
                  <?php $name = explode(' ',$record['name']); ?>
                  <td><?php echo $name[0]; ?></td>
                </tr>
                <tr>
                  <th>Last Name</th>
                  <td><?php echo $name[1]; ?></td>
                </tr>
                <tr>
                  <th>Email</th>
                  <td><?php echo $record['email']; ?></td>
                </tr>
                <tr>
                  <th>Contact No.</th>
                  <td><?php echo $record['contact_no']; ?></td>
                </tr>
                
                <tr>
                  <th>Booking Date</th>
                  <td><?php echo $record['date']; ?></td>
                </tr>

                   <tr>
                  <th>Booking Date</th>
                  <td><?php echo $record['time']; ?></td>
                </tr>
                <tr>
                  <th>Booking Final Status</th>
                  <?php if($record['response']=="") { ?>
                    <td>Not Confirm Yet</td>
                  <?php } else if($record['response']=="Booked") { ?>
                    <td>Booked</td>
                  <?php } else if($record['response']=="Cancelled") { ?>
                    <td>Cancelled</td>
                  <?php } ?>
                </tr>
              </table>
            </div>
          </div>
          <!-- end content-->
        </div>
        <!--  end card  -->
      </div>

        <div class="col-md-6">
        <div class="card ">
          <div class="card-header card-header-rose card-header-text">
            <div class="card-text">
              <h4 class="card-title">Response Of Table Booking</h4>
            </div>
          </div>
          
          
          <div class="card-body ">
            <form method="post" enctype="multipart/form-data" class="form-horizontal">
              

              <div class="row">
                <?php if(isset($msg)) { ?>
                  <div class="alert alert-success"><?php echo $msg; ?></div>
                <?php } ?>
              </div>

              <div class="row">
                <label class="col-sm-2 col-form-label">Response Category</label>
                <div class="col-lg-5 col-md-6 col-sm-3">
                  <select class="selectpicker" data-style="select-with-transition" name="response">
                    <option>--SELECT RESPONSE--</option>
                    <option>Booked</option>
                    <option>Cancelled</option>
                  </select>
                </div>
              </div><br>

              <div class="row">
                <label class="col-sm-2 col-form-label">Remarks</label>
                <div class="col-sm-10">
                  <div class="form-group">
                    <input type="text" name="remarks" class="form-control" placeholder="Enter Remarks">
                  </div>
                </div>
              </div>

              
              <div style="text-align: center;">
                
                  <button type="submit" name="submit" class="btn btn-info">Give Response</button>
              </div>
            </form>
          </div>
        </div>
      </div>

    
    </div>
  </div>
  <!-- end row -->
</div>
</div>
<?php include('footer.php'); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


