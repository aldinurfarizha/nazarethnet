    <?php $running_year = $this->crud->getInfo('running_year');?>
    <div class="content-w">
        <?php include 'fancy.php';?>
        <div class="header-spacer"></div>
        <div class="conty">
	        <div class="os-tabs-w menu-shad">
		        <div class="os-tabs-controls">
			        <ul class="navs navs-tabs">
				        <li class="navs-item">
				            <a class="navs-links" href="<?php echo base_url();?>admin/general_reports/"><i class="picons-thin-icon-thin-0658_cup_place_winner_award_prize_achievement"></i> <span><?php echo getEduAppGTLang('classes');?></span></a>
				        </li>
				        <li class="navs-item">
				            <a class="navs-links" href="<?php echo base_url();?>admin/students_report/"><i class="picons-thin-icon-thin-0729_student_degree_science_university_school_graduate"></i>  <span><?php echo getEduAppGTLang('students');?></span></a>
				        </li>
				        <li class="navs-item">
				            <a class="navs-links" href="<?php echo base_url();?>admin/attendance_report/"><i class="os-icon picons-thin-icon-thin-0023_calendar_month_day_planner_events"></i>  <span><?php echo getEduAppGTLang('attendance');?></span></a>
				        </li>
				        <li class="navs-item">
				            <a class="navs-links" href="<?php echo base_url();?>admin/marks_report/"><i class="picons-thin-icon-thin-0100_to_do_list_reminder_done"></i>  <span><?php echo getEduAppGTLang('final_marks');?></span></a>
				        </li>
				        <li class="navs-item">
				            <a class="navs-links" href="<?php echo base_url();?>admin/tabulation_report/"><i class="picons-thin-icon-thin-0070_paper_role"></i> <span><?php echo getEduAppGTLang('tabulation_sheet');?></span></a>
				        </li>
				        <li class="navs-item">
				            <a class="navs-links <?php if($page_name == 'accounting_report') echo "active";?>" href="<?php echo base_url();?>admin/accounting_report/"><i class="picons-thin-icon-thin-0406_money_dollar_euro_currency_exchange_cash"></i>  <span><?php echo getEduAppGTLang('accounting');?></span></a>
				        </li>
			        </ul>
		        </div>
	        </div>
  	        <div class="content-i">
	            <div class="content-box">      		
	  		        <h5 class="form-header"><?php echo getEduAppGTLang('accounting_report');?></h5><hr>
	  		        <div class="row  bg-white">
				        <div class="col-sm-12">
					        <canvas id="accountingReportChart" class="canvasHeight"></canvas>
				        </div>
	      	        </div>
    	        </div>
   	        </div>
        </div>
    </div>
    
    <script>
        'use strict';
        var expense    = '<?php echo getEduAppGTLang('expense');?>';
        var income     = '<?php echo getEduAppGTLang('income');?>';
        var january    = '<?php echo getEduAppGTLang('january');?>';
        var february   = '<?php echo getEduAppGTLang('february');?>';
        var march      = '<?php echo getEduAppGTLang('march');?>';
        var april      = '<?php echo getEduAppGTLang('april');?>';
        var may        = '<?php echo getEduAppGTLang('may');?>';
        var june       = '<?php echo getEduAppGTLang('june');?>';
        var july       = '<?php echo getEduAppGTLang('july');?>';
        var august     = '<?php echo getEduAppGTLang('august');?>';
        var september  = '<?php echo getEduAppGTLang('september');?>';
        var october    = '<?php echo getEduAppGTLang('october');?>';
        var november   = '<?php echo getEduAppGTLang('november');?>';
        var december   = '<?php echo getEduAppGTLang('december');?>';
        var accounting_report = '<?php echo getEduAppGTLang('accounting_report');?>';
    </script>