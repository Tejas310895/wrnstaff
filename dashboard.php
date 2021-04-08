<div class="content-wrapper">
					<div class="row">
						<div class="col-lg-3 grid-margin stretch-card">
							<div class="card">
								<div class="card-body pb-0">
									<div class="d-flex align-items-center justify-content-between">
										<h2 class="text-danger font-weight-bold">
											<?php 
											date_default_timezone_set('Asia/Kolkata');
											$today = date("Y-m-d H:i:s");

											$get_order_count = "select count(*) as order_count from employee_orders where employee_id='$employee_id' and updated_date='$today'";
											$run_order_count = mysqli_query($con,$get_order_count);
											$row_order_count = mysqli_fetch_array($run_order_count);

											echo $row_order_count['order_count'];

											?>
										</h2>
										<i class="mdi mdi mdi-cart-outline mdi-18px text-dark"></i>
									</div>
								</div>
								<canvas id="allProducts"></canvas>
								<div class="line-chart-row-title">ORDERS TODAY</div>
							</div>
						</div>
						<div class="col-lg-3 grid-margin stretch-card">
							<div class="card">
								<div class="card-body pb-0">
									<div class="d-flex align-items-center justify-content-between">
										<h2 class="text-info font-weight-bold">
											<?php 
												date_default_timezone_set('Asia/Kolkata');
												$today = date("Y-m-d H:i:s");

												$get_order_total = "select count(*) as order_total from employee_orders where employee_id='$employee_id'";
												$run_order_total = mysqli_query($con,$get_order_total);
												$row_order_total = mysqli_fetch_array($run_order_total);

												echo $row_order_total['order_total'];

											?>
										</h2>
										<i class="mdi mdi-cart-outline mdi-18px text-dark"></i>
									</div>
								</div>
								<canvas id="invoices"></canvas>
								<div class="line-chart-row-title">ORDERS TOTAL</div>
							</div>
						</div>
						<div class="col-lg-3 grid-margin stretch-card">
							<div class="card">
								<div class="card-body pb-0">
									<div class="d-flex align-items-center justify-content-between">
										<h2 class="text-warning font-weight-bold">
										<?php 
											date_default_timezone_set('Asia/Kolkata');
											$today = date("Y-m-d H:i:s");

											$get_purchase_today = "select * from employee_orders where employee_id='$employee_id' and updated_date='$today'";
											$run_purchase_today = mysqli_query($con,$get_purchase_today);
											$purchase_today = 0;
											while($row_purchase_today = mysqli_fetch_array($run_purchase_today)){
											$invoice_id = $row_purchase_today['invoice_id'];

											$get_order_amount_today = "select sum(due_amount) as order_amount_today from customer_orders where invoice_no='$invoice_id'";
											$run_order_amount_today = mysqli_query($con,$get_order_amount_today);
											$row_order_amount_today = mysqli_fetch_array($run_order_amount_today);
											$order_amount_today = $row_order_amount_today['order_amount_today'];

											$purchase_today += $order_amount_today;
											}
											echo $purchase_today;

										?>
										</h2>
										<i class="mdi mdi mdi-cash mdi-18px text-dark"></i>
									</div>
								</div>
								<canvas id="projects"></canvas>
								<div class="line-chart-row-title">PURCHASE TODAY</div>
							</div>
						</div>
						<div class="col-lg-3 grid-margin stretch-card">
							<div class="card">
								<div class="card-body pb-0">
									<div class="d-flex align-items-center justify-content-between">
										<h2 class="text-secondary font-weight-bold">
										<?php 
											$get_purchase_total = "select * from employee_orders where employee_id='$employee_id'";
											$run_purchase_total = mysqli_query($con,$get_purchase_total);
											$purchase_total = 0;
											while($row_purchase_total = mysqli_fetch_array($run_purchase_total)){
											$invoice_id = $row_purchase_total['invoice_id'];

											$get_order_amount_total = "select sum(due_amount) as order_amount_total from customer_orders where invoice_no='$invoice_id'";
											$run_order_amount_total = mysqli_query($con,$get_order_amount_total);
											$row_order_amount_total = mysqli_fetch_array($run_order_amount_total);
											$order_amount_total = $row_order_amount_total['order_amount_total'];

											$purchase_total += $order_amount_total;
											}
											echo $purchase_total;

										?>
										</h2>
										<input type="hidden" id="purchase_total" value="<?php echo $purchase_total; ?>">
										<i class="mdi mdi mdi-cash mdi-18px text-dark"></i>
									</div>
								</div>
								<canvas id="orderRecieved"></canvas>
								<div class="line-chart-row-title">PURCHASE TOTAL</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6 grid-margin grid-margin-md-0 stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                        <thead>
                                            <tr>
                                            <th>Profile</th>
                                            <th>VatNo.</th>
                                            <th>Created</th>
                                            <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php 
										
										$get_latest = "select * from employee_orders where employee_id='$employee_id' order by employee_order_id desc";
										$run_latest = mysqli_query($con,$get_latest);
										while($row_latest=mysqli_fetch_array($run_latest)){
											$invoice_id = $row_latest['invoice_id'];
											$invoice_date = $row_latest['updated_date'];

											$get_latest_orders = "select * from customer_orders where invoice_no='$invoice_id'";
											$run_latest_orders = mysqli_query($con,$get_latest_orders);
											$row_latest_orders = mysqli_fetch_array($run_latest_orders);

											$customer_id = $row_latest_orders['customer_id'];
											$order_status = $row_latest_orders['order_status'];

											$get_latest_customer = "select * from customers where customer_id='$customer_id'";
											$run_latest_customer = mysqli_query($con,$get_latest_customer);
											$row_latest_customer = mysqli_fetch_array($run_latest_customer);

											$customer_name = $row_latest_customer['customer_name'];
										
										?>
                                            <tr>
                                            <td><?php echo $customer_name; ?></td>
                                            <td><?php echo $invoice_id; ?></td>
                                            <td><?php echo date('Y-m-d',strtotime($invoice_date)); ?></td>
                                            <td><label class="badge badge-<?php if($order_status==='Order Placed'){echo'warning';}elseif($order_status==='Delivered'){echo'success';}elseif($order_status==='Cancelled'){echo'danger';} ?>"><?php echo $order_status; ?></label></td>
                                            </tr>
											<?php } ?>
                                        </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
						</div>
						<div class="col-sm-6 grid-margin grid-margin-md-0 stretch-card">
							<div class="card">
								<div class="card-body">
									<div class="d-lg-flex align-items-center justify-content-between mb-4">
										<h4 class="card-title">Todays Purchase</h4>
									</div>
									<div class="product-order-wrap padding-reduced">
										<div id="productorder-gage" class="gauge productorder-gage"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>