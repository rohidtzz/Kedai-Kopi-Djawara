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
                                    <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                        Name</th>
                                    <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Email</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Phone</th>
									<th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Username</th>
									<th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Role</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php foreach($users as $user): ?>
									<tr>
										<td>
											<p class="text-xs text-center font-weight-bold mb-0"><?php echo $user['name'] ?></p>
										</td>
										<td>
											<p class="text-xs text-center font-weight-bold mb-0"><?php echo $user['email'] ?></p>
										</td>
										<td>
											<p class="text-xs text-center font-weight-bold mb-0"><?php echo $user['phone'] ?></p>
										</td>
										<td>
											<p class="text-xs text-center font-weight-bold mb-0"><?php echo $user['username'] ?></p>
										</td>
										<td>
											<p class="text-xs text-center font-weight-bold mb-0"><?php echo $user['roles'] ?></p>
										</td>
										<td class="align-middle text-center">
											<button type="button" class="btn btn-primary text-white font-weight-bold text-xs " data-bs-toggle="modal" data-bs-target="#exampleModal-<?php echo $user['id'] ?>">
												Edit
											</button>
										</td>
									</tr>

									<div class="modal fade" id="exampleModal-<?php echo $user['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
											</div>
											<div class="modal-body">
											
												<form action="<?php echo base_url('admin/update_users/'.$user['id']) ?>" method="post" enctype="multipart/form-data">
													
													<div class="mb-3 form-group">
														<label for="img">Image:</label>
														<img class="form-control" src="<?php echo base_url('assets/'.$user['img']) ?>" alt="">
													</div>
													<div class="mb-3 form-group">
														<label for="img">Image:</label>
														<input class="form-control" type="file" name="img" id="img" >
													</div>

													<div class="mb-3 form-group">
														<label for="name">Name:</label>
														<input class="form-control" value="<?php echo $user['name'] ?>" type="text" name="name" id="name" required>
													</div>

													<div class="mb-3 form-group">
														<label for="username">username:</label>
														<input class="form-control" value="<?php echo $user['username'] ?>" type="text" name="username" id="username" required>
													</div>

													<div class="mb-3 form-group">
														<label for="email">email:</label>
														<input class="form-control" value="<?php echo $user['email'] ?>" type="email" name="email" id="email" required>
													</div>
													<div class="mb-3 form-group">
														<label for="Phone">Phone:</label>
														<input class="form-control" value="<?php echo $user['phone'] ?>" type="number" name="phone" id="Phone" required>
													</div>
													<div class="mb-3 form-group">
														<label for="password">password:</label>
														<input class="form-control" value="" type="text" name="password" id="password">
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
