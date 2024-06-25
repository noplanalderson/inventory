<div class="container-fluid">
    <div class="card shadow border-primary" style="width: 18rem;">
      <img src="<?= site_url('assets/uploads/users/'.sessionGet('user_picture')) ?>" class="card-img-top" alt="PP <?= sessionGet('username') ?>">
      <div class="card-body text-center">
        <h5 class="card-title">Selamat Datang</h5>
        <p class="card-text">
            <?= sessionGet('username') ?>
            <div class="clearfix border my-2"></div>
            <small><?= sessionGet('gid') ?></small>
        </p>
      </div>
    </div>
</div>