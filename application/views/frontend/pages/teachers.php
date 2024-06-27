    <section class="subpage-hero">
		<div class="subpage-hero__content container-fluid">
			<div class="row">
				<div class="col-md-12 col-sm-12 mx-auto">
					<h1 class="subpage-hero__header"><?php echo getEduAppGTLang('our_school_teachers');?></h1>
				</div>
			</div>
		</div>
	</section>
    <section class="subpage-presentations min-top">
        <div class="presentation presentation--image-left">
            <div class="row container-fluid">
                <div class="presentation__content col-12 col-md-12">
                    <br>
                    <div class="row">
                        <div class="col-lg-10 justify-content-center mx-auto">
                            <div class="row align-items-center container-fluid presentation__content">
                                <ul class="list-unstyled feature-list row container-fluid text-center justify-content-left">  
                                    <?php 
                                        $teachers = $this->db->get('teacher')->result_array();
                                        foreach($teachers as $row):
                                    ?>
                                    <li class="feature-list__item feature-list__item--align-left media col-md-4">
                                        <center><img src="<?php echo $this->crud->get_image_url('teacher', $row['teacher_id']);?>" class="teacher"></center>
                                        <div class="media-body mx-auto text-center teacher-details">
                                            <h3 class="mt-0 mb-0"><?php echo  $this->crud->get_name('teacher', $row['teacher_id']);?></h3>
                                            <p><?php echo $row['email'];?></p>
                                        </div>
                                    </li>
                                    <?php endforeach;?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>