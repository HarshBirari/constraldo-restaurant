<?php

use \PhpPot\Service\StripePayment;

require_once "config.php";

session_start();


if (!empty($_POST["token"])) {
    require_once 'StripePayment.php';
    $stripePayment = new StripePayment();

    $stripeResponse = $stripePayment->chargeAmountFromCard($_POST);

    require_once "DBController.php";
    $dbController = new DBController();

    $amount = $_SESSION["payment"];
    $user_id = $_SESSION["user_id"];

    $param_type = 'ssdssss';
    $param_value_array = array(
        $_POST['email'],
        $_POST['item_number'],
        $amount,
        $stripeResponse["currency"],
        $stripeResponse["balance_transaction"],
        $stripeResponse["status"],
        $_SESSION['order_id'],
        json_encode($stripeResponse),
        $_SESSION["user_id"],
        $_SESSION["p_id"]

    );
    // echo "<pre>";
    // print_r($param_value_array);

    $con  = mysqli_connect("localhost", "root", "", "restaurant") or die("Database not connected");
    $order_id =  $_SESSION['order_id'];
    $q = "update comfirm_order set `order_status`='Confirm' where `order_id`='$order_id'";
    mysqli_query($con, $q);

    if (@$_SESSION['promocode_id']) {
        $promocode_id = $_SESSION['promocode_id'];
        $del = "delete from coupon where `coupon_id` = '$promocode_id'";
        mysqli_query($con, $del);
        unset($_SESSION['promocode_value']);
    }


    $query = "INSERT INTO tbl_payment (email, item_number, amount, currency_code, txn_id,order_id, payment_status, payment_response, user_id, p_id) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $id = $dbController->insert($query, $param_type, $param_value_array);

    if ($stripeResponse['amount_refunded'] == 0 && empty($stripeResponse['failure_code']) && $stripeResponse['paid'] == 1 && $stripeResponse['captured'] == 1 && $stripeResponse['status'] == 'succeeded') {
        header('location:successfully_msg.php');
        $_SESSION['successMessage'] = "Awesome, Payment was successful..!. TRANSACTION ID :" . $stripeResponse["balance_transaction"];
        $_SESSION['transction_id'] = $stripeResponse['balance_transaction'];

        if ($_SESSION['payment'] >= 10000) {
            $coupon_code = strtoupper(uniqid());
            $ins = "insert into coupon (`username`,`coupon_code`) values ('$user_id','$coupon_code')";
            $fire = mysqli_query($con, $ins);

            $promocode_send = mysqli_insert_id($con);
            $sel_data = "select * from coupon where `coupon_id` = '$promocode_send'";
            $fire_data = mysqli_query($con, $sel_data);
            $promocode_data = mysqli_fetch_array($fire_data);

            $promocode_email = $promocode_data['coupon_code'];
            $_SESSION['promocode'] = $promocode_email;
            header('location:promocode.php');
        }
    }
}
?>
<html>

<head>
    <link href="style.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style type="text/css">
        #frmStripePayment {
            margin: 0 auto;
        }

        body {
            width: 100%;
            background: url(../images/bg_4.jpg) no-repeat fixed;
        }

        #frmStripePayment {
            margin: 0 auto;
            align-items: center;
            align-content: center;
            margin-top: 107px;
        }

        #frmStripePayment {
            background: #000;
            border: 0;

        }

        #frmStripePayment div label {
            color: #fff;
        }

        .btnAction {
            background: #c49b63;
            border: 1px solid #c49b63;
            color: #000;
        }
    </style>

</head>

<body style="background-color: #c0c0c0;">
    <a href="../index.php" class="btnAction"><i class="fa fa-home"></i> Back To Home</a><br><br>
    <?php if (!empty($_SESSION['successMessage'])) { ?>
        <div id="success-message" style="text-align: center; margin: auto;"><?php echo $_SESSION['successMessage']; ?></div>
    <?php } ?>
    <div id="error-message"></div>

    <form id="frmStripePayment" style="padding: 45px;margin: auto;" method="post">
        <div>
            <img src="images/icons/all.jpg" width="300px">
        </div><br>
        <div class="field-row">
            <label>Card Holder Name</label> <span id="card-holder-name-info" class="info"></span><br>
            <input type="text" id="name" name="name" class="demoInputBox">
        </div>
        <div class="field-row">
            <label>Email</label> <span id="email-info" class="info"></span><br> <input type="text" id="email" name="email" class="demoInputBox">
        </div>
        <div class="field-row">
            <label>Card Number</label> <span id="card-number-info" class="info"></span><br> <input type="text" id="card-number" name="card_number" class="demoInputBox">
        </div>
        <div class="field-row">

            <div class="contact-row column-right">
                <label>Expiry Month / Year</label> <span id="userEmail-info" class="info"></span><br>

                <select name="month" id="month" class="demoSelectBox">
                    <?php for ($i = 0; $i < 12; $i++) { ?>
                        <option value="<?php echo $i + 1; ?>"><?php echo $i + 1; ?></option>
                    <?php } ?>

                </select> <select name="year" id="year" class="demoSelectBox">
                    <?php for ($i = 2021; $i < 2030; $i++) { ?>
                        <option value="<?php echo $i ?>"><?php echo $i; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="contact-row cvv-box">
                <label>CVC</label> <span id="cvv-info" class="info"></span><br> <input type="text" name="cvc" id="cvc" class="demoInputBox cvv-input">
            </div>
        </div>
        <div>
            <input type="submit" name="pay_now" value="Submit" id="submit-btn" class="btnAction" onClick="stripePay(event);">

            <div id="loader">
                <img alt="loader" src="loading2.gif">
            </div>
        </div>
        <input type='hidden' name='amount' value="<?php echo $_SESSION['payment']; ?>">
        <input type='hidden' name='currency_code' value='INR'>
        <input type='hidden' name='item_name' value='Product Purchase'>
        <input type='hidden' name='item_number' value='PHPPOTEG#1'>
    </form>

    <?php $con = mysqli_connect("localhost", "root", "", "restaurant");

    $order1 = @$_SESSION['order_id'];
    $user = @$_SESSION['user_id'];

    $sel = "select * from tbl_payment where `user_id` = '$user' AND `order_id` = '$order1' AND `payment_status` = 'succeeded'";
    $invo1 = mysqli_query($con, $sel);


    $invo2 = mysqli_num_rows($invo1);
    if ($invo2 > 0) {

    ?>
        <br><br>
        <div style="text-align: center;">
            <a href="../invoice/invoice_bill.php" class="btnAction" style="height:150px !important;">Download Invoice</a>
        </div>
    <?php } ?>

    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        function cardValidation() {
            var valid = true;
            var name = $('#name').val();
            var email = $('#email').val();
            var cardNumber = $('#card-number').val();
            var month = $('#month').val();
            var year = $('#year').val();
            var cvc = $('#cvc').val();

            $("#error-message").html("").hide();

            if (name.trim() == "") {
                valid = false;
            }
            if (email.trim() == "") {
                valid = false;
            }
            if (cardNumber.trim() == "") {
                valid = false;
            }

            if (month.trim() == "") {
                valid = false;
            }
            if (year.trim() == "") {
                valid = false;
            }
            if (cvc.trim() == "") {
                valid = false;
            }

            if (valid == false) {
                $("#error-message").html("All Fields are required").show();
            }

            return valid;
        }

        //set your publishable key
        Stripe.setPublishableKey("<?php echo STRIPE_PUBLISHABLE_KEY; ?>");

        //callback to handle the response from stripe
        function stripeResponseHandler(status, response) {
            if (response.error) {
                //enable the submit button
                $("#submit-btn").show();
                $("#loader").css("display", "none");
                //display the errors on the form
                $("#error-message").html(response.error.message).show();
            } else {
                //get token id
                var token = response['id'];
                //insert the token into the form
                $("#frmStripePayment").append("<input type='hidden' name='token' value='" + token + "' />");
                //submit form to the server
                $("#frmStripePayment").submit();
            }
        }

        function stripePay(e) {
            e.preventDefault();
            var valid = cardValidation();

            if (valid == true) {
                $("#submit-btn").hide();
                $("#loader").css("display", "inline-block");
                Stripe.createToken({
                    number: $('#card-number').val(),
                    cvc: $('#cvc').val(),
                    exp_month: $('#month').val(),
                    exp_year: $('#year').val()
                }, stripeResponseHandler);

                //submit from callback
                return false;
            }
        }
    </script>
</body>

</html>