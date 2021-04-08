<div class="container-fluid p-2">
    <?php 
    
    $employee_id = $_SESSION['employee_id'];
    $get_reports = "SELECT * FROM employee_orders where employee_id='$employee_id' and employee_action='created' GROUP BY CAST(updated_date as DATE) order by updated_date desc";
    $run_reports = mysqli_query($con,$get_reports);
    $counter = 0;
    while($row_reports = mysqli_fetch_array($run_reports)){
        $report_date = $row_reports['updated_date'];
        $dis_report_date = date('Y-m-d',strtotime($report_date));
    ?>
    <div id="accordion">
        <div class="card">
            <div class="card-header bg-white rounded" id="headingOne">
            <h5 class="mb-0 text-center">
                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                <h5 class="card-title mb-0">Orders data for the date <?php echo date('d-M-Y',strtotime($report_date)); ?></h5>
                </button>
            </h5>
            </div>

            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-center">
                            <thead class="bg-secondary">
                                <tr>
                                <th>Time</th>
                                <th>Invoice No.</th>
                                <th>Customer</th>
                                <th>Price</th>
                                <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                
                                $get_distinct_order = "select * from employee_orders where employee_id='$employee_id' and CAST(updated_date as DATE)='$dis_report_date'";
                                $run_distinct_order = mysqli_query($con,$get_distinct_order);
                                while($row_distinct_order=mysqli_fetch_array($run_distinct_order)){
                                    $invoice_id = $row_distinct_order['invoice_id'];
                                $get_orders = "select * from customer_orders where invoice_no='$invoice_id'";
                                $run_orders = mysqli_query($con,$get_orders);
                                    $row_orders=mysqli_fetch_array($run_orders);
                                    $invoice_no = $row_orders['invoice_no'];
                                    $order_status = $row_orders['order_status'];
                                    $customer_id = $row_orders['customer_id'];
                                    $order_date = $row_orders['order_date'];

                                    $get_customer = "select * from customers where customer_id='$customer_id'";
                                    $run_customer = mysqli_query($con,$get_customer);
                                    $row_customer = mysqli_fetch_array($run_customer);
                                    $customer_name = $row_customer['customer_name'];

                                    $get_order_total = "select sum(due_amount) as order_total from customer_orders where invoice_no='$invoice_no' and product_status='Deliver'";
                                    $run_order_total = mysqli_query($con,$get_order_total);
                                    $row_order_total = mysqli_fetch_array($run_order_total);

                                    $order_total = $row_order_total['order_total'];
                                ?>
                                <tr>
                                <td><?php echo date('H:m a',strtotime($order_date)); ?></td>
                                <td><?php echo $invoice_no; ?></td>
                                <td><?php echo $customer_name; ?></td>
                                <td><?php echo $order_total; ?>/-</td>
                                <td><label class="badge badge-<?php if($order_status==='Order Placed'){echo'warning';}elseif($order_status==='Delivered'){echo'success';}elseif($order_status==='Cancelled'){echo'danger';} ?>"><?php echo $order_status; ?></label></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>