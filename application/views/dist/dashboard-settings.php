<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('dist/_partials/header');
?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Pengaturan</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item">Pengaturan Pengguna</div>
            </div>
          </div>

          <div class="section-body">
            <h2 class="section-title">Pengaturan Pengguna</h2>

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Pengaturan</h4>
                  </div>
                  <div class="card-body">
                    <form method="POST" accept-charset="utf-8">
                      <input type="hidden" name="{get_csrf_token_name}" value="{get_csrf_hash}">
                    <?php
                    $basisdata = $this->db->join('users_biodata',"users_biodata.bio_username=users.users_name")->get_where('users', array('users_name' => $this->session->userdata('login')['username'] ));
                    foreach ($basisdata->result() as $row) { ?>
                      <div class="row">
                        <div class="form-group col-6">
                          <label>Nama Depan</label>
                          <div class="input-group">
                            <input name="firstname" value="<?= $row->bio_firstname ?>" placeholder="Masukan Nama Depan" type="text" class="form-control">
                          </div>
                        </div>
                        <div class="form-group col-6">
                          <label>Nama Belakang</label>
                          <div class="input-group">
                            <input name="lastname" value="<?= $row->bio_lastname ?>" placeholder="Masukan Nama Belakang" type="text" class="form-control">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-12">
                          <label>Nama Pengguna</label>
                          <div class="input-group">
                            <input required name="username" value="<?= $row->bio_username ?>" placeholder="Masukan Nama Pengguna" type="text" class="form-control">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-4">
                          <label>Negara</label>
                          <div class="input-group">
                            <input name="country" value="<?= $row->bio_country ?>" placeholder="Masukan Nama Negara" type="text" class="form-control">
                          </div>
                        </div>
                        <div class="form-group col-4">
                          <label>Provinsi / Prefektur</label>
                          <div class="input-group">
                            <input name="province" value="<?= $row->bio_province ?>" placeholder="Masukan Nama Provinsi / Prefektur" type="text" class="form-control">
                          </div>
                        </div>
                        <div class="form-group col-4">
                          <label>Kota</label>
                          <div class="input-group">
                            <input name="city" value="<?= $row->bio_city ?>" placeholder="Masukan Nama Kota" type="text" class="form-control">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-12">
                          <label>Password</label>
                          <div class="input-group">
                            <input name="password" placeholder="Masukan Password" type="text" class="form-control">
                          </div>
                          <p>Kosongkan jika tidak ingin mengubah password</p>
                        </div>
                      </div>
                    <?php } ?>
                      <button type="submit" class="btn btn-primary">Perbarui</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
<?php $this->load->view('dist/_partials/footer'); ?>
