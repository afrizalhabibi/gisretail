<?= $this->include('/layout/head')?>
<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="/" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="<?=base_url()?>/assets/images/logos/logo-home.svg" width="180" alt="">
                </a>
                <form action="<?= url_to('login') ?>" method="post">
                <?= csrf_field() ?>
                <?php if ($config->validFields === ['email']): ?>
                  <div class="mb-3">
                    <label class="form-label" for="login"><?=lang('Auth.email')?></label>
                    <input type="email" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>"
                            name="login" placeholder="<?=lang('Auth.email')?>">
                    <div class="invalid-feedback">
                        <?= session('errors.login') ?>
                    </div>
                  </div>
                  <?php else: ?>
                <div class="mb-3">
                    <label class="form-label" for="login"><?=lang('Auth.emailOrUsername')?></label>
                    <input type="text" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>"
                            name="login" placeholder="<?=lang('Auth.emailOrUsername')?>">
                    <div class="invalid-feedback">
                        <?= session('errors.login') ?>
                    </div>
                </div>
                <?php endif; ?>
                  <div class="mb-4">
                    <label class="form-label" for="password"><?=lang('Auth.password')?></label>
                    <input type="password" name="password" class="form-control  <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?=lang('Auth.password')?>">
                    <div class="invalid-feedback">
                        <?= session('errors.password') ?>
                    </div>
                  </div>
                <?php if ($config->allowRemembering): ?>
                  <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="form-check">
                      <input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked" checked>
                      <label class="form-check-label text-dark" for="flexCheckChecked">
                        Remeber this Device
                      </label>
                    </div>
                <?php endif; ?>
                    <a class="text-primary fw-bold" href="<?= url_to('forgot') ?>"><?=lang('Auth.forgotYourPassword')?></a>
                  </div>
                  <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2"><?=lang('Auth.loginAction')?></button>
                <?php if ($config->allowRegistration) : ?>
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-bold"><?=lang('Auth.needAnAccount')?></p>
                    <a class="text-primary fw-bold ms-2" href="<?= url_to('register') ?>">Create an account</a>
                  </div>
                <?php endif; ?>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="<?php base_url()?>/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>