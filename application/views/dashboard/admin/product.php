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
						<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
							Tambah Data
						</button>
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
											<img src="<?php echo base_url('assets/'.$product['img']) ?>" style="border-radius:20px" width="250" class=""
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
											<button type="button" class="btn btn-primary text-white font-weight-bold text-xs " data-bs-toggle="modal" data-bs-target="#exampleModal-<?php echo $product['id'] ?>">
												Edit
											</button>
											<a href="<?php echo base_url('admin/delete_product/' . $product['id']); ?>" onclick="return confirm('Are you sure you want to delete this product?');" class="text-white font-weight-bold text-xs btn btn-danger"
												data-toggle="tooltip" data-original-title="Edit user">
												Delete
											</a>
										</td>
									</tr>

									<div class="modal fade" id="exampleModal-<?php echo $product['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
											</div>
											<div class="modal-body">
											
												<form action="<?php echo base_url('admin/update_product/'.$product['id']) ?>" method="post" enctype="multipart/form-data">
													
													<div class="mb-3 form-group">
														<label for="img">Image:</label>
														<input class="form-control" type="file" name="img" id="img" >
													</div>

													<div class="mb-3 form-group">
														<label for="name">Name:</label>
														<input class="form-control" value="<?php echo $product['name'] ?>" type="text" name="name" id="name" required>
													</div>

													<div class="mb-3 form-group">
														<label for="price">Price:</label>
														<input class="form-control" value="<?php echo $product['price'] ?>" type="number" name="price" id="price" required>
													</div>

													<div class="mb-3 form-group">
														<label for="stock">Stock:</label>
														<input class="form-control" value="<?php echo $product['stock'] ?>" type="number" name="stock" id="stock" required>
													</div>

																						
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
	
	  	<form action="<?php echo base_url('admin/add_product') ?>" method="post" enctype="multipart/form-data">
			<div class="mb-3 form-group">
				<label for="img">Image:</label>
				<input class="form-control" type="file" name="img" id="img" required>
			</div>

			<div class="mb-3 form-group">
				<label for="name">Name:</label>
				<input class="form-control" type="text" name="name" id="name" required>
			</div>

			<div class="mb-3 form-group">
				<label for="price">Price:</label>
				<input class="form-control" type="number" name="price" id="price" required>
			</div>

			<div class="mb-3 form-group">
				<label for="stock">Stock:</label>
				<input class="form-control" type="number" name="stock" id="stock" required>
			</div>

												
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
	  </form>	
    </div>
  </div>
</div>

