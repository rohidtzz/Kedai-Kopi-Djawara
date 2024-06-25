<div class="min-height-300 bg-primary position-absolute w-100"></div>
  <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <div class="navbar-brand m-0" href="">
				<img src="<?php echo base_url('assets/logo-kedai.png') ?>" class="navbar-brand-img h-100" alt="main_logo">
				<br>
        <span class="ms-1 font-weight-bold">
					<?php echo $this->session->userdata('name') ?>
				</span>
      </div>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-full" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a href="<?php echo base_url('admin/') ?>" class="nav-link <?php echo (isset($dashboard)) ? $dashboard : '' ?>" href="./pages/dashboard.html">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo base_url('admin/product') ?>" class="nav-link <?php echo (isset($product)) ? $product : '' ?>" href="./pages/virtual-reality.html">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-app text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Product</span>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo base_url('admin/transaction') ?>" class="nav-link <?php echo (isset($transaction)) ? $transaction : '' ?>" href="./pages/billing.html">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Transaction</span>
          </a>
        </li>
        
        <li class="nav-item">
          <a href="<?php echo base_url('admin/users') ?>" class="nav-link <?php echo (isset($user)) ? $user : '' ?>" href="./pages/profile.html">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Users</span>
          </a>
        </li>

				<li class="nav-item">
          <a href="<?php echo base_url('admin/profile') ?>" class="nav-link " href="./pages/profile.html">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Profile</span>
          </a>
				</li>
				<li class="nav-item">
          <a href="<?php echo base_url('auth/logout') ?>" class="nav-link " href="./pages/sign-in.html">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-single-copy-04 text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Logout</span>
          </a>
        </li>
      </ul>
    </div>
    
  </aside>

