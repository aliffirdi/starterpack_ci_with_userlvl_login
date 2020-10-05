<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="<?php echo base_url(); ?>dist/index">Basis data</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?php echo base_url(); ?>dist/index">{short_app_name}</a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <?php $data = $this->data_model->ketika('site_feature', array('feature_access_id' => 2 )); foreach ($data->result() as $row) { ?>
            <?php if ($this->website->access($row->feature_name) == true) { ?>
            <li<?php if ($row->feature_name == $this->uri->segment(2)) {echo " class=\"active\"";} ?>><a class="nav-link" href="<?php echo base_url("dashboard/".$row->feature_name); ?>"><i class="<?= $row->feature_logo ?>"></i> <span><?= $row->feature_display_name ?></span></a></li>
            <?php }} ?>
            <li class="menu-header">Konfigurasi</li>
            <?php $data = $this->data_model->ketika('site_feature', array('feature_access_id' => 1 )); foreach ($data->result() as $row) { ?>
            <?php if ($this->website->access($row->feature_name) == true) { ?>
            <li<?php if ($row->feature_name == $this->uri->segment(2)) {echo " class=\"active\"";} ?>><a class="nav-link" href="<?php echo base_url("dashboard/".$row->feature_name); ?>"><i class="<?= $row->feature_logo ?>"></i> <span><?= $row->feature_display_name ?></span></a></li>
            <?php }} ?>
          </ul>

          <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
              <i class="fas fa-rocket"></i> Documentation
            </a>
          </div>
        </aside>
      </div>
