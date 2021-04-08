$(document).ready(function () {
    $("#customer_search").click(function (e) { 
        e.preventDefault();
        var cust_contact = $("#search_contact").val();

        if(cust_contact.length<10) {
            alert('Please enter number properly');
        }else{
        $.ajax({
            type: "post",
            url: "./ajax/create_order.php",
            data: {"cust_contact":cust_contact},
            success: function (data) {
                $("#fetch_cust_data").html(data);
                $('#product_fetch').load(location.href + " #product_fetch");
                $('#staff_c_contact').val(cust_contact);
                $.ajax({
                    type: "post",
                    url: "./ajax/create_order.php",
                    data: {"cust_cart":cust_contact},
                    success: function (data) {
                        $("#cart_box").html(data);
                    }
                });
            }
        });
     }
    });

    $("#search_cat").change(function (e) { 
        e.preventDefault();
        if(!$("#cust_con_contact").val()){
            var cat_id = $("#search_cat").val();
            $.ajax({
                type: "post",
                url: "./ajax/create_order.php",
                data: {"cat_id":cat_id},
                success: function (data) {
                    $("#product_fetch").html(data);
                }
            });
        }else{
            var cust_cat = $("#cust_con_contact").val();
            var cust_cat_id = $("#search_cat").val();
            $.ajax({
                type: "post",
                url: "./ajax/create_order.php",
                data: {"cust_cat":cust_cat,
                       "cust_cat_id":cust_cat_id},
                success: function (data) {
                    $("#product_fetch").html(data);
                }
            });
        }
    });

    $("#search_product").keyup(function (e) { 
        e.preventDefault();
        if(!$("#cust_con_contact").val()){
            var pro_key = $("#search_product").val();
            $.ajax({
                type: "post",
                url: "./ajax/create_order.php",
                data: {"pro_key":pro_key},
                success: function (data) {
                    $("#product_fetch").html(data);
                }
            });
        }else{
            var cust_pro = $("#cust_con_contact").val();
            var cust_pro_key = $("#search_product").val();
            $.ajax({
                type: "post",
                url: "./ajax/create_order.php",
                data: {"cust_pro":cust_pro,
                       "cust_pro_key":cust_pro_key},
                success: function (data) {
                    $("#product_fetch").html(data);
                }
            });
        }
    });

    $(document).on('click', '.add_pro', function () {
        var add_pro_id = $(this).attr('id');
        var cust_add_pro = $("#cust_con_contact").val();
        if(!$("#search_contact").val()){
            alert("Please Select the customer first");
        }else{
        $.ajax({
            type: "post",
            url: "./ajax/create_order.php",
            data: {"add_pro_id":add_pro_id,
                    "cust_add_pro":cust_add_pro},
            success: function (data) {
                
                if(data==1){
                    $('#product_fetch').load(location.href + " #product_fetch");
                    $.ajax({
                        type: "post",
                        url: "./ajax/create_order.php",
                        data: {"cust_cart":cust_add_pro},
                        success: function (data) {
                            $("#cart_box").html(data);
                        }
                    });
                }else{
                    alert(data);
                }
            }
        });
         }
    });

    $(document).on('click', '.del_pro', function () {
        var del_pro_id = $(this).attr('id');
        var cust_del_pro = $("#cust_con_contact").val();
        if(!$("#search_contact").val()){
            alert("Please Select the customer first");
        }else{
        $.ajax({
            type: "post",
            url: "./ajax/create_order.php",
            data: {"del_pro_id":del_pro_id,
                    "cust_del_pro":cust_del_pro},
            success: function (data) {
            
                if(data==1){
                    $('#product_fetch').load(location.href + " #product_fetch");
                    $.ajax({
                        type: "post",
                        url: "./ajax/create_order.php",
                        data: {"cust_cart":cust_del_pro},
                        success: function (data) {
                            $("#cart_box").html(data);
                        }
                    });
                }else{
                    alert('failed');
                }
            }
        });
         }
    });

    $(document).on('click', '#confirm_order', function () {
        var isSure = confirm("Are you the Sure?");
        if(isSure===true){
        var cust_address = $('#cust_address').val();
        var confirm_order = $("#cust_con_contact").val();
        if(!$("#search_contact").val()){
            alert("Please Select the customer first");
        }else{
            $.ajax({
                type: "post",
                url: "./ajax/create_order.php",
                data: {"confirm_order":confirm_order,
                        "cust_address":cust_address},
                success: function (data) {
                    if(data==1){
                        alert('Order Generated Successfully');
                        window.open('./index.php?order_new','_self');
                    }else{
                        alert('Order Generation Failed');
                    }
                }
            });

         }
        }
    });
    
    $(document).on('click', '#register_customer', function () {
        var staff_c_name = $('#staff_c_name').val();
        var staff_c_contact = $("#staff_c_contact").val();
        var staff_c_otp = $("#staff_c_otp").val();
        var staff_c_email = $("#staff_c_email").val();

        if(staff_c_name.length<1 || staff_c_contact.length<1 || staff_c_email.length<1 || staff_c_otp.length<1){
            alert('Some Inputs are pending');
        }else{
        $.ajax({
            type: "post",
            url: "./ajax/create_order.php",
            data: {"staff_c_name":staff_c_name,
                    "staff_c_contact":staff_c_contact,
                    "staff_c_email":staff_c_email},
            success: function (data) {
               if(!data){
                    alert('Error Try Again');
               }else{
                    $.ajax({
                        type: "post",
                        url: "./ajax/create_order.php",
                        data: {"cust_contact":staff_c_contact},
                        success: function (data) {
                            $("#fetch_cust_data").html(data);
                            $('#product_fetch').load(location.href + " #product_fetch");
                            $.ajax({
                                type: "post",
                                url: "./ajax/create_order.php",
                                data: {"cust_cart":staff_c_contact},
                                success: function (data) {
                                    $("#cart_box").html(data);
                                }
                            });
                        }
                    });
               }
            }
        });
    }
    });

    $(document).on('change', '#staff_c_email', function () {
        var cust_email = $(this).val();

        $.ajax({
            type: "post",
            url: "./ajax/create_order.php",
            data: {"cust_email":cust_email},
            success: function (data) {
                if(data==1){
                    $('.email_alert').removeClass('d-none');
                    $('#staff_c_email').val('');
                }else{
                    $('.email_alert').addClass('d-none');
                }
            }
        });
    });

    $(document).on('click', '#send_otp', function () {
        var send_otp = $("#staff_c_contact").val();

        if(send_otp.length<10){
            alert('Enter mobile number properly');
        }else{
        $.ajax({
            type: "post",
            url: "./ajax/create_order.php",
            data: {"send_otp":send_otp},
            success: function (data) {
                if(data==1){
                $('#otp_input').removeClass('d-none');
                }else{
                    alert('Error, Try Again');
                }
            }
        });
    }
    });

    $(document).on('click', '#otp_verify', function () {
        var otp_verify = $("#staff_c_otp").val();

        if(otp_verify.length<4){
            alert('Enter OTP properly');
        }else{
        $.ajax({
            type: "post",
            url: "./ajax/create_order.php",
            data: {"otp_verify":otp_verify},
            success: function (data) {
                if(data==1){
                $('#otp_input').addClass('d-none');
                $('#send_otp').addClass('d-none');
                $('#register_customer').removeClass('d-none');
                }else{
                    alert('Wrong Otp, Try Again');
                }
            }
        });
    }
    });

    $(document).on('click', '#add_address', function () {
        var cust_for_add = $("#cust_con_contact").val();
        var cust_area = $("#cust_area").val();
        var cust_Landmark = $("#cust_Landmark").val();
        var customer_address = $("#customer_address").val();
        var cust_add_type = $("#cust_add_type").val();

        if(cust_area.length<1 || cust_Landmark.length<1 || customer_address.length<1 || cust_add_type.length<1){
            alert('Enter Address Completely');
        }else{
        $.ajax({
            type: "post",
            url: "./ajax/create_order.php",
            data: {"cust_for_add":cust_for_add,
                   "cust_area":cust_area,
                   "cust_Landmark":cust_Landmark,
                   "customer_address":customer_address,
                   "cust_add_type":cust_add_type},
            success: function (data) {
                if(data==1){
                    alert('Address Inserted Successfully');
                    $.ajax({
                        type: "post",
                        url: "./ajax/create_order.php",
                        data: {"cust_contact":cust_for_add},
                        success: function (data) {
                            $("#fetch_cust_data").html(data);
                            $('#product_fetch').load(location.href + " #product_fetch");
                            $.ajax({
                                type: "post",
                                url: "./ajax/create_order.php",
                                data: {"cust_cart":cust_for_add},
                                success: function (data) {
                                    $("#cart_box").html(data);
                                }
                            });
                        }
                    });
                }else{
                    alert('Error, Try Again');
                }
            }
        });
    }
    });

    $(document).on('click', '#reset_pass', function () {
        var cust_reset_pass = $("#cust_con_contact").val();
        
        $.ajax({
            type: "post",
            url: "./ajax/create_order.php",
            data: {"cust_reset_pass":cust_reset_pass},
            success: function (data) {
               if(data==1){
                alert('Password reset Successfull');
               }else{
                alert('Password reset Failed');
               }
            }
        });
    });
});