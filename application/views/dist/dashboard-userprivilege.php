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
            </div>
          </div>

          <div class="section-body">
            <h2 class="section-title">Privileges</h2>

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>User Akses</h4>
                    <div class="card-header-action">
                      <button data-toggle="modal" data-target="#addUser" class="btn btn-primary">Tambah User</button>
                    </div>
                  </div>
                  <div class="card-body p-0">
                    <div class="table-responsive">
                      <table class="table table-striped table-md">
                        <tr>
                          <th>#</th>
                          <th width="60%">Nama User</th>
                          <th>User Level</th>
                          <th>Action</th>
                        </tr>
                        <?php $i=1; $data = $this->db->join('users_lvl_access',"users.users_access=users_lvl_access.users_access")->get('users'); foreach ($data->result() as $key) { ?>
                        <tr>
                          <td><?= $i ?></td>
                          <td><?= $key->users_fullname ?></td>
                          <td><?= $key->lvl_name ?></td>
                          <td><form method="POST" action="{base_url}dashboard/userprivilege/edit_user" accept-charset="utf-8"><input type="hidden" name="{get_csrf_token_name}" value="{get_csrf_hash}"><input type="hidden" name="id_user" value="<?= $key->users_id ?>"><button class="btn btn-info btn-block user-id">Change</button></form></td>
                        </tr><?php $i++; } ?>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Hak Akses</h4>
                    <div class="card-header-action">
                      <button data-toggle="modal" data-target="#addAccess" class="btn btn-primary">Tambah Hak Akses</button>
                    </div>
                  </div>
                  <div class="card-body p-0">
                    <div class="table-responsive">
                      <table class="table table-striped table-md">
                        <tr>
                          <th>#</th>
                          <th>User Level</th>
                          <th>User Access</th>
                          <th>Action</th>
                        </tr>
                        <?php $i=1; $data = $this->db->get('users_lvl_access'); foreach ($data->result() as $row) { ?>
                        <tr>
                          <td><?= $i ?></td>
                          <td><?= $row->lvl_name ?></td>
                          <td><?php $jsn_data = json_decode($row->lvl_desc); foreach ($jsn_data as $key => $value) { ?><div class="badge badge-success"><?php $access_id = $this->data_model->ketika('site_feature',array('feature_name' => $value)); foreach ($access_id->result() as $key) {echo $key->feature_display_name;} ?></div>&nbsp;<?php } ?></td>
                          <td><form method="POST" action="{base_url}dashboard/userprivilege/edit_access" accept-charset="utf-8"><input type="hidden" name="{get_csrf_token_name}" value="{get_csrf_hash}"><input type="hidden" name="access_id" value="<?= $row->lvl_id ?>"><button class="btn btn-info btn-block user-id">Change</button></form></td>
                        </tr><?php $i++; } ?>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
      <!-- Modal -->
      <div class="modal fade" tabindex="-1" role="dialog" id="addUser">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Tambah User</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST" action="<?= base_url("dashboard/userprivilege"); ?>" accept-charset="utf-8">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                <div class="form-group">
                  <label>User Fullname</label>
                  <div class="input-group">
                    <input placeholder="Masukan Nama Lengkap Pengguna" name="user_fullname" type="text" class="form-control" required>
                  </div>
                </div>
                <div class="form-group">
                  <label>Username</label>
                  <div class="input-group">
                    <input placeholder="Masukan Nama Pengguna" name="username" type="text" class="form-control" required>
                  </div>
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <div class="input-group">
                    <input placeholder="Password" name="password" type="password" class="form-control" required>
                  </div>
                </div>
                <div class="form-group">
                  <label>Level Akses</label>
                  <select name="add_users_lvl_access" class="form-control" required>
                    <?php foreach ($this->db->get('users_lvl_access')->result() as $key) { ?>
                    <option value="<?= $key->users_access; ?>"><?= $key->lvl_name ?></option>
                  <?php } ?>
                  </select>
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Tambahkan</button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" tabindex="-1" role="dialog" id="addAccess">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Tambah Hak Akses</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST" action="<?= base_url("dashboard/userprivilege"); ?>" accept-charset="utf-8">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                <div class="form-group">
                  <label>Nama Level Akses</label>
                  <div class="input-group">
                    <input name="add_new_access_lvl_name" type="text" class="form-control" placeholder="Masukan Nama Level Akses" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="form-label">Akses Yang Diizinkan</label>
                  <div class="selectgroup selectgroup-pills">
                    <?php foreach ($this->db->get('site_feature')->result() as $key) { ?>
                    <label class="selectgroup-item">
                      <input type="checkbox" name="<?= $key->feature_name; ?>" value="<?= $key->feature_name; ?>" class="selectgroup-input">
                      <span class="selectgroup-button"><?= $key->feature_display_name; ?></span>
                    </label>
                    <?php } ?>
                  </div>
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Tambahkan</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- End of Modal -->
<?php $this->load->view('dist/_partials/footer'); ?>
