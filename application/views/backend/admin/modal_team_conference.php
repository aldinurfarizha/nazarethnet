<?php $data = $this->db->get_where('team_conference', array('team_conference_id' => $param2))->result_array();
        foreach($data as $row):
?>
<div class="modal-body">
    <div class="ui-block-title" style="background-color:#00579c">
      <h6 class="title" style="color:white"><?php echo getEduAppGTLang('create_team_conference');?></h6>
    </div>
    <div class="ui-block-content">
    	<?php echo form_open(base_url() . 'admin/team_conferences/update/'.$row['team_conference_id'].'/', array('enctype' => 'multipart/form-data')); ?>
            <div class="row">
                <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
            		<div class="form-group">
              			<label class="control-label"><?php echo getEduAppGTLang('title');?></label>
              			<input class="form-control" name="title" type="text" value="<?php echo $row['title'];?>">
                	</div>
          		</div>
          		
          		<div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="form-group">
                        <label class="col-form-label" for=""><?php echo getEduAppGTLang('date');?></label>
                        <div class="input-group">
                            <input type='text' value="<?php echo $row['start_date'];?>" class="datepicker-here" data-position="top left" data-language='en' name="start_date2" data-multiple-dates-separator="/"/>
                        </div>
                    </div>
                </div>
          		<div class="col col-lg-6 col-md-6 col-sm-12 col-6">
                    <div class="form-group">
                        <label class="col-form-label" for=""><?php echo getEduAppGTLang('start_time');?></label>
                        <div class="input-group clockpicker" data-align="top" data-autoclose="true">
                            <input type="text" required="" value="<?php echo $row['start_time'];?>" name="start_time2" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col col-lg-6 col-md-6 col-sm-12 col-6">
                    <div class="form-group">
                        <label class="col-form-label" for=""><?php echo getEduAppGTLang('end_time');?></label>
                        <div class="input-group clockpicker" data-align="top" data-autoclose="true">
                            <input type="text" required="" value="<?php echo $row['end_time'];?>" name="end_time2" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col col-lg-6 col-md-6 col-sm-12 col-6">
                    <div class="form-group">
                        <label class="control-label"><?php echo getEduAppGTLang('zoom_meeting_id');?></label>
                        <input class="form-control" name="zoom_meeting_id" type="text" required="" value="<?php echo $row['zoom_meeting_id'];?>">
                    </div>
                </div>
                <div class="col col-lg-6 col-md-6 col-sm-12 col-6">
                    <div class="form-group">
                        <label class="control-label"><?php echo getEduAppGTLang('zoom_meeting_password');?></label>
                        <input class="form-control" name="zoom_meeting_password" type="text" required="" value="<?php echo $row['zoom_meeting_password'];?>">
                    </div>
                </div>
                <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
            		<div class="form-group">
              			<label class="control-label"><?php echo getEduAppGTLang('description');?></label>
              			<textarea class="form-control" rows="5" name="description"><?php echo $row['description'];?></textarea>
            		</div>
          		</div> 
        	</div>
      		<div class="form-buttons-w text-right">
             	<center><button class="btn btn-rounded btn-success btn-lg" type="submit"><?php echo getEduAppGTLang('save');?></button></center>
      		</div>
      	<?php echo form_close();?>        
    </div>
</div>
<?php endforeach;?>        
