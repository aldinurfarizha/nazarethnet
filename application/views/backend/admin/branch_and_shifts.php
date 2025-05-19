<?php $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description; ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>public/uploads/styles.css" type="text/css" media="screen" />
<?php
$start_1 = $this->db->get_where('settings', array('type' => 'start_1'))->row()->description;
$final_1 = $this->db->get_where('settings', array('type' => 'final_1'))->row()->description;
$start_2 = $this->db->get_where('settings', array('type' => 'start_2'))->row()->description;
$final_2 = $this->db->get_where('settings', array('type' => 'final_2'))->row()->description;
$class_duration = $this->db->get_where('settings', array('type' => 'class_duration'))->row()->description;
$sundays = $this->db->get_where('academic_settings', array('type' => 'routine'))->row()->description;
?>
<script type="text/javascript">
  var redipsURL = '<?php echo base_url(); ?>';
  var redipsMsg = '<?php echo getEduAppGTLang('the content has changed dont forget to save the changes'); ?>';
  var redipsMsgd = '<?php echo getEduAppGTLang('content_deleted'); ?>';
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/uploads/redips-drag-min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/uploads/script.js"></script>
<style>
  .no_schedules {
    background: repeating-linear-gradient(45deg, #eee, #eee 2px, #F7F7F7 2px, #F7F7F7 14px);
  }
</style>
<div class="content-w">
  <?php include 'fancy.php'; ?>
  <div class="header-spacer"></div>
  <div class="conty">
    <div class="content-box">
      <div class="conty">
        <div class="ui-block">
          <div class="ui-block-content">
          <div class="content-box">
    				<h5 class="form-header"><?php echo getEduAppGTLang('branch_and_shifts'); ?></h5>
    				<hr>
    				<div class="row bg-white">
    					<div class="col-sm-12">
    						<div class="container-fluid">
    							<div class="row w-100">
    								<div class="os-tabs-w w-100">
    									<div class="os-tabs-controls w-100">
    										<ul class="navs navs-tabs upper d-flex justify-content-between w-100" style="gap: 10px;">
    											<li class="navs-item">
    												<a class="navs-links active" data-toggle="tab" href="#branch"><?php echo getEduAppGTLang('branch'); ?></a>
    											</li>
    											<li class="navs-item">
    												<a class="navs-links" data-toggle="tab" href="#shifts"><?php echo getEduAppGTLang('shifts'); ?></a>
    											</li>
    											<li class="navs-item">
    												<a class="navs-links" data-toggle="tab" href="#student"><?php echo getEduAppGTLang('student'); ?> <span class="badge badge-danger">
                              <?= $this->db->where(['branch_id'=>null,'is_active'=>1])->count_all_results('student'); ?>
                            </span></a>
    											</li>
                          <li class="navs-item">
    												<a class="navs-links" data-toggle="tab" href="#class"><?php echo getEduAppGTLang('class'); ?> <span class="badge badge-danger">
                              <?= $this->db->where(['branch_id'=>null])->count_all_results('class'); ?>
                            </span></a>
    											</li>
                          
    										</ul>
    									</div>
    								</div>
    							</div>
    							<div class="container-fluid">
    								<div class="tab-content">

    									<!-- STUDENT TAB -->
    									<div class="tab-pane active" id="branch">
    										<div class="row">
                              <div class="col-md-12 mb-3">
                              <button class="btn btn-primary" type="button" data-target="#add_venues" data-toggle="modal">
                                <i class="fa fa-plus"></i> <?= getEduAppGTLang('add') . ' ' . getEduAppGTLang('branch'); ?>
                              </button>
                              </div>
                              <hr>
                                <div class="table-responsive">
                                  <table class="table table-padded">
                                    <thead>
                                      <tr>
                                        <th><?php echo getEduAppGTLang('name'); ?></th>
                                        <th><?php echo getEduAppGTLang('telephone'); ?></th>
                                        <th><?php echo getEduAppGTLang('direction'); ?></th>
                                        <th><?php echo getEduAppGTLang('status'); ?></th>
                                        <th class="text-center"><?php echo getEduAppGTLang('action'); ?></th>
                                      </tr>
                                    </thead>
                                    </tbody>
                                    <?php
                                    $branch = $this->db->query('SELECT * FROM branch')->result_array();
                                    foreach ($branch as $row):
                                    ?>
                                      <tr>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['telephone']; ?></td>
                                        <td><?php echo $row['direction']; ?></td>
                                        <td><?php echo getEduAppGTLang($row['status']); ?></td>
                                        <td class="row-actions">
                                          <a href="javascript:void(0);"
                                            class="btn-edit-venues grey"
                                            data-id="<?= $row['branch_id']; ?>"
                                            data-name="<?= $row['name']; ?>"
                                            data-telephone="<?= $row['telephone']; ?>"
                                            data-longitude="<?= $row['longitude']; ?>"
                                            data-latitude="<?= $row['latitude']; ?>"
                                            data-status="<?= $row['status']; ?>"
                                            data-direction="<?= $row['direction']; ?>">
                                            
                                            <i class="picons-thin-icon-thin-0002_write_pencil_new_edit"></i>
                                          </a>
                                          <a class="grey" onClick="return confirm('<?php echo getEduAppGTLang('confirm_delete'); ?>')" href="<?php echo base_url(); ?>admin/branch_delete/<?php echo $row['branch_id']; ?>"><i class="os-icon picons-thin-icon-thin-0056_bin_trash_recycle_delete_garbage_empty"></i></a>
                                        </td>
                                      </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                  </table>
                      </div>
    													
    										</div>
    									</div>

    									<!-- Shifts TAB -->
    									<div class="tab-pane" id="shifts">
    										<div class="row">
                          <hr>
											<div class="col-md-12 mb-3">
                      <button class="btn btn-primary" type="button" data-target="#add_conferences" data-toggle="modal">
                        <i class="fa fa-plus"></i> <?= getEduAppGTLang('add') . ' ' . getEduAppGTLang('shifts'); ?>
                      </button>
                    </div>
                        <div class="table-responsive">
                        <table class="table table-padded">
                          <thead>
                            <tr>
                              <th><?php echo getEduAppGTLang('branche'); ?></th>
                              <th><?php echo getEduAppGTLang('shifts'); ?></th>
                              <th><?php echo getEduAppGTLang('status'); ?></th>
                              <th class="text-center"><?php echo getEduAppGTLang('action'); ?></th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php
                          $shifts = $this->db->query('SELECT shifts.name as shifts_name,shifts.shifts_id,shifts.status,branch.branch_id,branch.* FROM shifts inner join branch on shifts.branch_id = branch.branch_id')->result_array();
                          foreach ($shifts as $row):
                          ?>
                            <tr>
                              <td><?php echo $row['name']; ?></td>
                              <td><?php echo $row['shifts_name']; ?></td>
                              <td><?php echo getEduAppGTLang($row['status']); ?></td>
                              <td class="row-actions">
                                <a href="javascript:void(0);"
                                  class="grey btn-edit-conference"
                                  data-id="<?= $row['shifts_id']; ?>"
                                  data-name="<?= $row['shifts_name']; ?>"
                                  data-branch="<?= $row['branch_id']; ?>"
                                  data-status="<?= $row['status']; ?>">
                                  <i class="picons-thin-icon-thin-0002_write_pencil_new_edit"></i>
                                  <i class="picons-thin-icon-thin-0002_write_pencil px20"></i>
                                </a>

                                <a class="grey" onClick="return confirm('<?php echo getEduAppGTLang('confirm_delete'); ?>')" href="<?php echo base_url(); ?>admin/shifts_delete/<?php echo $row['shifts_id']; ?>"><i class="os-icon picons-thin-icon-thin-0056_bin_trash_recycle_delete_garbage_empty"></i></a>
                              </td>
                            </tr>
                          <?php endforeach; ?>
                          </tbody>
                        </table>
                      </div>
    										</div>
    									</div>

    									<!-- STUDENT TAB -->
    									<div class="tab-pane" id="student">
    										<div class="row">
                        <span class="badge badge-warning">This page will show all students who are not assigned to any branch</span>
                      <div class="table-responsive">
                        <table class="table table-padded">
                          <thead>
                            <tr>
                              <th><?php echo getEduAppGTLang('number'); ?></th>
                              <th><?php echo getEduAppGTLang('name'); ?></th>
                              <th class="text-center"><?php echo getEduAppGTLang('action'); ?></th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php
                          $students = $this->db->query('SELECT * FROM student where branch_id is null and is_active=1')->result_array();
                          $no=1;
                          foreach ($students as $row):
                          ?>
                            <tr>
                              <td><?= $no;?></td>
                              <td><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></td>
                              <td class="row-actions">
                                <a href="<?=base_url('admin/student_update/'.$row['student_id'])?>" class="btn btn-primary" target="_blank"><i class="fa fa-sync"></i> <?php echo getEduAppGTLang('assign'); ?></a>
                            </tr>
                          <?php $no++; endforeach; ?>
                          </tbody>
                        </table>
                      </div>
    										</div>
    									</div>

                      <div class="tab-pane" id="class">
    										<div class="row">
                        <span class="badge badge-warning">This page will show all class who are not assigned to any branch</span>
                      <div class="table-responsive">
                        <table class="table table-padded">
                          <thead>
                            <tr>
                              <th><?php echo getEduAppGTLang('number'); ?></th>
                              <th><?php echo getEduAppGTLang('name'); ?></th>
                              <th class="text-center"><?php echo getEduAppGTLang('action'); ?></th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php
                          $class = $this->db->query('SELECT * FROM class where branch_id is null')->result_array();
                          $no=1;
                          foreach ($class as $row):
                          ?>
                            <tr>
                              <td><?= $no;?></td>
                              <td><?php echo $row['name']; ?></td>
                              <td class="row-actions">
                                <a href="<?=base_url('admin/grados/')?>" class="btn btn-primary" target="_blank"><i class="fa fa-sync"></i> <?php echo getEduAppGTLang('assign'); ?></a>
                            </tr>
                          <?php $no++; endforeach; ?>
                          </tbody>
                        </table>
                      </div>
    										</div>
    									</div>

    								</div>
    							</div>

    						</div>
    					</div>
    				</div>
    			</div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="display-type"></div>
</div>

<div class="modal fade" id="add_conferences" tabindex="-1" role="dialog" aria-labelledby="add_conferences" aria-hidden="true">
  <div class="modal-dialog window-popup create-friend-group create-friend-group-1" role="document">
    <div class="modal-content">
      <?php echo form_open(base_url() . 'admin/shifts_add'); ?>
      <a href="javascript:void(0);" class="close icon-close" data-dismiss="modal" aria-label="Close"></a>
      <div class="modal-header">
        <h6 class="title"><?php echo getEduAppGTLang('add') . ' ' . getEduAppGTLang('shifts'); ?></h6>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-12">
            <div class="form-group is-select">
              <label class="control-label"><?php echo getEduAppGTLang('shifts'); ?></label>
              <div class="select">
                <select name="branch_id" required>
                  <option value=""><?php echo getEduAppGTLang('select'); ?></option>
                  <?php
                  foreach (getActiveBranch() as $row): ?>
                    <option value="<?php echo $row->branch_id; ?>"><?php echo $row->name; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group">
                <label><?php echo getEduAppGTLang('name'); ?></label>
                <input class="form-control" type="text" name="name" required>
              </div>
              <div class="select">
                <select name="status" required>
                  <option value=""><?php echo getEduAppGTLang('status'); ?></option>
                  <option value="ACTIVE"><?php echo getEduAppGTLang('active'); ?></option>
                  <option value="INACTIVE"><?php echo getEduAppGTLang('inactive'); ?></option>
                </select>
              </div>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-rounded btn-success btn-lg full-width"><?php echo getEduAppGTLang('add'); ?></button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>

<div class="modal fade" id="add_venues" tabindex="-1" role="dialog" aria-labelledby="add_venues" aria-hidden="true">
  <div class="modal-dialog window-popup create-friend-group create-friend-group-1" role="document">
    <div class="modal-content">
      <?php echo form_open(base_url() . 'admin/branch_add'); ?>
      <a href="javascript:void(0);" class="close icon-close" data-dismiss="modal" aria-label="Close"></a>
      <div class="modal-header">
        <h6 class="title"><?php echo getEduAppGTLang('add') . ' ' . getEduAppGTLang('branches'); ?></h6>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <label><?php echo getEduAppGTLang('name'); ?></label>
              <input class="form-control" type="text" name="name" required>
            </div>
          </div>
          <div class="col-sm-12">
            <div class="form-group">
              <label><?php echo getEduAppGTLang('telephone'); ?></label>
              <input class="form-control" type="text" name="telephone" required>
            </div>
            <div class="form-group">
              <label><?php echo getEduAppGTLang('longitude'); ?></label>
              <input class="form-control" type="text" name="longitude" required>
            </div>
            <div class="form-group">
              <label><?php echo getEduAppGTLang('latitude'); ?></label>
              <input class="form-control" type="text" name="latitude" required>
            </div>
            <div class="form-group">
              <label><?php echo getEduAppGTLang('direction'); ?></label>
              <input class="form-control" type="text" name="direction" required>
            </div>
            <label><?php echo getEduAppGTLang('status'); ?></label>
          <div class="select">
            <select name="status" required>
              <option value="ACTIVE"><?php echo getEduAppGTLang('active'); ?></option>
              <option value="INACTIVE"><?php echo getEduAppGTLang('inactive'); ?></option>
            </select>
          </div>
        </div>
          </div>
        </div>
        <button type="submit" class="btn btn-rounded btn-success btn-lg full-width"><?php echo getEduAppGTLang('add'); ?></button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>



<div class="modal fade" id="edit_conferences" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog window-popup create-friend-group create-friend-group-1" role="document">
    <div class="modal-content">
      <?php echo form_open(base_url() . 'admin/shifts_edit'); ?>
      <a href="javascript:void(0);" class="close icon-close" data-dismiss="modal" aria-label="Close"></a>
      <div class="modal-header">
        <h6 class="title"><?php echo getEduAppGTLang('edit') . ' ' . getEduAppGTLang('shifts'); ?></h6>
      </div>
      <div class="modal-body">
        <input type="hidden" name="shifts_id" id="edit_shifts_id">
        <div class="form-group is-select">
          <label><?php echo getEduAppGTLang('branch_id'); ?></label>
          <div class="select">
            <select name="branch_id" id="edit_branch" required>
              <option value=""><?php echo getEduAppGTLang('select'); ?></option>
              <?php foreach ($branch as $v): ?>
                <option value="<?= $v['branch_id']; ?>"><?= $v['name']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <label><?php echo getEduAppGTLang('name'); ?></label>
          <input class="form-control" type="text" name="name" id="edit_name" required>
          <label><?php echo getEduAppGTLang('status'); ?></label>
          <div class="select">
            <select name="status" id="edit_status" required>
              <option value="ACTIVE"><?php echo getEduAppGTLang('active'); ?></option>
              <option value="INACTIVE"><?php echo getEduAppGTLang('inactive'); ?></option>
            </select>
          </div>
        </div>
      </div>
      <button type="submit" class="btn btn-rounded btn-success btn-lg full-width"><?php echo getEduAppGTLang('update'); ?></button>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>

<div class="modal fade" id="edit_venues" tabindex="-1" role="dialog" aria-labelledby="edit_venues" aria-hidden="true">
  <div class="modal-dialog window-popup create-friend-group create-friend-group-1" role="document">
    <div class="modal-content">
      <?php echo form_open(base_url() . 'admin/branch_edit'); ?>
      <input type="hidden" name="branch_id" id="edit_branch_id">
      <a href="javascript:void(0);" class="close icon-close" data-dismiss="modal" aria-label="Close"></a>
      <div class="modal-header">
        <h6 class="title"><?php echo getEduAppGTLang('edit') . ' ' . getEduAppGTLang('branch'); ?></h6>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label><?php echo getEduAppGTLang('name'); ?></label>
          <input class="form-control" type="text" name="name" id="edit_name_branch" required>
        </div>
        <div class="form-group">
          <label><?php echo getEduAppGTLang('telephone'); ?></label>
          <input class="form-control" type="text" name="telephone" id="edit_telephone" required>
        </div>
        <div class="form-group">
          <label><?php echo getEduAppGTLang('longitude'); ?></label>
          <input class="form-control" type="text" name="longitude" id="edit_longitude" required>
        </div>
        <div class="form-group">
          <label><?php echo getEduAppGTLang('latitude'); ?></label>
          <input class="form-control" type="text" name="latitude" id="edit_latitude" required>
        </div>
        <div class="form-group">
          <label><?php echo getEduAppGTLang('direction'); ?></label>
          <input class="form-control" type="text" name="direction" id="edit_direction" required>
        </div>
        <label><?php echo getEduAppGTLang('status'); ?></label>
          <div class="select">
            <select name="status" id="edit_status_branch" required>
              <option value="ACTIVE"><?php echo getEduAppGTLang('active'); ?></option>
              <option value="INACTIVE"><?php echo getEduAppGTLang('inactive'); ?></option>
            </select>
          </div>
        <button type="submit" class="btn btn-rounded btn-success btn-lg full-width"><?php echo getEduAppGTLang('update'); ?></button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>



<script>
  $(document).ready(function() {
    $('.btn-edit-conference').click(function() {
      let id = $(this).data('id');
      let name = $(this).data('name');
      let branch = $(this).data('branch');
      let status = $(this).data('status');

      $('#edit_shifts_id').val(id);
      $('#edit_name').val(name);
      $('#edit_branch').val(branch);
      $('#edit_status').val(status);

      $('#edit_conferences').modal('show');
    });
    $('.btn-edit-venues').click(function() {
      let id = $(this).data('id');
      let name = $(this).data('name');
      let telephone = $(this).data('telephone');
      let longitude = $(this).data('longitude');
      let latitude = $(this).data('latitude');
      let direction = $(this).data('direction');
      let status = $(this).data('status');

      $('#edit_branch_id').val(id);
      $('#edit_name_branch').val(name);
      $('#edit_telephone').val(telephone);
      $('#edit_longitude').val(longitude);
      $('#edit_latitude').val(latitude);
      $('#edit_direction').val(direction);
      $('#edit_status_branch').val(status);


      $('#edit_venues').modal('show');
    });
  });
</script>