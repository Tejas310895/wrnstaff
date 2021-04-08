<div class="container-fluid mt-2">
    <div class="row">
        <!-- customer panel -->
            <div class="col-md-3 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header bg-info">
                        <h4 class="card-title text-center text-white mb-0">Customer Details</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="number" class="form-control rounded" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10" id='search_contact' placeholder="Customer Number" aria-label="Recipient's username">
                                <div class="input-group-append">
                                <button class="btn btn-sm btn-primary" id='customer_search' type="button">Search</button>
                                </div>
                            </div>
                        </div>   
                        <div id="fetch_cust_data">
                            
                        </div>
                    </div>
                </div>
            </div>
        <!-- customer panel -->
        <!-- Product panel -->
            <div class="col-md-6 grid-margin stretch-card" style="height:550px;">
                <div class="card">
                    <div class="card-body p-1">
                        <div class="row" id="search_box">
                            <div class="col-3">
                                <div class="form-group mb-0">
                                    <select class="js-example-basic-single w-100 bg-primary" id="search_cat">
                                    <option disabled selected value="disable_cat">Select Categories</option>
                                    <?php 
                                    
                                    $get_cat = "select * from categories";
                                    $run_cat = mysqli_query($con,$get_cat);
                                    while($row_cat = mysqli_fetch_array($run_cat)){
                                    
                                    $cat_id = $row_cat['cat_id'];
                                    $cat_title = $row_cat['cat_title'];

                                    ?>
                                    <option value="<?php echo $cat_id; ?>"><?php echo $cat_title; ?></option>
                                    <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="form-group mb-1">
                                    <input type="text" class="form-control rounded border-secondary text-center py-1" id='search_product' placeholder="Search Product" aria-label="Recipient's username">
                                </div> 
                            </div>
                        </div>
                        <div class="container p-4" id="product_fetch" style="height:500px;overflow-y:auto;">
                            
                        </div>
                    </div>
                </div>
            </div>
        <!-- Product panel -->
        <!-- cart panel -->
            <div class="col-md-3 grid-margin stretch-card">
                <div class="card" id="cart_box">
                    
                </div>
            </div>
        <!-- cart panel -->
    </div>
</div>
    <script>
        window.onbeforeunload = function(event) {
            return confirm("Confirm refresh");
        };
    </script>
<script src='https://code.jquery.com/jquery-1.12.4.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.js'></script>
<script src='https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js' defer></script>
<script src='https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.js' defer></script>
<script src='https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.js' defer></script>
<script src='https://cdn.datatables.net/buttons/1.5.1/js/buttons.bootstrap.js' defer></script>
<script src='https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.js' defer></script>
<script  src='js/datatable.js'></script>
<script  src='js/create_order.js?v=1'></script>
