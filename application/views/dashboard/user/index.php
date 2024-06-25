<div class="card shadow-lg mx-4 card-profile-bottom" style="margin-top: 13%">
    <div class="card-body p-3">
        <?php if($this->session->flashdata('error')): ?>
        <div class="alert text-white alert-danger alert-dismissible fade show" role="alert">
            <?php echo $this->session->flashdata('error'); ?>
            <a href="<?php echo base_url('/auth'); ?>" type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>x</a>
        </div>
        <?php endif; ?>
        <?php if($this->session->flashdata('success')): ?>
        <div class="alert text-white alert-success alert-dismissible fade show" role="alert">
            <?php echo $this->session->flashdata('success'); ?>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>x</button>
        </div>
        <?php endif; ?>
        <div class="row gx-4">

            <div class="col-auto">
                <div class="avatar avatar-xl position-relative">
                    <img src="<?php echo base_url('assets/' . $profiles['img']); ?>" alt="profile_image" class="w-100 h-100 border-radius-lg shadow-sm">
                </div>
            </div>
            <div class="col-auto my-auto">
                <div class="h-100">
                    <h5 class="mb-1">
                        <?php echo $profiles['name']; ?>
                    </h5>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                <div class="nav-wrapper position-relative end-0">
                    <ul class="nav nav-pills nav-fill p-1" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center "
                                data-bs-toggle="modal" data-bs-target="#exampleModal-<?php echo $profiles['id']; ?>">
                                <i class="ni ni-settings-gear-65"></i>
                                <span class="ms-2">Settings</span>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header pb-0">
                    <!-- <div class="d-flex align-items-center">
                        <p class="mb-0">Edit Profile</p>
                        <button class="btn btn-primary btn-sm ms-auto">Save</button>
                    </div> -->
                </div>
                <div class="card-body">
                    <p class="text-uppercase text-sm">User Information</p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Username</label>
                                <input class="form-control" type="text" disabled value="<?php echo $profiles['username']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Email address</label>
                                <input class="form-control" type="email" disabled value="<?php echo $profiles['email']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">name</label>
                                <input class="form-control" type="text" value="<?php echo $profiles['name']; ?>" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Phone</label>
                                <input class="form-control" type="text" disabled value="<?php echo $profiles['phone']; ?>">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="exampleModal-<?php echo $profiles['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="<?php echo base_url('user/update_profile/' . $profiles['id']); ?>" method="post" enctype="multipart/form-data">

                    <div class="mb-3 form-group">
                        <label for="img">Image:</label>
                        <img class="form-control" src="<?php echo base_url('assets/' . $profiles['img']); ?>" alt="">
                    </div>
                    <div class="mb-3 form-group">
                        <label for="img">Image:</label>
                        <input class="form-control" type="file" name="img" id="img">
                    </div>

                    <div class="mb-3 form-group">
                        <label for="name">Name:</label>
                        <input class="form-control" value="<?php echo $profiles['name']; ?>" type="text" name="name"
                            id="name" required>
                    </div>

                    <div class="mb-3 form-group">
                        <label for="password">password:</label>
                        <input class="form-control" value="" type="text" name="password" id="password">
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
