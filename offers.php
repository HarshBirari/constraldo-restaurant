<?php 
ob_start();

include('header.php'); 

$sel5 = "select * from festival_offer";
$que5 = mysqli_query($con,$sel5);

$festival = mysqli_num_rows($que5);



?>

<section class="home-slider owl-carousel">

  <div class="slider-item" style="background-image: url(images/38.jpg);" data-stellar-background-ratio="0.5">
   <div class="overlay"></div>
   <div class="container">
    <div class="row slider-text justify-content-center align-items-center">

      <div class="col-md-7 col-sm-12 text-center ftco-animate">
       <h1 class="mb-3 mt-5 bread">Offers </h1>
       <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Offers</span></p>
     </div>

   </div>
 </div>
</div>
</section>

<section class="ftco-section contact-section">
  <div class="container mt-5">
    <div class="row block-9">

      <div class="col-md-12">
        <h3 style="font-family: arial">Available Offers</h3><br>
      </div>
      <div class="col-md-5 ftco-animate"  style="border-style: solid;border-color: #c49b63;margin: 20px 0px;">

        <br><span style="background: #c49b63;color: #000;padding: 10px;">For New Users</span><br><br>
        <input type="hidden" id="textval" value="BMBCA05">
        <p style="color: #fff;">Get 5% discount using BMBCA05 promocode </p>
        <p>Use code <b>BMBCA05</b> & get 5% discount no limit on orders above INR 3000/-</p>
        <a href="#" data-toggle="modal" data-target="#exampleModalCenter" style="color:lightgreen;">+ MORE</a><br><br>
        <div class="form-group">
          <input type="button" id="button1" onclick="return getcode()" value="Copy Code" class="btn btn-primary py-2 px-4">

        </div>

      </div>

      <div class="col-md-2 ftco-animate">
      </div>

      <div class="col-md-5 ftco-animate" style="border-style: solid;border-color: #c49b63;margin: 20px 0px;">

        <br><span style="background: #c49b63;color: #000;padding: 10px;">Special Offer</span><br><br>
        <p style="color: #fff;">Get 10% discount using promocode </p>
        <p>Use you got code & get 10% discount no limit on orders above INR 3000/-</p>
        <a href="#" data-toggle="modal" data-target="#exampleModalCenter1" style="color:lightgreen;">+ MORE</a><br><br>
        <div class="form-group">
          <input type="button" value="Promocode you got" class="btn btn-primary py-2 px-4">

        </div>

      </div>

      <?php if(isset($festival)!=0) $i=0; { foreach($que5 as $offer) {  ?>

        <div class="col-md-5 ftco-animate" style="border-style: solid;border-color: #c49b63;margin: 20px 0px;">
       

        <br><span style="background: #c49b63;color: #000;padding: 10px;"><?php echo $offer['festival_name']; ?> Offer</span><br><br>
        <p style="color: #fff;"><?php echo $offer['festival_name'] ?> Festival Discount Rs <?php echo $offer['discount']; ?>% Flat </p>
        <p>Use code <b> <input style="border: none;background-color: transparent;color: #808080;width: 28%;" type="text" readonly id="textvale<?php echo $i; ?>" value="<?php echo $offer['promocode']; ?>"></b><br> & get 10% discount no limit on orders above INR 3000/-</p>
        <a href="#" data-toggle="modal" data-target="#exampleModalCenter<?php echo $offer['festival_id']; ?>" style="color:lightgreen;">+ MORE</a><br><br>
        <div class="form-group">
          <input type="button" id="btn<?php echo $i; ?>" value="Copy Code" onclick="return getcode1('<?php echo $i; ?>')" class="btn btn-primary py-2 px-4">

        </div>

      </div><?php if($i%2==0) {  ?><div class="col-md-2 ftco-animate"></div><?php }?>

      <?php $i++; }} ?>


    </div>
  </div>
</section>


<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #c49b63">
        <h5 class="modal-title" id="exampleModalLongTitle">Promocode</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <center>
          <h5 style="color: #000;">PROMOCODE <b>: BMBCA05</b></h5>
          <h5 style="color: #000;">Valid on all products</h5></center><hr>

          
          <ul>
            <li>Discount Amount: : <b style="color:#000">5% cashback of amount</b></li>
            <li>Minimum Cart Value : <b style="color:#c49b63">₹3000</b></li>
            <li>Maximum Usage : <b style="color:#17a2b8">Once new user</b></li>
            <li>Valid Till : <b style="color:#d28e33">Any time</b></li>
          </ul>

          <center>
            <small style="color: #000;">T & C Apply</small>
          </center>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Done</button>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background: #c49b63">
          <h5 class="modal-title" id="exampleModalLongTitle">Promocode</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <center>
            <h5 style="color: #000;">COSTRALDO SHOP</h5>
            <h5 style="color: #000;">Valid on all products</h5></center><hr>


            <ul>
              <li>When Get Promocode : <b style="color:#000">Shop worth 10000 or more & get discount at next order and promocode recieved by order recipt and email. discount by costraldo shop</b></li>
              <li>Discount Amount: : <b style="color:#000">10% cashback of amount</b></li>
              <li>Minimum Cart Value : <b style="color:#c49b63">₹3000</b></li>
              <li>Maximum Usage : <b style="color:#17a2b8">Once per user</b></li>
              <li>Valid Till : <b style="color:#d28e33">Any time</b></li>
            </ul>
            <center>
              <small style="color: #000;">T & C Apply</small>
            </center>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Done</button>
          </div>
        </div>
      </div>
    </div>


    <?php foreach($que5 as $offer1) { 
        $festival_id = $offer1['festival_id'];
  ?>
<div class="modal fade" id="exampleModalCenter<?php echo $offer1['festival_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #c49b63">
        <h5 class="modal-title" id="exampleModalLongTitle">Festival Promocode</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <center>
        <?php $sel_festival = "select * from festival_offer where `festival_id` = '$festival_id'"; $qu_festival = mysqli_query($con,$sel_festival); $festival_fetch = mysqli_fetch_array($qu_festival); ?>
        <h5 style="color: #000;">PROMOCODE : <?php echo $festival_fetch['promocode']; ?></h5>
        <h5 style="color: #000;">Valid on all products</h5></center><hr>
      
          
            <ul>
              <li>When Get Promocode : <b style="color:#000">Festival Discount Rs <?php echo $festival_fetch['discount']; ?>% Flat</b></li>
              <li>Discount Amount: : <b style="color:#000"><?php echo $festival_fetch['discount']; ?>% cashback of amount</b></li>
              <li>Minimum Cart Value : <b style="color:#c49b63">₹3000</b></li>
              <li>Maximum Usage : <b style="color:#17a2b8">Once per user</b></li>
              <li>Valid Till : <b style="color:#d28e33">Limited time during <?php echo $festival_fetch['festival_name']; ?> festival</b></li>
            </ul>
            <center>
          <small style="color: #000;">T & C Apply</small>
          </center>
 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Done</button>
      </div>
    </div>
  </div>
</div>
<?php } ?>

    <?php include('footer.php'); ?>

    <script>

      function getcode()
      {
        var textval = document.getElementById('textval');

        textval.select();

        document.execCommand("copy");

        document.getElementById('button1').disabled = "true";
        document.getElementById('button1').style.cursor = "default";
        document.getElementById('button1').className = "none";
        document.getElementById('button1').style.color = "white";
        document.getElementById('button1').style.padding = "3px 17px";
        document.getElementById('button1').style.borderColor = "white";
        document.getElementById('button1').style.fontSize = "15px";

      }

       function getcode1(i)
      {
        var idof = 'textvale'+i;
        var textval1 = document.getElementById(idof);

        textval1.select();

        document.execCommand("copy");


      }


    </script>