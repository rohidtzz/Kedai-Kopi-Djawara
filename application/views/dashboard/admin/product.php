<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
					<div class="row">
						<div class="col">
						<h6><?php echo $title ?> table</h6>	
						</div>
						<div class="col text-end">
							<button class="btn btn-primary">
								Tambah data
							</button>
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
                                        Image</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Name</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Price</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Stock</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php foreach($products as $product): ?>
									<tr>
										<td>
											<img src="<?php echo base_url('assets/'.$product['img']) ?>" style="border-radius:20px" class=""
												alt="user1">
											
										</td>
										<td>
											<p class="text-xs font-weight-bold mb-0"><?php echo $product['name'] ?></p>
										</td>
										<td class="align-middle text-center text-sm">
											Rp. <?php echo number_format($product['price'],0,',','.') ?>
										</td>
										<td class="align-middle text-center">
											<span class="text-secondary text-xs font-weight-bold"><?php echo $product['stock'] ?></span>
										</td>
										<td class="align-middle text-center">
											<button href="javascript:;" class="text-white font-weight-bold text-xs btn btn-primary"
												data-toggle="tooltip" data-original-title="Edit user">
												Edit
											</button>
											<a href="javascript:;" class="text-white font-weight-bold text-xs btn btn-danger"
												data-toggle="tooltip" data-original-title="Edit user">
												Delete
											</a>
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
