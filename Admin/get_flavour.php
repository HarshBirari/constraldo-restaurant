<?php 

	include('db.php');
	if(isset($_POST['cat_id']))
	{
		$cat_id = $_POST['cat_id'];
		$sel = "select * from subcategory where `cat_id` = '$cat_id'";
		$qu = mysqli_query($con,$sel);
		$flavour = mysqli_fetch_array($qu);
	}

  if(isset($_POST['p_id']))
  {
    $p_id = $_POST['p_id'];
    $sel1 = "select * from product where `p_id` = '$p_id'";
    $qu = mysqli_qurey($con,$sel1);
    $que = mysqli_fetch_array($qu);
    print_r($que);
    exit;
  }

 ?>

 	<?php if($flavour['cat_id']==1) { ?>
                      <label class="col-sm-2 col-form-label">Product Description</label>
                      <div class="col-sm-10">
                        <div class="form-group">
                          <textarea name="product_desc" style="width: 100%;"><?php if(isset($que['product_description'])) { echo $que['product_description']; } ?></textarea>
                        </div>
                      </div>

                       <label class="col-sm-2 col-form-label">Product price</label>
                      <div class="col-sm-10">
                        <div class="form-group">
                          <input type="text" value="<?php if(@$que['product_price']) { echo $que['product_price']; } ?>" name="price" class="form-control" placeholder="Enter Product price">
                        </div>
                    </div>

                    <label class="col-sm-2 col-form-label label-checkbox"> Flavour </label>
                      <div class="col-sm-10 checkbox-radios">
                        <div class="form-check form-check-inline">
                          <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="flavour[]" value="Espresso"> Espresso
                            <span class="form-check-sign">
                              <span class="check"></span>
                            </span>
                          </label>
                        </div>

                        <div class="form-check form-check-inline">
                          <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="flavour[]" value="Water"> Water
                            <span class="form-check-sign">
                              <span class="check"></span>
                            </span>
                          </label>
                        </div>

                        <div class="form-check form-check-inline">
                          <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="flavour[]" value="Milkfoam"> Milkfoam
                            <span class="form-check-sign">
                              <span class="check"></span>
                            </span>
                          </label>
                        </div>

                        <div class="form-check form-check-inline">
                          <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="flavour[]" value="Liquor"> Liquor
                            <span class="form-check-sign">
                              <span class="check"></span>
                            </span>
                          </label>
                        </div>

                        <div class="form-check form-check-inline">
                          <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="flavour[]" value="Cream"> Cream
                            <span class="form-check-sign">
                              <span class="check"></span>
                            </span>
                          </label>
                        </div>

                       <div class="form-check form-check-inline">
                          <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" value="Medium" name="flavour[]"> Medium
                            <span class="form-check-sign">
                              <span class="check"></span>
                            </span>
                          </label>
                        </div>
                        <div class="form-check form-check-inline">
                          <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" value="Lemon" name="flavour[]"> Lemon
                            <span class="form-check-sign">
                              <span class="check"></span>
                            </span>
                          </label>
                        </div>
                        <div class="form-check form-check-inline">
                          <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" value="Chocolate" name="flavour[]"> Chocolate
                            <span class="form-check-sign">
                              <span class="check"></span>
                            </span>
                          </label>
                        </div>
                    </div>

                      <label class="col-sm-2 col-form-label label-checkbox"> Size </label>
                      <div class="col-sm-10 checkbox-radios">
                        <div class="form-check form-check-inline">
                          <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="size[]" value="Small"> Small
                            <span class="form-check-sign">
                              <span class="check"></span>
                            </span>
                          </label>
                        </div>

                       <div class="form-check form-check-inline">
                          <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" value="Medium" name="size[]"> Medium
                            <span class="form-check-sign">
                              <span class="check"></span>
                            </span>
                          </label>
                        </div>
                        <div class="form-check form-check-inline">
                          <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" value="Large" name="size[]"> Large
                            <span class="form-check-sign">
                              <span class="check"></span>
                            </span>
                          </label>
                        </div>
                        <div class="form-check form-check-inline">
                          <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" value="Extra Large" name="size[]"> Extra large
                            <span class="form-check-sign">
                              <span class="check"></span>
                            </span>
                          </label>
                        </div>
                    </div>

                      <?php } else if($flavour['cat_id']==2) { ?>

                      <label class="col-sm-2 col-form-label">Product Description</label>
                      <div class="col-sm-10">
                        <div class="form-group">
                          <textarea name="product_desc" style="width: 100%;"></textarea>
                        </div>
                      </div>

                       <label class="col-sm-2 col-form-label">Product price</label>
                      <div class="col-sm-10">
                        <div class="form-group">
                          <input type="text" name="price" class="form-control" placeholder="Enter Product price">
                        </div>
                    </div>

                      <?php } else if($flavour['cat_id']==5) {  ?>

                     <label class="col-sm-2 col-form-label">Product Description</label>
                      <div class="col-sm-10">
                        <div class="form-group">
                          <textarea name="product_desc" style="width: 100%;"></textarea>
                        </div>
                      </div>

                    <label class="col-sm-2 col-form-label">Product price</label>
                      <div class="col-sm-10">
                        <div class="form-group">
                          <input type="text" name="price" class="form-control" placeholder="Enter Product price">
                        </div>
                    </div>

                      <label class="col-sm-2 col-form-label label-checkbox"> Size </label>
                      <div class="col-sm-10 checkbox-radios">
                        <div class="form-check form-check-inline">
                          <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="size[]" value="150 ML"> 150 ML
                            <span class="form-check-sign">
                              <span class="check"></span>
                            </span>
                          </label>
                        </div>
                        <div class="form-check form-check-inline">
                          <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="size[]" value="250 ML"> 250 ML
                            <span class="form-check-sign">
                              <span class="check"></span>
                            </span>
                          </label>
                        </div>
                        <div class="form-check form-check-inline">
                          <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="size[]" value="500 ML"> 500 ML
                            <span class="form-check-sign">
                              <span class="check"></span>
                            </span>
                          </label>
                        </div>
                        <div class="form-check form-check-inline">
                          <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" value="1.0 L" name="size[]"> 1.0 L
                            <span class="form-check-sign">
                              <span class="check"></span>
                            </span>
                          </label>
                        </div>
                        <div class="form-check form-check-inline">
                          <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" value="2.25 L" name="size[]"> 2.25 L
                            <span class="form-check-sign">
                              <span class="check"></span>
                            </span>
                          </label>
                        </div>
                        
                    </div>

                     <?php } else {  ?>

                     <label class="col-sm-2 col-form-label">Product Description</label>
                      <div class="col-sm-10">
                        <div class="form-group">
                          <textarea name="product_desc" style="width: 100%;"></textarea>
                        </div>
                      </div>

                    <label class="col-sm-2 col-form-label">Product price</label>
                      <div class="col-sm-10">
                        <div class="form-group">
                          <input type="text" name="price" class="form-control" placeholder="Enter Product price">
                        </div>
                    </div>

                      <label class="col-sm-2 col-form-label">Product Quantity</label>
                      <div class="col-sm-10">
                        <div class="form-group">
                          <input type="text" name="qty" class="form-control" placeholder="Enter Product Qty">
                        </div>
                      </div>

                      <label class="col-sm-2 col-form-label label-checkbox"> Size </label>
                      <div class="col-sm-10 checkbox-radios">
                        <div class="form-check form-check-inline">
                          <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="size[]" value="Small"> Small
                            <span class="form-check-sign">
                              <span class="check"></span>
                            </span>
                          </label>
                        </div>
                        <div class="form-check form-check-inline">
                          <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" value="Medium" name="size[]"> Medium
                            <span class="form-check-sign">
                              <span class="check"></span>
                            </span>
                          </label>
                        </div>
                        <div class="form-check form-check-inline">
                          <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" value="Large" name="size[]"> Large
                            <span class="form-check-sign">
                              <span class="check"></span>
                            </span>
                          </label>
                        </div>
                        <div class="form-check form-check-inline">
                          <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" value="Extra Large" name="size[]"> Extra large
                            <span class="form-check-sign">
                              <span class="check"></span>
                            </span>
                          </label>
                        </div>
                    </div>
                    <?php } ?>