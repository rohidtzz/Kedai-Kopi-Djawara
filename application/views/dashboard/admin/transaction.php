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
                                        status</th>
									<th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        name</th>
									<th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        email</th>
									<th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        phone</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
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
										<td class="align-middle text-center">
											<button type="button" class="btn btn-primary text-white font-weight-bold text-xs " data-bs-toggle="modal" data-bs-target="#exampleModal-<?php echo $transaction['id'] ?>">
												Edit
											</button>
										</td>
									</tr>

									<div class="modal fade" id="exampleModal-<?php echo $transaction['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
											</div>
											<div class="modal-body">
											
												<form action="<?php echo base_url('admin/update_transaction/'.$transaction['id']) ?>" method="post" enctype="multipart/form-data">
													
													<div class="mb-3 form-group">
														<label for="status">status:</label>
														<select name="status" id="status" class="form-control">
															<?php if($transaction['status'] == "paid") { ?>
																<option value="paid" selected>Paid</option>
																<option value="waiting">waiting</option>
															<?php } else { ?>
																<option value="waiting" selected>waiting</option>
																<option value="paid">Paid</option>
															<?php }	?>
															<option value=""></option>
														</select>
														
													</div>


																						
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" >Close</button>
												<button type="submit" class="btn btn-primary">Save changes</button>
											</div>
											</form>	
											</div>
										</div>
									</div>

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
