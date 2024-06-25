<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
					<div class="row">
						<div class="col">
						<h6><?php echo $title ?> Table</h6>	
						</div>
					</div>
					<?php if($this->session->flashdata('error')): ?>
                    <div class="alert text-white alert-danger alert-dismissible fade show" role="alert">
                      <?php echo $this->session->flashdata('error'); ?>
							<a href="<?php echo base_url('/auth') ?>" type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>x</a>
                    </div>
                	<?php endif; ?>
					<?php if($this->session->flashdata('success')): ?>
						<div class="alert text-white alert-success alert-dismissible fade show" role="alert">
							<?php echo $this->session->flashdata('success'); ?>
							<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>x</button>
						</div>
					<?php endif; ?>
                    <!-- <h6>Product table</h6> -->
                </div>
				
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-3">
                        <table id="example" class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Product</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        No order</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Jumlah</th>
									<th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Nominal</th>
									<th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status</th>
									<th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Name</th>
									<th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Email</th>
									<th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Phone</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
								<?php foreach($transactions as $transaction): ?>
									<tr>
										<td >
										<img src="<?php echo base_url('assets/'.$transaction['product']['img']) ?>" style="border-radius:20px" width="250" class=""
												alt="user1">
											
										</td>
										<td>
											<a href="<?php echo base_url('payment?trx='.$transaction['no_order']) ?>">
												<p class="text-xs font-weight-bold mb-0"><?php echo $transaction['no_order'] ?></p>
											</a>
										</td>
										<td>
											<p class="text-xs font-weight-bold mb-0"><?php echo $transaction['jumlah'] ?></p>
										</td>
										<td class="align-middle text-center text-sm">
											Rp. <?php echo number_format($transaction['totals'],0,',','.') ?>
										</td>
										<td>
											<?php 
											
											if($transaction['status'] == "paid") {
												echo "<p class='text-xs font-weight-bold mb-0 badge bg-success'>";

											} else {
												echo "<p class='text-xs font-weight-bold mb-0 badge bg-warning'>";
											}
											
											?>	
												<?php echo $transaction['status'] ?>
											</p>
										</td>
										<td>
											<p class="text-xs font-weight-bold mb-0">
												<?php echo $transaction['name'] ?>
											</p>
										</td>
										<td>
											<p class="text-xs font-weight-bold mb-0">
												<?php echo $transaction['email'] ?>
											</p>
										</td>
										<td>
											<p class="text-xs font-weight-bold mb-0">
												<?php echo $transaction['phone'] ?>
											</p>
										</td>
									</tr>

									

								<?php endforeach; ?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $('#example').DataTable();
});
</script>
