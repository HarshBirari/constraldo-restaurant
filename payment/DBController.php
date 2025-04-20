<?php
class DBController {
  private $host = "localhost";
  private $user = "root";
  private $password = "";
  private $database = "restaurant";
  private $conn;
  
    function __construct() {
        $this->conn = $this->connectDB();
  } 
  
  function connectDB() {
    $conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
    return $conn;
  }
  
    function runBaseQuery($query) {
        $result = $this->conn->query($query); 
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $resultset[] = $row;
            }
        }
        return $resultset;
    }
    
    function runQuery($query, $param_type, $param_value_array) {
        $sql = $this->conn->prepare($query);
        $this->bindQueryParams($sql, $param_type, $param_value_array);
        $sql->execute();
        $result = $sql->get_result();
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $resultset[] = $row;
            }
        }
        
        if(!empty($resultset)) {
            return $resultset;
        }
    }
    
    function bindQueryParams($sql, $param_type, $param_value_array) {
        $param_value_reference[] = & $param_type;
        for($i=0; $i<count($param_value_array); $i++) {
            $param_value_reference[] = & $param_value_array[$i];
        }
        call_user_func_array(array(
            $sql,
            'bind_param'
        ), $param_value_reference);
    }
    
    function insert($query, $param_type, $param_value_array) {
      // echo "<pre>";
      // print_r($query);
      // print_r($param_type);
      // print_r($param_value_array);
      // exit;

        $con  = mysqli_connect("localhost","root","","restaurant") or die("Database not connected");
        // echo "<pre>";
        // print_r($param_value_array);
       $p1=$param_value_array[0];
       $p2=$param_value_array[1];
       $p3=$param_value_array[2];
       $p4=$param_value_array[3];
       $p5=$param_value_array[4];
       $p6=$param_value_array[5];
       $p7=$param_value_array[6];
       $p8=$param_value_array[7];
       $p9=$param_value_array[8];
       $p10=$param_value_array[9];
      
       $qu = "INSERT INTO tbl_payment (`email`,`item_number`,`amount`,`currency_code`,`txn_id`,`payment_status`,`payment_response`,`order_id`,`user_id`, `p_id`) values('$p1','$p2','$p3','$p4','$p5','$p6','$p8','$p7','$p9','$p10')"; 

       $qe = "select * from comfirm_order where `order_id`='$p7'";
       $qe1 = mysqli_query($con,$qe);
       $qe2 = mysqli_fetch_array($qe1);
       $cart_record =  $qe2['cart_id'];
       $cart_re =  explode(',',$cart_record);
       $query1 = mysqli_query($con,$qu);

       for($i=0;$i<sizeof($cart_re);$i++)
       {
          $qn ="update cart set `cart_status`='Completed' where `cart_id`='$cart_re[$i]'";
          mysqli_query($con,$qn);
          $sel2 = "select * from cart where `cart_id`  = '$cart_re[$i]'";
          $fetch = mysqli_query($con,$sel2);

          $cart_reco = mysqli_fetch_array($fetch);
          $qty_rec = $cart_reco['qty'];
          $pro_id = $cart_reco['p_id'];

          $sel_pro = "select * from product where `p_id` = '$pro_id'";
          $fetch1 = mysqli_query($con,$sel_pro);

          $pro_rec = mysqli_fetch_array($fetch1);

          $pro_qty = $pro_rec['product_qty'];
          $cat_id = $pro_rec['cat_id'];


          if($cat_id!=5 || $cat_id!=1)
          {
            $quantity = $pro_qty - $qty_rec;
            if($pro_qty>0)
            {
              $qty_update = "update product set `product_qty` = '$quantity' where `p_id` = '$pro_id'";
              $quer1 = mysqli_query($con,$qty_update);
            }
          }
       }
    }
    
    function update($query, $param_type, $param_value_array) {
        $sql = $this->conn->prepare($query);
        $this->bindQueryParams($sql, $param_type, $param_value_array);
        $sql->execute();
    }
}
?>