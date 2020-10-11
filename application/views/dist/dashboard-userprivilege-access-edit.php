<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('dist/_partials/header');
?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Access Privileges</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item">Access Privileges</div>
              <div class="breadcrumb-item">Edit</div>
            </div>
          </div>

          <div class="section-body">
            <h2 class="section-title">Privileges Edit</h2>
            {basisdata_access}
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Hak Akses</h4>
                  </div>
                  <div class="card-body">
                    <form method="POST" action="<?= base_url("dashboard/userprivilege"); ?>" accept-charset="utf-8">
                      <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                      <input type="hidden" name="access_id_update" value="{lvl_id}">
                      <div class="form-group">
                        <label>Level Akses</label>
                        <div class="input-group">
                          <input value="{lvl_name}" type="text" class="form-control" readonly>
                        </div>
                      </div>
                      
                    <div class="form-group">
                      <label class="form-label">Akses Yang Diizinkan</label>
                      <div class="selectgroup selectgroup-pills">
                        <?php foreach ($this->db->get('site_feature')->result() as $key) { ?>
                        <label class="selectgroup-item">
                          <input type="checkbox" name="<?= $key->feature_name; ?>" value="<?= $key->feature_name; ?>" class="selectgroup-input" <?php foreach (json_decode($basisdata_access[0]['lvl_desc']) as $row => $value) {if ($value == $key->feature_name) {echo "checked";}} ?>>
                          <span class="selectgroup-button"><?= $key->feature_display_name; ?></span>
                        </label>
                        <?php } ?>
                      </div>
                    </div>
                      <button type="submit" class="btn btn-primary">Perbarui</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            {/basisdata_access}
          </div>
        </section>
      </div>
<?php $this->load->view('dist/_partials/footer'); ?>
