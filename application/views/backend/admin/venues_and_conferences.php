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
            <div class="steps-w">
              <div class="step-triggers">
                <a class="step-trigger active" href="#venues"><?php echo getEduAppGTLang('venues'); ?></a>
                <a class="step-trigger" href="#conferences"><?php echo getEduAppGTLang('conferences'); ?></a>
              </div>
              <div class="step-contents">
                <div class="step-content active" id="venues">
                  <div class="row">
                    <div class="col-md-12 mb-3 text-right">
                      <button class="btn btn-primary" type="button" data-target="#add_venues" data-toggle="modal">
                        <i class="fa fa-plus"></i> <?= getEduAppGTLang('add') . ' ' . getEduAppGTLang('venues'); ?>
                      </button>
                    </div>
                    <div class="col-md-12">
                      <div class="table-responsive">
                        <table class="table table-padded">
                          <thead>
                            <tr>
                              <th><?php echo getEduAppGTLang('name'); ?></th>
                              <th><?php echo getEduAppGTLang('telephone'); ?></th>
                              <th><?php echo getEduAppGTLang('direction'); ?></th>
                              <th class="text-center"><?php echo getEduAppGTLang('action'); ?></th>
                            </tr>
                          </thead>
                          <?php
                          $venues = $this->db->query('SELECT * FROM venues')->result_array();
                          foreach ($venues as $row):
                          ?>
                            <tr>
                              <td><?php echo $row['name']; ?></td>
                              <td><?php echo $row['telephone']; ?></td>
                              <td><?php echo $row['direction']; ?></td>
                              <td class="row-actions">
                                <a href="javascript:void(0);"
                                  class="btn-edit-venues grey"
                                  data-id="<?= $row['venues_id']; ?>"
                                  data-name="<?= $row['name']; ?>"
                                  data-telephone="<?= $row['telephone']; ?>"
                                  data-longitude="<?= $row['longitude']; ?>"
                                  data-latitude="<?= $row['latitude']; ?>"
                                  data-direction="<?= $row['direction']; ?>">
                                  <i class="picons-thin-icon-thin-0002_write_pencil_new_edit"></i>
                                </a>

                                <a class="grey" onClick="return confirm('<?php echo getEduAppGTLang('confirm_delete'); ?>')" href="<?php echo base_url(); ?>admin/venues_delete/<?php echo $row['venues_id']; ?>"><i class="os-icon picons-thin-icon-thin-0056_bin_trash_recycle_delete_garbage_empty"></i></a>
                              </td>
                            </tr>
                          <?php endforeach; ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="step-content" id="conferences">
                  <div class="row">
                    <div class="col-md-12 mb-3 text-right">
                      <button class="btn btn-primary" type="button" data-target="#add_conferences" data-toggle="modal">
                        <i class="fa fa-plus"></i> <?= getEduAppGTLang('add') . ' ' . getEduAppGTLang('conferences'); ?>
                      </button>
                    </div>
                    <div class="col-md-12">
                      <div class="table-responsive">
                        <table class="table table-padded">
                          <thead>
                            <tr>
                              <th><?php echo getEduAppGTLang('venues'); ?></th>
                              <th><?php echo getEduAppGTLang('conferences'); ?></th>
                              <th><?php echo getEduAppGTLang('status'); ?></th>
                              <th class="text-center"><?php echo getEduAppGTLang('action'); ?></th>
                            </tr>
                          </thead>
                          <?php
                          $conferences = $this->db->query('SELECT conferences.name as conferences_name,status,conferences_id,venues.* FROM conferences inner join venues on venues.venues_id=conferences.venues_id')->result_array();
                          foreach ($conferences as $row):
                          ?>
                            <tr>
                              <td><?php echo $row['name']; ?></td>
                              <td><?php echo $row['conferences_name']; ?></td>
                              <td><?php echo getEduAppGTLang($row['status']); ?></td>
                              <td class="row-actions">
                                <a href="javascript:void(0);"
                                  class="grey btn-edit-conference"
                                  data-id="<?= $row['conferences_id']; ?>"
                                  data-name="<?= $row['conferences_name']; ?>"
                                  data-venue="<?= $row['venues_id']; ?>"
                                  data-status="<?= $row['status']; ?>">
                                  <i class="picons-thin-icon-thin-0002_write_pencil_new_edit"></i>
                                  <i class="picons-thin-icon-thin-0002_write_pencil px20"></i>
                                </a>

                                <a class="grey" onClick="return confirm('<?php echo getEduAppGTLang('confirm_delete'); ?>')" href="<?php echo base_url(); ?>admin/conferences_delete/<?php echo $row['conferences_id']; ?>"><i class="os-icon picons-thin-icon-thin-0056_bin_trash_recycle_delete_garbage_empty"></i></a>
                              </td>
                            </tr>
                          <?php endforeach; ?>
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
  <div class="display-type"></div>
</div>

<div class="modal fade" id="add_conferences" tabindex="-1" role="dialog" aria-labelledby="add_conferences" aria-hidden="true">
  <div class="modal-dialog window-popup create-friend-group create-friend-group-1" role="document">
    <div class="modal-content">
      <?php echo form_open(base_url() . 'admin/conferences_add'); ?>
      <a href="javascript:void(0);" class="close icon-close" data-dismiss="modal" aria-label="Close"></a>
      <div class="modal-header">
        <h6 class="title"><?php echo getEduAppGTLang('add') . ' ' . getEduAppGTLang('conferences'); ?></h6>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-12">
            <div class="form-group is-select">
              <label class="control-label"><?php echo getEduAppGTLang('venues'); ?></label>
              <div class="select">
                <select name="venues_id" required>
                  <option value=""><?php echo getEduAppGTLang('select'); ?></option>
                  <?php
                  $venues = $this->db->get('venues')->result_array();
                  foreach ($venues as $row): ?>
                    <option value="<?php echo $row['venues_id']; ?>"><?php echo $row['name']; ?></option>
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
      <?php echo form_open(base_url() . 'admin/venues_add'); ?>
      <a href="javascript:void(0);" class="close icon-close" data-dismiss="modal" aria-label="Close"></a>
      <div class="modal-header">
        <h6 class="title"><?php echo getEduAppGTLang('add') . ' ' . getEduAppGTLang('venues'); ?></h6>
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
      <?php echo form_open(base_url() . 'admin/conferences_edit'); ?>
      <a href="javascript:void(0);" class="close icon-close" data-dismiss="modal" aria-label="Close"></a>
      <div class="modal-header">
        <h6 class="title"><?php echo getEduAppGTLang('edit') . ' ' . getEduAppGTLang('conferences'); ?></h6>
      </div>
      <div class="modal-body">
        <input type="hidden" name="conferences_id" id="edit_conference_id">
        <div class="form-group is-select">
          <label><?php echo getEduAppGTLang('venues'); ?></label>
          <div class="select">
            <select name="venues_id" id="edit_venue" required>
              <option value=""><?php echo getEduAppGTLang('select'); ?></option>
              <?php foreach ($venues as $v): ?>
                <option value="<?= $v['venues_id']; ?>"><?= $v['name']; ?></option>
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
      <?php echo form_open(base_url() . 'admin/venues_edit'); ?>
      <input type="hidden" name="venues_id" id="edit_venues_id">
      <a href="javascript:void(0);" class="close icon-close" data-dismiss="modal" aria-label="Close"></a>
      <div class="modal-header">
        <h6 class="title"><?php echo getEduAppGTLang('edit') . ' ' . getEduAppGTLang('venues'); ?></h6>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label><?php echo getEduAppGTLang('name'); ?></label>
          <input class="form-control" type="text" name="name" id="edit_name_venues" required>
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
      let venue = $(this).data('venue');
      let status = $(this).data('status');

      $('#edit_conference_id').val(id);
      $('#edit_name').val(name);
      $('#edit_venue').val(venue);
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

      $('#edit_venues_id').val(id);
      $('#edit_name_venues').val(name);
      $('#edit_telephone').val(telephone);
      $('#edit_longitude').val(longitude);
      $('#edit_latitude').val(latitude);
      $('#edit_direction').val(direction);

      $('#edit_venues').modal('show');
    });
  });
</script>