<style>
    .hover-shadow:hover {
  box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
  transform: translateY(-2px);
}

.transition {
  transition: all 0.3s ease;
}

</style>
<div class="content-w">
    <?php include 'fancy.php';?>
    <div class="header-spacer"></div>
    <div class="content-i">
        <div class="content-box">
            <div class="conty">
                <div class="row g-4">
                    <?php 
                    if(isSuperAdmin()){
                        $branch = $this->db->where([
                            'status'=>'ACTIVE'
                        ])->get('branch')->result_array();
                    }else{
                        $branch = $this->db->where([
                            'branch_id'=>getMyBranchId()->branch_id,
                            'status'=>'ACTIVE'
                        ])->get('branch')->result_array();
                    }
                        foreach($branch as $branches):
                    ?>
                    <div class="col-12 col-sm-6 col-lg-3 mb-3">
                        <a href="<?=base_url('admin/grados/'.$branches['branch_id'])?>" class="text-decoration-none">
                            <div class="card card-branch text-center shadow-lg border-0 rounded-4 p-4 hover-shadow transition h-100 d-flex align-items-center justify-content-center">
                            <div>
                                <i class="fas fa-building fa-3x text-primary mb-3"></i>
                                <h5 class="fw-bold text-dark"><?=$branches['name']?></h5>
                            </div>
                            </div>
                        </a>
                        </div>

                    <?php endforeach;?>
                </div>
            </div>
        </div>
    </div>
</div>