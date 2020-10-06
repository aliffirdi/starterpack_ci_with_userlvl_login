<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('dist/_partials/header');
?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>User Privileges</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item">User Privileges</div>
              <div class="breadcrumb-item">Edit</div>
            </div>
          </div>

          <div class="section-body">
            <h2 class="section-title">Privileges Edit</h2>
            {basisdata}
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>User Hak Akses</h4>
                  </div>
                  <div class="card-body"><?php //Kint::dump($basisdata[0]['lvl_name']); ?>
                    <form method="POST" action="<?= base_url("dashboard/userprivilege"); ?>" accept-charset="utf-8">
                      <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                      <input type="hidden" name="user_id" value="{users_id}">
                      <div class="form-group">
                        <label>Nama User</label>
                        <div class="input-group">
                          <input value="{users_fullname}" type="text" class="form-control" readonly>
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Level Akses</label>
                        <select name="users_lvl_access" class="form-control">
                          <?php foreach ($this->db->get('users_lvl_access')->result() as $key) { ?>
                          <option <?php if ($basisdata[0]['lvl_name'] == $key->lvl_name) {echo "selected";} ?> value="<?= $key->users_access; ?>"><?= $key->lvl_name ?></option>
                        <?php } ?>
                        </select>
                      </div>
                      <button type="submit" class="btn btn-primary">Perbarui</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            {/basisdata}
          </div>
        </section>
      </div>
<?php $this->load->view('dist/_partials/footer'); ?>
