<?php 
session_start();
include("../includes/db.php");

if(isset($_POST['cust_contact'])){

    $cust_contact = $_POST['cust_contact'];

    $get_cust_contact = "select * from customers where customer_contact='$cust_contact'";
    $run_cust_contact = mysqli_query($con,$get_cust_contact);
    $row_cust_contact = mysqli_fetch_array($run_cust_contact);
    $cust_con_count = mysqli_num_rows($run_cust_contact);

    if($cust_con_count<1){

        echo "
        
            <div class='form-group'>
                <label>Customer Name</label>
                <input type='text' name='staff_c_name' id='staff_c_name' class='form-control form-control-sm py-2' placeholder='Username' aria-label='Username'>
            </div>
            <div class='form-group'>
                <label>Customer Contact</label>
                <div class='input-group'>
                    <input type='number' class='form-control py-2' name='staff_c_contact' id='staff_c_contact' placeholder='Mobile Number' aria-label='Recipient's username' readonly>
                    <div class='input-group-append'>
                    <button class='btn btn-sm btn-primary' type='button' id='send_otp'>Send OTP</button>
                    </div>
                </div>
                <div class='input-group mt-1 d-none' id='otp_input'>
                    <input type='number' oninput='javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);' maxlength='4' class='form-control py-1' name='staff_c_otp' id='staff_c_otp' placeholder=Enter OTP' aria-label='Recipient's username'>
                    <div class='input-group-append'>
                    <button class='btn btn-sm btn-primary' type='button' id='otp_verify'>Verify</button>
                    </div>
                </div>
            </div>
            <div class='form-group'>
                <label>Customer Email</label>
                <input type='email' name='staff_c_email' id='staff_c_email' class='form-control form-control-sm py-2' placeholder='Email Id' aria-label='Username'>
                <div class='alert alert-danger d-none email_alert mb-0 py-0' role='alert'>
                    Email Aready Exist!Try Another
                </div>
            </div>
            <button type='button' class='btn btn-primary btn-lg btn-block d-none' id='register_customer'>Register</button>
            ";
    }else{

        $get_customer_data = "select * from customers where customer_contact='$cust_contact'";
        $run_customer_data = mysqli_query($con,$get_customer_data);
        $row_customer_data = mysqli_fetch_array($run_customer_data);

        $customer_id = $row_customer_data['customer_id'];
        $customer_name = $row_customer_data['customer_name'];
        $customer_contact = $row_customer_data['customer_contact'];
        $customer_email = $row_customer_data['customer_email'];

        echo "
        <div class='form-group mb-1'>
            <div class='input-group mb-1'>
                <input type='text' class='form-control py-2' value='$customer_name' readonly>
            </div>
            <div class='input-group mb-1'>
                <input type='text' class='form-control py-2' value='$customer_contact' id='cust_con_contact' readonly>
            </div>
            <div class='input-group'>
                <input type='text' class='form-control py-2' value='$customer_email' readonly>
            </div>
            <button name='' id='reset_pass' class='btn btn-danger mt-3' role='button'>Reset Password</button>
        </div>
        <div class='form-group mb-1'>
        ";

        
        $get_cust_add = "select * from customer_address where customer_id='$customer_id'";
        $run_cust_add = mysqli_query($con,$get_cust_add);
        $count_cust_add = mysqli_num_rows($run_cust_add);
        if($count_cust_add>0){
            echo "
            <label><h5 class='card-title mb-0'>Select Address</h5></label>
            <select class='form-control text-dark border-secondary' id='cust_address'>
            ";
        while($row_cust_add = mysqli_fetch_array($run_cust_add)){
            $add_id = $row_cust_add['add_id'];
            $customer_city = $row_cust_add['customer_city'];
            $customer_landmark = $row_cust_add['customer_landmark'];
            $customer_phase = $row_cust_add['customer_phase'];
            $customer_address = $row_cust_add['customer_address'];
            $add_type = $row_cust_add['add_type'];
        echo"
        <option value='$add_id'>$customer_address,$customer_phase,$customer_landmark,$customer_city.</option>
        ";
        }
        echo "</select>
        <h5 class='card-title mb-1 mt-2'>Add Address</h5>
        <div class='row'>
            <div class='col-md-6 px-1'>
                <div class='form-group px-1 mb-1'>
                    <input type='text' id='cust_area' class='form-control py-2 px-1 border-dark' placeholder='Enter Area:Kodibag'/>
                </div>
            </div>
            <div class='col-md-6 px-1'>
                <div class='form-group px-1 mb-1'>
                    <input type='text' id='cust_Landmark' class='form-control py-2 px-1 border-dark' placeholder='Enter Landmark'/>
                </div>
            </div>
        </div>
        <div class='row'>
            <div class='col-md-6 px-1'>
                <div class='form-group px-1 mb-1'>
                    <input type='text' id='customer_address' class='form-control py-2 px-1 border-dark' placeholder='Society & Flat/house no.'/>
                </div>
            </div>
            <div class='col-md-6 px-1'>
                <div class='form-group px-1 mb-1'>
                    <input type='text' id='cust_add_type' class='form-control py-2 px-1 border-dark' placeholder='Address type'/>
                </div>
            </div>
        </div>
        <button class='btn btn-primary btn-lg btn-block py-2' id='add_address'>Add Address</button>
        ";

        }else{
            echo"
            <h5 class='card-title mb-1 mt-2'>Add Address</h5>
        <div class='row'>
            <div class='col-md-6 px-1'>
                <div class='form-group px-1 mb-1'>
                    <input type='text' id='cust_area' class='form-control py-2 px-1 border-dark' placeholder='Enter Area:Kodibag'/>
                </div>
            </div>
            <div class='col-md-6 px-1'>
                <div class='form-group px-1 mb-1'>
                    <input type='text' id='cust_Landmark' class='form-control py-2 px-1 border-dark' placeholder='Enter Landmark'/>
                </div>
            </div>
        </div>
        <div class='row'>
            <div class='col-md-6 px-1'>
                <div class='form-group px-1 mb-1'>
                    <input type='text' id='customer_address' class='form-control py-2 px-1 border-dark' placeholder='Society & Flat/house no.'/>
                </div>
            </div>
            <div class='col-md-6 px-1'>
                <div class='form-group px-1 mb-1'>
                    <input type='text' id='cust_add_type' class='form-control py-2 px-1 border-dark' placeholder='Address type'/>
                </div>
            </div>
        </div>
        <button class='btn btn-primary btn-lg btn-block py-2' id='add_address'>Add Address</button>
        ";
        }

    echo "</div>";
    }

}

if(isset($_POST['cat_id'])){

    $cat_id = $_POST['cat_id'];

    $get_store = "select * from store where cat_id='$cat_id'";
    $run_store = mysqli_query($con,$get_store);
    while($row_store=mysqli_fetch_array($run_store)){

    $store_id = $row_store['store_id'];

    $get_products = "select * from products where store_id='$store_id' and product_visibility='Y'";
                
    $run_products = mysqli_query($con,$get_products);
    
    while($row_products=mysqli_fetch_array($run_products)){

        $pro_id = $row_products['product_id'];
                        
        $pro_title = $row_products['product_title'];
        
        $pro_price = $row_products['product_price'];

        $price_display = $row_products['price_display'];
        
        $pro_desc = $row_products['product_desc'];
        
        $pro_img1 = $row_products['product_img1'];
        
        $pro_stock = $row_products['product_stock'];

        $store_id = $row_products['store_id'];

        $discount = $price_display-$pro_price;
        echo"
        <div class='row rounded mb-2' style='box-shadow:1px 1px 5px 0px #999;'>
            <div class='col-2'>
                <img src='$pro_img1' alt='$pro_title' class='img-thumbnail p-1 mt-2 border-0'>
            </div>
            <div class='col-8'>
                <h5 class='card-title mt-3 mb-1'>$pro_title <small class='card-title'>$pro_desc</small></h5>
                <h6 class='card-title mb-1'> <del><small>₹ $price_display</small></del> ₹ $pro_price</h6>
                <h5><span class='badge badge-success'>Save Rs.$discount</span></h5>
            </div>
            <div class='col-2 pt-3'>
            <h4 class='mb-1 mt-1'><span class='badge badge-danger'>$pro_stock In Stock</span></h4>
                </div>
             </div>
                ";

         }
    }

}

if(isset($_POST['cust_cat_id']) && isset($_POST['cust_cat'])){

    $cat_id = $_POST['cust_cat_id'];
    $cust_cat = $_POST['cust_cat'];

    $get_cust_c_id = "select * from customers where customer_contact='$cust_cat'";
    $run_cust_c_id = mysqli_query($con,$get_cust_c_id);
    $row_cust_c_id = mysqli_fetch_array($run_cust_c_id);
    $row_cust_count = mysqli_num_rows($run_cust_c_id);

    $cust_c_id = $row_cust_c_id['customer_id'];

    $get_store = "select * from store where cat_id='$cat_id'";
    $run_store = mysqli_query($con,$get_store);
    while($row_store=mysqli_fetch_array($run_store)){

    $store_id = $row_store['store_id'];

    $get_products = "select * from products where store_id='$store_id' and product_visibility='Y'";
                
    $run_products = mysqli_query($con,$get_products);
    
    while($row_products=mysqli_fetch_array($run_products)){

        $pro_id = $row_products['product_id'];
                        
        $pro_title = $row_products['product_title'];
        
        $pro_price = $row_products['product_price'];

        $price_display = $row_products['price_display'];
        
        $pro_desc = $row_products['product_desc'];
        
        $pro_img1 = $row_products['product_img1'];
        
        $pro_stock = $row_products['product_stock'];

        $store_id = $row_products['store_id'];

        $discount = $price_display-$pro_price;

        echo"
        <div class='row rounded mb-2' style='box-shadow:1px 1px 5px 0px #999;'>
            <div class='col-2'>
                <img src='$pro_img1' alt='$pro_title' class='img-thumbnail p-1 mt-2 border-0'>
            </div>
            <div class='col-8'>
                <h5 class='card-title mt-3 mb-1'>$pro_title <small class='card-title'>$pro_desc</small></h5>
                <h6 class='card-title mb-1'> <del><small>₹ $price_display</small></del> ₹ $pro_price</h6>
                <h5><span class='badge badge-success'>Save Rs.$discount</span></h5>
            </div>
            <div class='col-2 pt-3'>
                ";
                if($row_cust_count===1){

                    if($pro_stock>0){

                $get_cart = "select * from cart where user_id='$cust_c_id' AND p_id='$pro_id'";

                $run_cart = mysqli_query($con,$get_cart);

                $row_cart=mysqli_fetch_array($run_cart);

                $pro_qty = $row_cart['qty'];

                if($pro_qty>0){

                    echo "

                    <div class='btn-group' role='group' aria-label='Basic example'>
                        <button type='button' class='btn btn-danger text-white p-1 del_pro' id='$pro_id'>
                            <i class='mdi mdi-minus'></i>
                        </button>
                        <button class='btn btn-white text-black p-2'>
                            $pro_qty
                        </button>
                        <button type='button' class='btn btn-danger text-white p-1 add_pro' id='$pro_id'>
                            <i class='mdi mdi-plus'></i>
                        </button>
                    </div>
                    ";
                }else {
                    echo"
                    <button class='btn btn-md btn-danger px-4 add_pro' id='$pro_id'>
                        ADD
                    </button>
                    ";
                }
            }
            }

            echo "
                <h4 class='mb-1 mt-1'><span class='badge badge-danger'>$pro_stock In Stock</span></h4>
            </div>
        </div>
        ";
         }
    }

}

if(isset($_POST['pro_key'])){

    $product_key = $_POST['pro_key'];

    $get_products = "select * from products where LOWER(product_keywords) LIKE LOWER('%$product_key%') and product_visibility='Y'";
                
    $run_products = mysqli_query($con,$get_products);
    
    while($row_products=mysqli_fetch_array($run_products)){

        $pro_id = $row_products['product_id'];
                        
        $pro_title = $row_products['product_title'];
        
        $pro_price = $row_products['product_price'];

        $price_display = $row_products['price_display'];
        
        $pro_desc = $row_products['product_desc'];
        
        $pro_img1 = $row_products['product_img1'];
        
        $pro_stock = $row_products['product_stock'];

        $store_id = $row_products['store_id'];

        $discount = $price_display-$pro_price;
        echo"
        <div class='row rounded mb-2' style='box-shadow:1px 1px 5px 0px #999;'>
            <div class='col-2'>
                <img src='$pro_img1' alt='$pro_title' class='img-thumbnail p-1 mt-2 border-0'>
            </div>
            <div class='col-8'>
                <h5 class='card-title mt-3 mb-1'>$pro_title <small class='card-title'>$pro_desc</small></h5>
                <h6 class='card-title mb-1'> <del><small>₹ $price_display</small></del> ₹ $pro_price</h6>
                <h5><span class='badge badge-success'>Save Rs.$discount</span></h5>
            </div>
            <div class='col-2 pt-3'>
            <h4 class='mb-1 mt-1'><span class='badge badge-danger'>$pro_stock In Stock</span></h4>
                </div>
             </div>
                ";

         }

}

if(isset($_POST['cust_pro_key']) && isset($_POST['cust_pro'])){

    $cust_pro_key = $_POST['cust_pro_key'];
    $cust_pro = $_POST['cust_pro'];

    $get_cust_c_id = "select * from customers where customer_contact='$cust_pro'";
    $run_cust_c_id = mysqli_query($con,$get_cust_c_id);
    $row_cust_c_id = mysqli_fetch_array($run_cust_c_id);
    $row_cust_count = mysqli_num_rows($run_cust_c_id);

    $cust_c_id = $row_cust_c_id['customer_id'];
    //$cust_c_ip = $row_cust_c_id['customer_ip'];

    $get_products = "select * from products where LOWER(product_keywords) LIKE LOWER('%$cust_pro_key%') and product_visibility='Y'";
                
    $run_products = mysqli_query($con,$get_products);
    
    while($row_products=mysqli_fetch_array($run_products)){

        $pro_id = $row_products['product_id'];
                        
        $pro_title = $row_products['product_title'];
        
        $pro_price = $row_products['product_price'];

        $price_display = $row_products['price_display'];
        
        $pro_desc = $row_products['product_desc'];
        
        $pro_img1 = $row_products['product_img1'];
        
        $pro_stock = $row_products['product_stock'];

        $store_id = $row_products['store_id'];

        $discount = $price_display-$pro_price;
        echo"
        <div class='row rounded mb-2' style='box-shadow:1px 1px 5px 0px #999;'>
            <div class='col-2'>
                <img src='$pro_img1' alt='$pro_title' class='img-thumbnail p-1 mt-2 border-0'>
            </div>
            <div class='col-8'>
                <h5 class='card-title mt-3 mb-1'>$pro_title <small class='card-title'>$pro_desc</small></h5>
                <h6 class='card-title mb-1'> <del><small>₹ $price_display</small></del> ₹ $pro_price</h6>
                <h5><span class='badge badge-success'>Save Rs.$discount</span></h5>
            </div>
            <div class='col-2 pt-3'>
                ";

                if($row_cust_count===1){

                if($pro_stock>0){

                $get_cart = "select * from cart where user_id='$cust_c_id' AND p_id='$pro_id'";

                $run_cart = mysqli_query($con,$get_cart);

                $row_cart=mysqli_fetch_array($run_cart);

                $pro_qty = $row_cart['qty'];

                if($pro_qty>0){

                    echo "

                    <div class='btn-group' role='group' aria-label='Basic example'>
                        <button type='button' class='btn btn-danger text-white p-1 del_pro' id='$pro_id'>
                            <i class='mdi mdi-minus'></i>
                        </button>
                        <button class='btn btn-white text-black p-2'>
                            $pro_qty
                        </button>
                        <button type='button' class='btn btn-danger text-white p-1 add_pro' id='$pro_id'>
                            <i class='mdi mdi-plus'></i>
                        </button>
                    </div>
                    ";
                }else {
                    echo"
                    <button class='btn btn-md btn-danger px-4 add_pro' id='$pro_id'>
                        ADD
                    </button>
                    ";
                }
                }
            }

            echo "
                <h4 class='mb-1 mt-1'><span class='badge badge-danger'>$pro_stock In Stock</span></h4>
            </div>
        </div>
        ";
    }

}

if(isset($_POST['cust_cart'])){

    $cust_cart = $_POST['cust_cart'];

    $get_cust_contact = "select * from customers where customer_contact='$cust_cart'";
    $run_cust_contact = mysqli_query($con,$get_cust_contact);
    $row_cust_contact = mysqli_fetch_array($run_cust_contact);
    $row_cust_count = mysqli_num_rows($run_cust_contact);

    $cart_c_id = $row_cust_contact['customer_id'];

    if($row_cust_count===1){

        echo "
        
        <div class='card-header bg-primary'>
            <h4 class='card-title text-center text-white mb-0'>Customer Cart</h4>
        </div>
        <div class='card-body p-1'>
            <div class='container pr-4 cart-body'>
        
        ";

        $select_cart = "select * from cart where user_id='$cart_c_id' order by exp_date desc";
    
        $run_cart = mysqli_query($con,$select_cart);

        $count = mysqli_num_rows($run_cart);

        $counter = 0;
        $total = 0;
        $save_total = 0;
        while($row_cart = mysqli_fetch_array($run_cart)){

            $pro_id = $row_cart['p_id'];

            $pro_qty = $row_cart['qty'];

                $get_products = "select * from products where product_id='$pro_id'";

                $run_products = mysqli_query($con,$get_products);

                $row_products = mysqli_fetch_array($run_products);

                    $product_title = $row_products['product_title'];

                    $product_desc = $row_products['product_desc'];

                    $product_img1 = $row_products['product_img1'];

                    $only_price = $row_products['product_price'];

                    $dis_price = $row_products['price_display'];

                    $sub_total = $row_products['product_price']*$pro_qty;

                    $save = $dis_price*$pro_qty;

                    $total += $sub_total;

                    $save_total += $save;

                    $you_save = $save_total-$total;
                    $counter = ++$counter;


        echo "
        <div class='row'>
            <div class='col-md-2 px-0'>
                <img src='$product_img1' alt='$product_title' class='img img-thumbnail border-0 mx-auto d-block'>
            </div>
            <div class='col-md-7 pt-1'>
                <h5 class='text-left card-title mb-1'>$product_title - $product_desc</h5>
                <h4 class='text-left card-title mb-2'>₹ $only_price</h4>
            </div>
            <div class='col-md-3 pt-2 incre_button' id='$pro_id'>
                <div class='btn-group' role='group' aria-label='Basic example'>
                    <button type='button' class='btn btn-danger text-white p-1 del_pro' id='$pro_id'>
                        <i class='mdi mdi-minus'></i>
                    </button>
                    <button class='btn btn-white text-black p-2'>
                        $pro_qty
                    </button>
                    <button type='button' class='btn btn-danger text-white p-1 add_pro' id='$pro_id'>
                        <i class='mdi mdi-plus'></i>
                    </button>
                </div>
            </div>
        </div>
        <hr class='m-0'>
        ";
            }

            echo "
            
            </div>
            </div>
            <div class='card-footer bg-success py-1'>
                <div class='row py-1'>
                    <div class='col-7'>
                        <h5 class='mb-1 card-title text-white'>Item Count :- $counter</h5>
                        <h4 class='mb-0 card-title text-white'>Total :- ";

                        if($total<300 && $total>0){
                            $get_dchr = "select * from admins";
                            $run_dchr = mysqli_query($con,$get_dchr);
                            $row_dchr = mysqli_fetch_array($run_dchr);
                            $dchar=$row_dchr['del_charges'];
        
                            echo $total+$dchar." <small>(+".$dchar."DL)</small>";
                        }else{
                            echo "$total";
                        }
                        
                        echo "</h4>
                    </div>
                    <div class='col-5'>
                        <button id='confirm_order' class='btn btn-primary btn-block' role='button'>Place Order</button>
                    </div>
                </div>
            </div>

            ";
    }else {
        echo "<h1 class='font-weight-bold text-muted text-center mt-5'>Cart is Empty</h1>";
    }
}

if(isset($_POST['add_pro_id']) && isset($_POST['cust_add_pro'])){
        
    $cust_add_pro = $_POST['cust_add_pro'];
    
    $p_id = $_POST['add_pro_id'];

    $get_cust_c_id = "select * from customers where customer_contact='$cust_add_pro'";
    $run_cust_c_id = mysqli_query($con,$get_cust_c_id);
    $row_cust_c_id = mysqli_fetch_array($run_cust_c_id);

    $user_id = $row_cust_c_id['customer_id'];
    
    $get_stock = "select * from products where product_id='$p_id'";

    $run_stock = mysqli_query($con,$get_stock);

    $row_stock = mysqli_fetch_array($run_stock);

    $stock = $row_stock['product_stock'];

    $p_name = $row_stock['product_title'];
    
    $check_product = "select * from cart where user_id='$user_id' AND p_id='$p_id'";
    
    $run_check = mysqli_query($con,$check_product);

    $row_check = mysqli_fetch_array($run_check);

    $p_qty = $row_check['qty'];

    if($p_qty>=$stock){

        echo "'Product stock is not available'";

    }else{

            if(mysqli_num_rows($run_check)>0){
                
                $update_qty= "update cart set qty=qty+1 where p_id='$p_id' AND user_id='$user_id'";

                $run_update_qty = mysqli_query($con,$update_qty);
            
        }else{
            
                $query = "insert into cart (p_id,user_id,qty,exp_date) values ('$p_id','$user_id','1',NOW())";
                
                $run_query = mysqli_query($con,$query);
                
            
        }
        
        echo 1;

    }
    
}

if(isset($_POST['del_pro_id']) && isset($_POST['cust_del_pro'])){

    $cust_del_pro = $_POST['cust_del_pro'];

    $p_id = $_POST['del_pro_id'];

    $get_cust_c_id = "select * from customers where customer_contact='$cust_del_pro'";
    $run_cust_c_id = mysqli_query($con,$get_cust_c_id);
    $row_cust_c_id = mysqli_fetch_array($run_cust_c_id);

    $user_id = $row_cust_c_id['customer_id'];

    $check_cart = "select * from cart where user_id='$user_id' AND p_id='$p_id'";
    
    $run_check = mysqli_query($con,$check_cart);

    $row_check = mysqli_fetch_array($run_check);

    $qty = $row_check['qty'];


    if($qty>1){

        $update_qty= "update cart set qty=qty-1 where p_id='$p_id' AND user_id='$user_id'";

        $run_update_qty = mysqli_query($con,$update_qty);

        echo 1;

    }else{

        $delete_qty= "delete from cart where p_id='$p_id' AND user_id='$user_id'";

        $run_delete_qty = mysqli_query($con,$delete_qty);

        echo 1;

        //echo "<script>window.open('shop?store_id=$store_id','_self')</script>";

    }
}

if(isset($_POST['confirm_order']) && isset($_POST['cust_address'])){

    $customer_contact = $_POST['confirm_order'];
    $add_id = $_POST['cust_address'];

    date_default_timezone_set('Asia/Kolkata');

    $today = date("Y-m-d H:i:s");

    $get_contact = "select * from customers where customer_contact='$customer_contact'";

    $run_contact = mysqli_query($con,$get_contact);

    $row_contact = mysqli_fetch_array($run_contact);

    $customer_id = $row_contact['customer_id'];
    $c_name = $row_contact['customer_name'];

    $get_unique = "SELECT * from customer_orders order by order_id DESC LIMIT 1";

    $run_unique = mysqli_query($con,$get_unique);

    $row_unique = mysqli_fetch_array($run_unique);

    $unique_num = $row_unique['order_id'];

    $user_id = $customer_id;

    $status = "Order Placed";

    $invoice_no = $unique_num.mt_rand();

    $select_cart = "select * from cart where user_id='$user_id'";

    $run_cart = mysqli_query($con,$select_cart);

    while($row_cart = mysqli_fetch_array($run_cart)){

        $pro_id = $row_cart['p_id'];

        $pro_qty = $row_cart['qty'];

        $get_products = "select * from products where product_id='$pro_id'";

        $run_products = mysqli_query($con,$get_products);

        while($row_products = mysqli_fetch_array($run_products)){

            $sub_total = $row_products['product_price']*$pro_qty;
            $vendor_sub_total = $row_products['vendor_price']*$pro_qty;

            $client_id = $row_products['client_id'];

            $insert_customer_order = "insert into customer_orders (customer_id,add_id,pro_id,due_amount,vendor_due_amount,invoice_no,qty,order_date,del_date,order_status,product_status,client_id) 
            values ('$customer_id','$add_id',' $pro_id','$sub_total','$vendor_sub_total','$invoice_no','$pro_qty','$today','$today','$status','Deliver','$client_id')";    

            $run_customer_order = mysqli_query($con,$insert_customer_order);

            $delete_cart = "delete from cart where user_id='$user_id'";

            $run_delete = mysqli_query($con,$delete_cart);

            $update_stock = "UPDATE products SET product_stock=product_stock-'$pro_qty' WHERE product_id='$pro_id'";

            $run_update_stock = mysqli_query($con,$update_stock);

        }
    }
    if($run_customer_order){

        $get_dis_total = "select sum(due_amount) as dis_total from customer_orders WHERE invoice_no='$invoice_no'";
        $run_dis_total = mysqli_query($con,$get_dis_total);
        $row_dis_total = mysqli_fetch_array($run_dis_total);

        $dis_total = $row_dis_total['dis_total'];

        $get_user_order_count = "SELECT customer_id,invoice_no FROM customer_orders WHERE customer_id='$customer_id' GROUP BY customer_id,invoice_no";
        $run_user_orders_count = mysqli_query($con,$get_user_order_count);
        $user_orders_count = mysqli_num_rows($run_user_orders_count);

        if($user_orders_count==1 && $dis_total>300){
         $insert_discount = "insert into customer_discounts (invoice_no,discount_type,discount_amount,discount_date) values ('$invoice_no','First Order Discount','25','$today')";
         $run_insert_discount = mysqli_query($con,$insert_discount);
        }
        
    }

    if($run_customer_order){
        
        $get_del_total = "select sum(due_amount) as del_total from customer_orders WHERE invoice_no='$invoice_no'";
        $run_del_total = mysqli_query($con,$get_del_total);
        $row_del_total = mysqli_fetch_array($run_del_total);

        $del_total = $row_del_total['del_total'];

        $get_del_charges = "select * from admins";
        $run_del_charges = mysqli_query($con,$get_del_charges);
        $row_del_charges = mysqli_fetch_array($run_del_charges);

        $del_charges = $row_del_charges['del_charges'];

        if($del_total<300){
            $insert_del_charges = "insert into order_charges (invoice_id,del_charges,updated_date) values ('$invoice_no','$del_charges','$today')";
            $run_insert_del_charges = mysqli_query($con,$insert_del_charges);
        }
    }

    if($run_customer_order){

        $insert_call = "insert into cron_call (invoice_no,cron_call_status,updated_date) values ('$invoice_no','false','$today')";
        $run_insert_call = mysqli_query($con,$insert_call);     
    }

    if($run_customer_order){
        
        $key = "EALz6t0ZsHkQ9WPx";
        $senderid="VRNEAR";	$route= 1;
        
        $text1 = "Thank%20You,%20Your%20Order%20is%20Placed%20Successfully,%20Call%207892916394%20For%20Support";
        $text2 = "New%20Order%20received%20on%20the%20portal";
        //echo $url = "https://smsapi.engineeringtgr.com/send/?Mobile=9636286923&Password=DEZIRE&Message=".$m."&To=".$tel."&Key=parasnovxRI8SYDOwf5lbzkZc6LC0h"; 
        // $url1="http://weberleads.in/http-api.php?username=TEJAS97&password=pwd5634&senderid=WEBERL&route=2&number=$c_contact&message=$text1";
        // $url2="http://weberleads.in/http-api.php?username=TEJAS97&password=pwd5634&senderid=WEBERL&route=2&number=7892916394&message=$text2";
        // $url1 = "http://www.bulksmsplans.com/api/send_sms_multi?api_id=APIMerR2yHK34854&api_password=wernear_11&sms_type=Transactional&sms_encoding=text&sender=VRNEAR&message=$text1&number=+91$c_contact";
        // $url2 = "http://www.bulksmsplans.com/api/send_sms_multi?api_id=APIMerR2yHK34854&api_password=wernear_11&sms_type=Transactional&sms_encoding=text&sender=VRNEAR&message=$text2&number=+917892916394";
        $url1 = "https://www.hellotext.live/vb/apikey.php?apikey=$key&senderid=$senderid&route=$route&number=$customer_contact&message=$text1";
        $url2 = "https://www.hellotext.live/vb/apikey.php?apikey=$key&senderid=$senderid&route=$route&number=7892916394&message=$text2";

        // create both cURL resources
        $ch1 = curl_init();
        $ch2 = curl_init();

        // set URL and other appropriate options
        curl_setopt($ch1, CURLOPT_URL, $url1);
        curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch2, CURLOPT_URL, $url2);
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);

        //create the multiple cURL handle
        $mh = curl_multi_init();

        //add the two handles
        curl_multi_add_handle($mh,$ch1);
        curl_multi_add_handle($mh,$ch2);

        //execute the multi handle
        do {
            $status = curl_multi_exec($mh, $active);
            if ($active) {
                curl_multi_select($mh);
            }
        } while ($active && $status == CURLM_OK);

        //close the handles
        curl_multi_remove_handle($mh, $ch1);
        curl_multi_remove_handle($mh, $ch2);
        curl_multi_close($mh);
    }

    if($run_customer_order){

        $employee_id=$_SESSION['employee_id'];

        $insert_emp_order = "insert into employee_orders (employee_id,invoice_id,employee_action,updated_date) values ('$employee_id','$invoice_no','created','$today')";
        $run_insert_emp_order = mysqli_query($con,$insert_emp_order);

        echo 1;
    }
}

if(isset($_POST['staff_c_name']) && isset($_POST['staff_c_contact']) && isset($_POST['staff_c_email'])){

    $c_name = $_POST['staff_c_name'];
    $c_contact = $_POST['staff_c_contact'];
    $c_email = $_POST['staff_c_email'];

    function rand_string( $length ) {

        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        return substr(str_shuffle($chars),0,$length);
        
        }

    $pass = rand_string(6);
    $c_pass = password_hash($pass, PASSWORD_DEFAULT);

    $insert_customer = "insert into customers (customer_name,customer_contact,customer_email,customer_pass,updated_date) 
    values ('$c_name','$c_contact','$c_email','$c_pass',NOW())";

    $run_customer = mysqli_query($con,$insert_customer);

    if($run_customer){
        $key = "EALz6t0ZsHkQ9WPx";
        $senderid="VRNEAR";	$route= 1;
        $text = "Thank%20You%20for%20Registration%20Please%20Login%20with%20Below%20Details%0aUsername:%20$c_email%0aPassword:%20$pass";

        //echo $url = "https://smsapi.engineeringtgr.com/send/?Mobile=9636286923&Password=DEZIRE&Message=".$m."&To=".$tel."&Key=parasnovxRI8SYDOwf5lbzkZc6LC0h"; 
        //  $url = "http://api.bulksmsplans.com/api/SendSMS?api_id=API31873059460&api_password=W3cy615F&sms_type=T&encoding=T&sender_id=VRNEAR&phonenumber=91$c_contact&textmessage=$text";
        // $url = "http://www.bulksmsplans.com/api/send_sms_multi?api_id=APIMerR2yHK34854&api_password=wernear_11&sms_type=Transactional&sms_encoding=text&sender=VRNEAR&message=$text&number=+91$c_contact";
        $url = "https://www.hellotext.live/vb/apikey.php?apikey=$key&senderid=$senderid&route=$route&number=$c_contact&message=$text";

        // Initialize a CURL session.
     $ch = curl_init();  
     
     // Return Page contents. 
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
     
     //grab URL and pass it to the variable. 
     curl_setopt($ch, CURLOPT_URL, $url); 
     
     $result = curl_exec($ch);

     echo $c_contact;
    }
}

if(isset($_POST['cust_email'])){

    $customer_email = $_POST['cust_email'];

    $get_cust_count = "select * from customers where customer_email='$customer_email'";
    $run_cust_count = mysqli_query($con,$get_cust_count); 
    $check_email = mysqli_num_rows($run_cust_count);

    if(!$check_email==0){
        echo 1;
    }
}

if(isset($_POST['send_otp'])){
    $c_contact = $_POST['send_otp'];

    date_default_timezone_set('Asia/Kolkata');

    $today = date("Y-m-d H:i:s");

    function rand_string( $length ) {

        $chars = "0123456789";
        return substr(str_shuffle($chars),0,$length);
        
        }

    $c_otp = rand_string(4);

    $insert_otp = "insert into otp_verefication (contact_no,verification_otp,updated_date) values ('$c_contact','$c_otp','$today')";
    $run_insert_otp = mysqli_query($con,$insert_otp);

    if($insert_otp){

        $key = "EALz6t0ZsHkQ9WPx";
        $senderid="VRNEAR";	$route= 1;
        $text = "$c_otp%20is%20your%20one%20time%20password%20and%20it%20is%20valid%20for%20the%20next%2015%20mins.%20Please%20do%20not%20share%20this%20OTP%20with%20anyone.%20Thank%20you,%20Karwars%20Onine%20Supermarket.";

        //echo $url = "https://smsapi.engineeringtgr.com/send/?Mobile=9636286923&Password=DEZIRE&Message=".$m."&To=".$tel."&Key=parasnovxRI8SYDOwf5lbzkZc6LC0h"; 
        //  $url = "http://api.bulksmsplans.com/api/SendSMS?api_id=API31873059460&api_password=W3cy615F&sms_type=T&encoding=T&sender_id=VRNEAR&phonenumber=91$c_contact&textmessage=$text";
        // $url = "http://www.bulksmsplans.com/api/send_sms_multi?api_id=APIMerR2yHK34854&api_password=wernear_11&sms_type=Transactional&sms_encoding=text&sender=VRNEAR&message=$text&number=+91$c_contact";
        $url = "https://www.hellotext.live/vb/apikey.php?apikey=$key&senderid=$senderid&route=$route&number=$c_contact&message=$text";

        // Initialize a CURL session.
        $ch = curl_init();  
        
        // Return Page contents. 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        
        //grab URL and pass it to the variable. 
        curl_setopt($ch, CURLOPT_URL, $url); 
        
        $result = curl_exec($ch);

        echo 1;
    }
}

if(isset($_POST['otp_verify'])){
    $otp_verify = $_POST['otp_verify'];

    $check_otp = "select * from otp_verefication where verification_otp='$otp_verify' order by verification_id desc limit 1";
    $run_check_otp = mysqli_query($con,$check_otp);
    $check_otp_count = mysqli_num_rows($run_check_otp);

    if($check_otp_count==1){

        $delete_otp = "delete from otp_verefication where verification_otp='$otp_verify'";
        $run_delete_otp = mysqli_query($con,$delete_otp);

        echo 1;
    }
}

if(isset($_POST['cust_for_add']) && isset($_POST['cust_area']) && isset($_POST['cust_Landmark']) && isset($_POST['customer_address']) && isset($_POST['cust_add_type'])){

    $c_contact = $_POST['cust_for_add'];

    $cust_Landmark = $_POST['cust_Landmark'];

    $c_phase = $_POST['cust_area'];

    $customer_address = $_POST['customer_address'];

    $cust_add_type = $_POST['cust_add_type'];
    
    $get_user_id = "select * from customers where customer_contact='$c_contact'";

    $run_user_id = mysqli_query($con,$get_user_id);

    $row_user_id = mysqli_fetch_array($run_user_id);

    $user_c_id = $row_user_id['customer_id'];

    $insert_add = "insert into customer_address (customer_id,customer_city,customer_landmark,customer_phase,customer_address,add_type) 
    values ('$user_c_id','Karwar','$cust_Landmark','$c_phase','$customer_address','$cust_add_type')";

    $run_add = mysqli_query($con,$insert_add);


    if($insert_add){

       echo 1;

    }else{

        echo 2;

    }
}

if(isset($_POST['cust_reset_pass'])){

    $c_contact = $_POST['cust_reset_pass'];

    function rand_string( $length ) {

        $chars = "0123456789";
        return substr(str_shuffle($chars),0,$length);
        
        }

    $pass = rand_string(6);
    $c_pass = password_hash($pass, PASSWORD_DEFAULT);

    $update_pass = "update customers set customer_pass='$c_pass' where customer_contact='$c_contact'";
    $run_pass = mysqli_query($con,$update_pass);

    if($run_pass){
        $key = "EALz6t0ZsHkQ9WPx";
        $senderid="VRNEAR";	$route= 1;
        $text = "Your%20Password%20is%20reset%20to%20$pass";

        //echo $url = "https://smsapi.engineeringtgr.com/send/?Mobile=9636286923&Password=DEZIRE&Message=".$m."&To=".$tel."&Key=parasnovxRI8SYDOwf5lbzkZc6LC0h"; 
        //  $url = "http://api.bulksmsplans.com/api/SendSMS?api_id=API31873059460&api_password=W3cy615F&sms_type=T&encoding=T&sender_id=VRNEAR&phonenumber=91$c_contact&textmessage=$text";
        // $url = "http://www.bulksmsplans.com/api/send_sms_multi?api_id=APIMerR2yHK34854&api_password=wernear_11&sms_type=Transactional&sms_encoding=text&sender=VRNEAR&message=$text&number=+91$c_contact";
        $url = "https://www.hellotext.live/vb/apikey.php?apikey=$key&senderid=$senderid&route=$route&number=$c_contact&message=$text";

        // Initialize a CURL session.
     $ch = curl_init();  
     
     // Return Page contents. 
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
     
     //grab URL and pass it to the variable. 
     curl_setopt($ch, CURLOPT_URL, $url); 
     
     $result = curl_exec($ch);

     echo 1;
    }
}
?>
