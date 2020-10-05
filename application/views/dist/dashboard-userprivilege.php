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
                        <?php $i=1; $data = $this->db->join('users_lvl_access',"users.users_access=users_lvl_access.users_access")->get('users'); foreach ($data->result() as $row) { ?>
                        <tr>
                          <td><?= $i ?></td>
                          <td><?= $row->users_fullname ?></td>
                          <td><?= $row->lvl_name ?></td>
                          <td><form method="POST" action="{base_url}dashboard/userprivilege/edit_user" accept-charset="utf-8"><input type="hidden" name="{get_csrf_token_name}" value="{get_csrf_hash}"><input type="hidden" name="id_user" value="<?= $row->users_id ?>"><button class="btn btn-info btn-block user-id">Change</button></form></td>
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
                        <?php $i=1; $data = $this->db->join('users_lvl_access',"users.users_access=users_lvl_access.users_access")->get('users'); foreach ($data->result() as $row) { ?>
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
<?php $this->load->view('dist/_partials/footer'); ?>
