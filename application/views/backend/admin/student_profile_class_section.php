<?php
$running_year = $this->crud->getInfo('running_year');
$student_info = $this->db->get_where('student', array('student_id' => $student_id))->result_array();
foreach ($student_info as $row) :
?>
    <div class="content-w">
        <?php include 'fancy.php'; ?>
        <div class="header-spacer"></div>
        <div class="content-i">
            <div class="content-box">
                <div class="conty">
                    <div class="back backbutton">
                        <a title="<?php echo getEduAppGTLang('return'); ?>" href="<?php echo base_url(); ?>admin/students/"><i class="picons-thin-icon-thin-0131_arrow_back_undo"></i></a>
                    </div>
                    <div class="row">
                        <main class="col col-xl-9 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
                            <div id="newsfeed-items-grid">
                                <div class="ui-block paddingtel">
                                    <div class="user-profile">
                                        <div class="up-head-w" style="background-image:url(<?php echo base_url(); ?>public/uploads/<?php echo $this->crud->getInfo('bglogin'); ?>)">
                                            <div class="up-main-info">
                                                <div class="user-avatar-w">
                                                    <div class="user-avatar">
                                                        <img alt="" src="<?php echo $this->crud->get_image_url('student', $row['student_id']); ?>" class="bg-white">
                                                    </div>
                                                </div>
                                                <h3 class="text-white"><?php echo $row['first_name']; ?> <?php echo $row['last_name']; ?></h3>
                                                <h5 class="up-sub-header">@<?php echo $row['username']; ?></h5>
                                            </div>
                                            <svg class="decor" width="842px" height="219px" viewBox="0 0 842 219" preserveAspectRatio="xMaxYMax meet" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                <g transform="translate(-381.000000, -362.000000)" fill="#FFFFFF">
                                                    <path class="decor-path" d="M1223,362 L1223,581 L381,581 C868.912802,575.666667 1149.57947,502.666667 1223,362 Z"></path>
                                                </g>
                                            </svg>
                                        </div>
                                        <div class="up-controls">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="value-pair">
                                                        <div><?php echo getEduAppGTLang('account_type'); ?>:</div>
                                                        <div class="value badge badge-pill badge-primary"><?php echo getEduAppGTLang('student'); ?></div>
                                                    </div>
                                                    <div class="value-pair">
                                                        <div><?php echo getEduAppGTLang('member_since'); ?>:</div>
                                                        <div class="value"><?php echo $row['since']; ?>.</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ui-block">
                                            <div class="ui-block-title">
                                                <h6 class="title"><?php echo getEduAppGTLang('class_section'); ?>
                                                    <button class="btn btn-success float-right" onclick="showAjaxModal('<?= base_url('modal/popup/modal_add_class_section/' . $student_id) ?>');"><i class="fa fa-plus"></i> Add</button>
                                                </h6>
                                            </div>
                                            <div class="ui-block-content">
                                                <div class="table-responsive">
                                                    <table class="table table-padded">
                                                        <thead>
                                                            <tr>
                                                                <th><?php echo getEduAppGTLang('no'); ?></th>
                                                                <th><?php echo getEduAppGTLang('class'); ?></th>
                                                                <th><?php echo getEduAppGTLang('section'); ?></th>
                                                                <th><?php echo getEduAppGTLang('roll'); ?></th>
                                                                <th><?php echo getEduAppGTLang('year'); ?></th>
                                                                <th class="text-center"><?php echo getEduAppGTLang('status'); ?></th>
                                                                <th><?php echo getEduAppGTLang('action'); ?></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $datax = getStudentClassAndSectionByIdAll($student_id);
                                                            $no = 1;
                                                            foreach ($datax as $item) :
                                                            ?>
                                                                <tr>
                                                                    <td>
                                                                        <?= $no ?>
                                                                    </td>
                                                                    <td>
                                                                        <?= $item->class_name ?>
                                                                    </td>
                                                                    <td>
                                                                        <?= $item->section_name ?>
                                                                    </td>
                                                                    <td>
                                                                        <?= $item->roll ?>
                                                                    </td>
                                                                    <td>
                                                                        <?= $item->year ?>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <?php if ($item->is_active) { ?>
                                                                            <div class="value badge badge-pill badge-success"><?= getEduAppGTLang('active'); ?></div>
                                                                        <?php } else { ?>
                                                                            <div class="value badge badge-pill badge-danger"><?= getEduAppGTLang('disable'); ?></div>
                                                                        <?php } ?>
                                                                    </td>
                                                                    <td>
                                                                        <button class="btn btn-sm btn-primary" href="javascript:void(0);" onclick="showAjaxModal('<?= base_url('modal/popup/modal_edit_class_section/' . $item->enroll_id) ?>');"><i class=" fa fa-edit"></i></button>
                                                                        <a class="btn btn-sm btn-danger" onclick="return confirm('Do you want to delete this?')" href="<?= base_url('admin/delete_student_class_section/' . $item->enroll_id . '/' . $item->student_id) ?>"><i class="fa fa-times"></i></a>
                                                                    </td>

                                                                </tr>
                                                            <?php $no++;
                                                            endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </main>
                        <div class="col col-xl-3 order-xl-1 col-lg-12 order-lg-2 col-md-12 col-sm-12 col-12 ">
                            <div class="eduappgt-sticky-sidebar">
                                <div class="sidebar__inner">
                                    <div class="ui-block paddingtel">
                                        <div class="ui-block-content">
                                            <div class="widget w-about">
                                                <a href="javascript:void(0);" class="logo"><img src="<?php echo base_url(); ?>public/uploads/<?php echo $this->crud->getInfo('logo'); ?>"></a>
                                                <ul class="socials">
                                                    <li><a class="socialDash fb" href="<?php echo $this->crud->getInfo('facebook'); ?>"><i class="fab fa-facebook-square" aria-hidden="true"></i></a></li>
                                                    <li><a class="socialDash tw" href="<?php echo $this->crud->getInfo('twitter'); ?>"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                                                    <li><a class="socialDash yt" href="<?php echo $this->crud->getInfo('youtube'); ?>"><i class="fab fa-youtube" aria-hidden="true"></i></a></li>
                                                    <li><a class="socialDash ig" href="<?php echo $this->crud->getInfo('instagram'); ?>"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ui-block paddingtel">
                                        <div class="ui-block-content">
                                            <div class="help-support-block">
                                                <h3 class="title"><?php echo getEduAppGTLang('quick_links'); ?></h3>
                                                <ul class="help-support-list">
                                                    <li>
                                                        <i class="picons-thin-icon-thin-0133_arrow_right_next px20"></i> &nbsp;&nbsp;&nbsp;
                                                        <a href="<?php echo base_url(); ?>admin/student_portal/<?php echo $student_id; ?>/"><?php echo getEduAppGTLang('personal_information'); ?></a>
                                                    </li>
                                                    <li>
                                                        <i class="picons-thin-icon-thin-0133_arrow_right_next px20"></i> &nbsp;&nbsp;&nbsp;
                                                        <a href="<?php echo base_url(); ?>admin/student_update/<?php echo $student_id; ?>/"><?php echo getEduAppGTLang('update_information'); ?></a>
                                                    </li>
                                                    <li>
                                                        <i class="picons-thin-icon-thin-0133_arrow_right_next px20"></i> &nbsp;&nbsp;&nbsp;
                                                        <a href="<?php echo base_url(); ?>admin/student_invoices/<?php echo $student_id; ?>/"><?php echo getEduAppGTLang('payments_history'); ?></a>
                                                    </li>
                                                    <li>
                                                        <i class="picons-thin-icon-thin-0133_arrow_right_next px20"></i> &nbsp;&nbsp;&nbsp;
                                                        <a href="<?php echo base_url(); ?>admin/student_marks/<?php echo $student_id; ?>/"><?php echo getEduAppGTLang('marks'); ?></a>
                                                    </li>
                                                    <li>
                                                        <i class="picons-thin-icon-thin-0133_arrow_right_next px20"></i> &nbsp;&nbsp;&nbsp;
                                                        <a href="<?php echo base_url(); ?>admin/student_profile_attendance/<?php echo $student_id; ?>/"><?php echo getEduAppGTLang('atendance'); ?></a>
                                                    </li>
                                                    <li>
                                                        <i class="picons-thin-icon-thin-0133_arrow_right_next px20"></i> &nbsp;&nbsp;&nbsp;
                                                        <a href="<?php echo base_url(); ?>admin/student_profile_report/<?php echo $student_id; ?>/"><?php echo getEduAppGTLang('behavior'); ?></a>
                                                    </li>
                                                    <li>
                                                        <i class="px20 picons-thin-icon-thin-0133_arrow_right_next"></i> &nbsp;&nbsp;&nbsp;
                                                        <a href="<?php echo base_url(); ?>admin/student_profile_class_section/<?php echo $student_id; ?>/"><?php echo getEduAppGTLang('class_section'); ?></a>
                                                    </li>
                                                    <li>
                                                        <i class="px20 picons-thin-icon-thin-0133_arrow_right_next"></i> &nbsp;&nbsp;&nbsp;
                                                        <a href="<?php echo base_url(); ?>admin/student_profile_active_course/<?php echo $student_id; ?>/">Active Course</a>
                                                    </li>
                                                </ul>
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
<?php endforeach; ?>