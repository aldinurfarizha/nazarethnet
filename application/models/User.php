<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends School
{
    private $runningYear = '';

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->runningYear = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $this->load->library('excel');
        $this->load->library('phpspreadsheet');
    }

    public function getAccountantInfo()
    {
        $info = $this->db->get_where('accountant', array('accountant_id' => $this->session->userdata('login_user_id')))->result_array();
        return $info;
    }

    public function checkPublicEmail()
    {
        if ($_POST['c'] != "") {
            $credential = array('email' => html_escape($_POST['c']));
            $admin_query = $this->db->get_where('admin', $credential);
            if ($admin_query->num_rows() > 0) {
                return 'success';
            }
            $teacher_query = $this->db->get_where('teacher', $credential);
            if ($teacher_query->num_rows() > 0) {
                return 'success';
            }
            $student_query = $this->db->get_where('student', $credential);
            if ($student_query->num_rows() > 0) {
                return 'success';
            }
            $parent_query = $this->db->get_where('parent', $credential);
            if ($parent_query->num_rows() > 0) {
                return 'success';
            }
            $accountant_query = $this->db->get_where('accountant', $credential);
            if ($accountant_query->num_rows() > 0) {
                return 'success';
            }
            $librarian_query = $this->db->get_where('librarian', $credential);
            if ($librarian_query->num_rows() > 0) {
                return 'success';
            }
        }
    }

    public function createLibrarian()
    {
        $md5 = md5(date('d-m-Y H:i:s'));
        $data['first_name']   = html_escape($this->input->post('first_name'));
        $data['last_name']    = html_escape($this->input->post('last_name'));
        $data['address']      = html_escape($this->input->post('address'));
        $data['image']        = $md5 . str_replace(' ', '', $_FILES['userfile']['name']);
        $data['phone']        = html_escape($this->input->post('phone'));
        $data['gender']       = html_escape($this->input->post('gender'));
        $data['idcard']       = html_escape($this->input->post('idcard'));
        $data['email']        = html_escape($this->input->post('email'));
        $data['birthday']     = html_escape($this->input->post('datetimepicker'));
        $data['since']        = $this->crud->getDateFormat();
        $data['username']     = html_escape($this->input->post('username'));
        $data['password']     = sha1($this->input->post('password'));
        $this->db->insert('librarian', $data);
        $teacher_id = $this->db->insert_id();
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'public/uploads/librarian_image/' . $md5 . str_replace(' ', '', $_FILES['userfile']['name']));
    }

    public function updateLibrarian($librarianId)
    {
        $md5 = md5(date('d-m-y H:i:s'));
        $data['first_name']    = html_escape($this->input->post('first_name'));
        $data['last_name']     = html_escape($this->input->post('last_name'));
        $data['username']      = html_escape($this->input->post('username'));
        $data['email']         = html_escape($this->input->post('email'));
        $data['gender']        = html_escape($this->input->post('gender'));
        $data['phone']         = html_escape($this->input->post('phone'));
        $data['idcard']        = html_escape($this->input->post('idcard'));
        $data['address']       = html_escape($this->input->post('address'));
        if ($this->input->post('datetimepicker') != '') {
            $data['birthday']  = html_escape($this->input->post('datetimepicker'));
        }
        if ($this->input->post('password') != "") {
            $data['password']  = sha1($this->input->post('password'));
        }
        if ($_FILES['userfile']['name'] != "") {
            $data['image']     = $md5 . str_replace(' ', '', $_FILES['userfile']['name']);
        }
        $this->db->where('librarian_id', $librarianId);
        $this->db->update('librarian', $data);
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'public/uploads/librarian_image/' . $md5 . str_replace(' ', '', $_FILES['userfile']['name']));
    }

    public function deleteLibrarian($librarianId)
    {
        $this->db->where('librarian_id', $librarianId);
        $this->db->delete('librarian');
    }

    public function createAccountant()
    {
        $md5 = md5(date('d-m-Y H:i:s'));
        $data['first_name']   = html_escape($this->input->post('first_name'));
        $data['last_name']    = html_escape($this->input->post('last_name'));
        $data['address']      = html_escape($this->input->post('address'));
        $data['image']        = $md5 . str_replace(' ', '', $_FILES['userfile']['name']);
        $data['phone']        = html_escape($this->input->post('phone'));
        $data['gender']       = html_escape($this->input->post('gender'));
        $data['idcard']       = html_escape($this->input->post('idcard'));
        $data['birthday']     = html_escape($this->input->post('datetimepicker'));
        $data['email']        = html_escape($this->input->post('email'));
        $data['since']        = $this->crud->getDateFormat();
        $data['username']     = html_escape($this->input->post('username'));
        $data['password']     = sha1($this->input->post('password'));
        $this->db->insert('accountant', $data);
        $teacher_id = $this->db->insert_id();
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'public/uploads/accountant_image/' . $md5 . str_replace(' ', '', $_FILES['userfile']['name']));
    }

    public function updateAccountant($accountantId)
    {
        $md5 = md5(date('d-m-y H:i:s'));
        $data['first_name']   = html_escape($this->input->post('first_name'));
        $data['last_name']    = html_escape($this->input->post('last_name'));
        $data['username']     = html_escape($this->input->post('username'));
        $data['email']        = html_escape($this->input->post('email'));
        $data['gender']       = html_escape($this->input->post('gender'));
        $data['phone']        = html_escape($this->input->post('phone'));
        $data['idcard']       = html_escape($this->input->post('idcard'));
        $data['address']      = html_escape($this->input->post('address'));
        if ($this->input->post('datetimepicker') != '') {
            $data['birthday'] = html_escape($this->input->post('datetimepicker'));
        }
        if ($this->input->post('password') != "") {
            $data['password'] = sha1($this->input->post('password'));
        }
        if ($_FILES['userfile']['name'] != "") {
            $data['image']    = $md5 . str_replace(' ', '', $_FILES['userfile']['name']);
        }
        $this->db->where('accountant_id', $accountantId);
        $this->db->update('accountant', $data);
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'public/uploads/accountant_image/' . $md5 . str_replace(' ', '', $_FILES['userfile']['name']));
    }

    public function deleteAccountant($accountantId)
    {
        $this->db->where('accountant_id', $accountantId);
        $this->db->delete('accountant');
    }

    public function createAdmin()
    {
        $md5 = md5(date('d-m-y H:i:s'));
        $data['first_name']   = html_escape($this->input->post('first_name'));
        $data['last_name']    = html_escape($this->input->post('last_name'));
        $data['username']     = html_escape($this->input->post('username'));
        $data['password']     = sha1($this->input->post('password'));
        $data['email']        = html_escape($this->input->post('email'));
        $data['birthday']     = html_escape($this->input->post('datetimepicker'));
        $data['gender']       = html_escape($this->input->post('gender'));
        $data['phone']        = html_escape($this->input->post('phone'));
        $data['image']        = $md5 . str_replace(' ', '', $_FILES['userfile']['name']);
        $data['address']      = html_escape($this->input->post('address'));
        $data['since']        = $this->crud->getDateFormat();
        $data['owner_status'] = html_escape($this->input->post('owner_status'));
        $data['branch_id']    = html_escape($this->input->post('branch_id'));
        $this->db->insert('admin', $data);
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'public/uploads/admin_image/' . $md5 . str_replace(' ', '', $_FILES['userfile']['name']));
    }

    public function updateAdmin($adminId)
    {
        $md5 = md5(date('d-m-y H:i:s'));
        $data['first_name']   = html_escape($this->input->post('first_name'));
        $data['last_name']    = html_escape($this->input->post('last_name'));
        $data['username']     = html_escape($this->input->post('username'));
        $data['email']        = html_escape($this->input->post('email'));
        if ($this->input->post('datetimepicker') != "") {
            $data['birthday'] = html_escape($this->input->post('datetimepicker'));
        }
        $data['gender']       = html_escape($this->input->post('gender'));
        $data['phone']        = html_escape($this->input->post('phone'));
        $data['address']      = html_escape($this->input->post('address'));
        if ($this->input->post('password') != "") {
            $data['password'] = sha1($this->input->post('password'));
        }
        if ($_FILES['userfile']['size'] > 0) {
            $data['image']    = $md5 . str_replace(' ', '', $_FILES['userfile']['name']);
        }
        if ($this->input->post('datetimepicker') != "") {
            $data['birthday']     = html_escape($this->input->post('datetimepicker'));
        }
        if ($this->input->post('profession') != "") {
            $data['profession']     = html_escape($this->input->post('profession'));
        }
        if ($this->input->post('idcard') != "") {
            $data['idcard']     = $this->input->post('idcard');
        }
        $data['owner_status'] = $this->input->post('owner_status');
        if($this->input->post('owner_status')==2) {
            $data['branch_id'] = $this->input->post('branch_id');
        }else{
            $data['branch_id'] = null;
        }
        $this->db->where('admin_id', $adminId);
        $this->db->update('admin', $data);
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'public/uploads/admin_image/' . $md5 . str_replace(' ', '', $_FILES['userfile']['name']));
    }

    public function acceptTeacher($teacherId)
    {
        $pending = $this->db->get_where('pending_users', array('user_id' => $teacherId))->result_array();
        foreach ($pending as $row) {
            $data['first_name'] = $row['first_name'];
            $data['last_name']  = $row['last_name'];
            $data['email']      = $row['email'];
            $data['username']   = $row['username'];
            $data['sex']        = $row['sex'];
            $data['password']   = $row['password'];
            $data['phone']      = $row['phone'];
            $data['since']      = $row['since'];
            $this->db->insert('teacher', $data);
            $teacher_id = $this->db->insert_id();
            $this->mail->accountConfirm('teacher', $teacher_id);
        }
        $this->db->where('user_id', $teacherId);
        $this->db->delete('pending_users');
    }

    public function createTeacher()
    {
        $md5 = md5(date('d-m-y H:i:s'));
        $data['first_name']  = html_escape($this->input->post('first_name'));
        $data['last_name']   = html_escape($this->input->post('last_name'));
        $data['sex']         = html_escape($this->input->post('gender'));
        $data['email']       = html_escape($this->input->post('email'));
        $data['phone']       = html_escape($this->input->post('phone'));
        $data['idcard']      = html_escape($this->input->post('idcard'));
        $data['since']       = $this->crud->getDateFormat();
        $data['birthday']    = html_escape($this->input->post('datetimepicker'));
        $data['address']     = html_escape($this->input->post('address'));
        $data['username']    = html_escape($this->input->post('username'));
        if (!empty($_FILES['userfile']['tmp_name'])) {
            $data['image']   = $md5 . str_replace(' ', '', $_FILES['userfile']['name']);
        }
        $data['password']    = sha1($this->input->post('password'));
        $this->db->insert('teacher', $data);
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'public/uploads/teacher_image/' . $md5 . str_replace(' ', '', $_FILES['userfile']['name']));
    }

    public function updateTeacher($teacherId)
    {
        $md5 = md5(date('d-m-y H:i:s'));
        $data['first_name']   = html_escape($this->input->post('first_name'));
        $data['last_name']    = html_escape($this->input->post('last_name'));
        $data['email']        = html_escape($this->input->post('email'));
        $data['phone']        = html_escape($this->input->post('phone'));
        $data['idcard']       = html_escape($this->input->post('idcard'));
        $data['address']      = html_escape($this->input->post('address'));
        $data['username']     = html_escape($this->input->post('username'));
        if ($this->input->post('datetimepicker') != '') {
            $data['birthday'] = html_escape($this->input->post('datetimepicker'));
        }
        if (!empty($_FILES['userfile']['tmp_name'])) {
            $data['image']    = $md5 . str_replace(' ', '', $_FILES['userfile']['name']);
        }
        if ($this->input->post('password') != "") {
            $data['password'] = sha1($this->input->post('password'));
        }
        $this->db->where('teacher_id', $teacherId);
        $this->db->update('teacher', $data);
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'public/uploads/teacher_image/' . $md5 . str_replace(' ', '', $_FILES['userfile']['name']));
    }

    public function deleteTeacher($teacherId)
    {
        $this->db->where('teacher_id', $teacherId);
        $this->db->delete('teacher');
    }

    public function createParent()
    {
        $md5 = md5(date('d-m-y H:i:s'));
        $data['first_name']     = html_escape($this->input->post('first_name'));
        $data['last_name']      = html_escape($this->input->post('last_name'));
        $data['gender']         = html_escape($this->input->post('gender'));
        $data['profession']     = html_escape($this->input->post('profession'));
        $data['email']          = html_escape($this->input->post('email'));
        $data['phone']          = html_escape($this->input->post('phone'));
        $data['home_phone']     = html_escape($this->input->post('home_phone'));
        $data['since']          = $this->crud->getDateFormat();
        $data['idcard']         = html_escape($this->input->post('idcard'));
        $data['business']       = html_escape($this->input->post('business'));
        $data['business_phone'] = html_escape($this->input->post('business_phone'));
        $data['address']        = html_escape($this->input->post('address'));
        $data['username']       = html_escape($this->input->post('username'));
        $data['password']       = sha1($this->input->post('password'));
        $data['image']          = $md5 . str_replace(' ', '', $_FILES['userfile']['name']);
        $this->db->insert('parent', $data);
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'public/uploads/parent_image/' . $md5 . str_replace(' ', '', $_FILES['userfile']['name']));
    }

    public function updateParent($parentId)
    {
        if (!empty($_FILES['userfile']['tmp_name'])) {
            $data['image']     = $md5 . str_replace(' ', '', $_FILES['userfile']['name']);
        }
        $data['first_name']      = html_escape($this->input->post('first_name'));
        $data['last_name']       = html_escape($this->input->post('last_name'));
        $data['gender']          = html_escape($this->input->post('gender'));
        $data['profession']      = html_escape($this->input->post('profession'));
        $data['email']           = html_escape($this->input->post('email'));
        $data['phone']           = html_escape($this->input->post('phone'));
        $data['home_phone']      = html_escape($this->input->post('home_phone'));
        $data['idcard']          = html_escape($this->input->post('idcard'));
        $data['business']        = html_escape($this->input->post('business'));
        $data['business_phone']  = html_escape($this->input->post('business_phone'));
        $data['address']         = html_escape($this->input->post('address'));
        if ($this->input->post('username') != '') {
            $data['username']        = html_escape($this->input->post('username'));
        }
        if ($this->input->post('password') != "") {
            $data['password'] = sha1($this->input->post('password'));
        }
        $this->db->where('parent_id', $parentId);
        $this->db->update('parent', $data);
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'public/uploads/parent_image/' . $md5 . str_replace(' ', '', $_FILES['userfile']['name']));
    }


    public function acceptParent($parentId)
    {
        $pending = $this->db->get_where('pending_users', array('user_id' => $parentId))->result_array();
        foreach ($pending as $row) {
            $data['first_name']  = $row['first_name'];
            $data['last_name']   = $row['last_name'];
            $data['email']       = $row['email'];
            $data['username']    = $row['username'];
            $data['profession']  = $row['profession'];
            $data['since']       = $row['since'];
            $data['password']    = $row['password'];
            $data['phone']       = $row['phone'];
            $this->db->insert('parent', $data);
            $parent_id = $this->db->insert_id();
            $this->mail->accountConfirm('parent', $parent_id);
        }
        $this->db->where('user_id', $parentId);
        $this->db->delete('pending_users');
    }

    public function deleteParent($parentId)
    {
        $this->db->where('parent_id', $parentId);
        $this->db->delete('parent');
    }

    public function updateCurrentAdmin()
    {
        $data['first_name']   = html_escape($this->input->post('first_name'));
        $data['last_name']    = html_escape($this->input->post('last_name'));
        $data['username']     = html_escape($this->input->post('username'));
        $data['email']        = html_escape($this->input->post('email'));
        $data['profession']   = html_escape($this->input->post('profession'));
        $data['idcard']       = html_escape($this->input->post('idcard'));
        if ($this->input->post('datetimepicker') != "") {
            $data['birthday'] = html_escape($this->input->post('datetimepicker'));
        }
        if (!empty($_FILES['userfile']['tmp_name'])) {
            $data['image']    = md5(date('d-m-y H:i:s')) . str_replace(' ', '', $_FILES['userfile']['name']);
        }
        $data['gender']       = html_escape($this->input->post('gender'));
        $data['phone']        = html_escape($this->input->post('phone'));
        $data['address']      = html_escape($this->input->post('address'));
        if ($this->input->post('password') != "") {
            $data['password'] = sha1($this->input->post('password'));
        }
        $this->db->where('admin_id', $this->session->userdata('login_user_id'));
        $this->db->update('admin', $data);
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'public/uploads/admin_image/' . md5(date('d-m-y H:i:s')) . str_replace(' ', '', $_FILES['userfile']['name']));
    }

    public function removeGoogle()
    {
        $data['g_oauth'] = "";
        $data['g_fname'] = "";
        $data['g_lname'] = "";
        $data['g_picture'] = "";
        $data['link'] = "";
        $data['g_email'] = "";
        $this->db->where($this->session->userdata('login_type') . '_id', $this->session->userdata('login_user_id'));
        $this->db->update($this->session->userdata('login_type'), $data);
        unset($_SESSION['token']);
        unset($_SESSION['userData']);
        $this->crud->googleRevokeToken();
    }

    public function removeFacebook()
    {
        $data['fb_token']   =  "";
        $data['fb_id']      =  "";
        $data['fb_photo']   =  "";
        $data['fb_name']    =  "";
        $data['femail']     = "";
        unset($_SESSION['access_token']);
        unset($_SESSION['userData']);
        $this->db->where($this->session->userdata('login_type') . '_id', $this->session->userdata('login_user_id'));
        $this->db->update($this->session->userdata('login_type'), $data);
    }

    public function rejectStudent($studentId)
    {
        $this->db->where('user_id', $studentId);
        $this->db->delete('pending_users');
    }

    public function studentAdmission()
    {
        $md5 = md5(date('d-m-Y H:i:s'));
        $data['first_name']        = html_escape($this->input->post('first_name'));
        $data['last_name']         = html_escape($this->input->post('last_name'));
        $data['birthday']          = html_escape($this->input->post('datetimepicker'));
        $data['username']          = html_escape($this->input->post('username'));
        $data['student_session']   = 1;
        $data['email']             = html_escape($this->input->post('email'));
        $data['since']             = $this->crud->getDateFormat();
        $data['phone']             = html_escape($this->input->post('phone'));
        $data['sex']               = html_escape($this->input->post('gender'));
        $data['password']          = sha1($this->input->post('password'));
        $data['address']           = html_escape($this->input->post('address'));
        $data['transport_id']      = $this->input->post('transport_id');
        $data['dormitory_id']      = $this->input->post('dormitory_id');
        if ($_FILES['userfile']['name'] != '') {
            $data['image']             = $md5 . str_replace(' ', '', $_FILES['userfile']['name']);
        }
        if ($this->input->post('account') != '1') {
            $data['parent_id']        = $this->input->post('parent_id');
        } else if ($this->input->post('account') == '1') {
            $data3['first_name']      = html_escape($this->input->post('parent_first_name'));
            $data3['last_name']       = html_escape($this->input->post('parent_last_name'));
            $data3['gender']          = html_escape($this->input->post('parent_gender'));
            $data3['profession']      = html_escape($this->input->post('parent_profession'));
            $data3['email']           = html_escape($this->input->post('parent_email'));
            $data3['phone']           = html_escape($this->input->post('parent_phone'));
            $data3['home_phone']      = html_escape($this->input->post('parent_home_phone'));
            $data3['idcard']          = html_escape($this->input->post('parent_idcard'));
            $data3['business']        = html_escape($this->input->post('parent_business'));
            $data3['since']           = $this->crud->getDateFormat();
            $data3['business_phone']  = html_escape($this->input->post('parent_business_phone'));
            $data3['address']         = html_escape($this->input->post('parent_address'));
            $data3['username']        = html_escape($this->input->post('parent_username'));
            $data3['password']        = sha1($this->input->post('parent_password'));
            $data3['image']           = "";
            $this->db->insert('parent', $data3);
            $parent_id = $this->db->insert_id();
            $data['parent_id']        = $parent_id;
        }
        $data['diseases']          = html_escape($this->input->post('diseases'));
        $data['allergies']         = html_escape($this->input->post('allergies'));
        $data['doctor']            = html_escape($this->input->post('doctor'));
        $data['doctor_phone']      = html_escape($this->input->post('doctor_phone'));
        $data['authorized_person'] = html_escape($this->input->post('auth_person'));
        $data['authorized_phone']  = html_escape($this->input->post('auth_phone'));
        $data['note']              = html_escape($this->input->post('note'));
        $this->db->insert('student', $data);
        $student_id = $this->db->insert_id();
        $class_ids = $this->input->post('class_id');
        $section_ids = $this->input->post('section_id');
        $rolls = $this->input->post('roll');
        $is_actives = $this->input->post('is_active');
        if ($class_ids && $section_ids && $rolls && $is_actives) {
            $data = [];
            for ($i = 0; $i < count($class_ids); $i++) {
                $data[] = [
                    'student_id' => $student_id,
                    'enroll_code' => substr(md5(rand(0, 1000000)), 0, 7),
                    'class_id' => $class_ids[$i],
                    'section_id' => $section_ids[$i],
                    'roll' => $rolls[$i],
                    'is_active' => $is_actives[$i],
                    'date_added' => strtotime(date("Y-m-d H:i:s")),
                    'year' => $this->runningYear,
                ];
            }
            foreach ($data as $entry) {
                $this->db->insert('enroll', $entry);
            }
            generateSubjectNewStudent($student_id);
        }
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'public/uploads/student_image/' . $md5 . str_replace(' ', '', $_FILES['userfile']['name']));
        return $student_id;
    }

    public function acceptStudent($studentId)
    {
        $pending = $this->db->get_where('pending_users', array('user_id' => $studentId))->result_array();
        foreach ($pending as $row) {
            $data['first_name']    = $row['first_name'];
            $data['last_name']     = $row['last_name'];
            $data['email']         = $row['email'];
            $data['username']      = $row['username'];
            $data['sex']           = $row['sex'];
            $data['password']      = $row['password'];
            $data['birthday']      = $row['birthday'];
            $data['phone']         = $row['phone'];
            $data['since']         = $row['since'];
            $data['date']          = $this->crud->getDateFormat();
            $this->db->insert('student', $data);
            $student_id            = $this->db->insert_id();

            $data2['student_id']   = $student_id;
            $data2['enroll_code']  = substr(md5(rand(0, 1000000)), 0, 7);
            $data2['class_id']     = $row['class_id'];
            $data2['section_id']   = $row['section_id'];
            $data2['roll']         = $row['roll'];
            $data2['date_added']   = strtotime(date("Y-m-d H:i:s"));
            $data2['year']         = $this->runningYear;
            $this->db->insert('enroll', $data2);
            $this->mail->accountConfirm('student', $student_id);
        }
        $this->db->where('user_id', $studentId);
        $this->db->delete('pending_users');
    }

    public function bulkStudents()
    {
        $path   = $_FILES["upload_student"]["tmp_name"];
        $object = PHPExcel_IOFactory::load($path);
        foreach ($object->getWorksheetIterator() as $worksheet) {
            $highestRow = $worksheet->getHighestRow();
            $highestColumn = $worksheet->getHighestColumn();
            for ($row = 2; $row <= $highestRow; $row++) {
                $data['first_name']    =  $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                $data['last_name']     =  $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                $data['email']         =  $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                $data['phone']         =  $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                $data['sex']           =  $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                $data['username']      =  $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                $data['password']      =  sha1($worksheet->getCellByColumnAndRow(6, $row)->getValue());
                $data['address']       =  $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                $data['since']         =  $this->crud->getDateFormat();
                if ($data['first_name'] != "") {
                    $this->db->insert('student', $data);
                    $student_id = $this->db->insert_id();
                    $data2['enroll_code']   =   substr(md5(rand(0, 1000000)), 0, 7);
                    $data2['student_id']    =   $student_id;
                    $data2['class_id']      =   $this->input->post('class_id');
                    if ($this->input->post('section_id') != '') {
                        $data2['section_id']    =   $this->input->post('section_id');
                    }
                    $data2['roll']          =   $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                    $data2['date_added']    =   strtotime(date("Y-m-d H:i:s"));
                    $data2['year']          =   $this->runningYear;
                    $this->db->insert('enroll', $data2);
                }
            }
        }
    }
    public function importStudent()
{
    // Load PhpSpreadsheet via library custom
    $this->load->library('phpspreadsheet');

    $path = $_FILES["upload_student"]["tmp_name"];

    try {
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($path);
    } catch (\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {
        log_message('error', 'Gagal load file Excel: ' . $e->getMessage());
        return false;
    }

    $this->db->trans_begin();

    try {
        $worksheet = $spreadsheet->getActiveSheet();
        $highestRow = $worksheet->getHighestRow();

        for ($row = 2; $row <= $highestRow; $row++) {
            $data['first_name']         = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
            $data['last_name']          = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
            $data['birthday']           = $worksheet->getCellByColumnAndRow(3, $row)->getFormattedValue();
            $data['sex']                = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
            $data['address']            = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
            $data['phone']              = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
            $data['email']              = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
            $data['password']           = sha1($worksheet->getCellByColumnAndRow(8, $row)->getValue());
            $data['username']           = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
            $data['parent_id']          = 0;
            $data['dormitory_id']       = 0;
            $data['transport_id']       = 0;
            $data['student_session']    = 1;
            $data['date']               = null;
            $data['board']              = 0;
            $data['fb_token']           = null;
            $data['fb_id']              = null;
            $data['fb_photo']           = null;
            $data['fb_name']            = null;
            $data['g_oauth']            = null;
            $data['g_fname']            = null;
            $data['femail']             = null;
            $data['g_lname']            = null;
            $data['g_picture']          = null;
            $data['link']               = null;
            $data['g_email']            = null;
            $data['solvencia']          = 1;
            $data['class_id']           = 0;
            $data['image']              = null;
            $data['since']              = date('Y-m-d');
            $data['diseases']           = '';
            $data['allergies']          = '';
            $data['doctor']             = '';
            $data['doctor_phone']       = '';
            $data['authorized_person']  = '';
            $data['authorized_phone']   = '';
            $data['note']               = '';
            $data['year']               = getRunningYear();
            $data['is_active']          = 1;
            $data['branch_id']          = $this->input->post('branch_id');
            $data['shifts_id']          = $this->input->post('shifts_id');

            if (!empty($data['first_name'])) {
                $insert = $this->db->insert('student', $data);
                if (!$insert) {
                    throw new Exception("Gagal menyimpan baris ke-$row");
                }
                $student_id = $this->db->insert_id();
                $class_id = $this->input->post('class_id');
                $section_id = $this->input->post('section_id');
                $roll = $this->input->post('roll');

                $enroll = [
                    'student_id' => $student_id,
                    'class_id' => $class_id,
                    'section_id' => $section_id,
                    'year' => getRunningYear(),
                    'roll' => $roll,
                    'is_active' => 1,
                    'enroll_code' => substr(md5(rand(0, 1000000)), 0, 7),
                    'date_added' => strtotime(date("Y-m-d H:i:s")),
                ];
                $this->db->insert('enroll', $enroll);
                generateSubjectNewStudent($student_id);
            }
        }

        $this->db->trans_commit();
        return true;

    } catch (Exception $e) {
        $this->db->trans_rollback();
        log_message('error', 'Import Gagal: ' . $e->getMessage());
        return false;
    }
}


    public function updateStudent($studentId)
    {
        $md5 = md5(date('d-m-Y H:i:s'));
        $data['first_name']      = html_escape($this->input->post('first_name'));
        $data['last_name']       = html_escape($this->input->post('last_name'));
        $data['birthday']        = html_escape($this->input->post('datetimepicker'));
        $data['email']           = html_escape($this->input->post('email'));
        $data['phone']           = html_escape($this->input->post('phone'));
        $data['sex']             = html_escape($this->input->post('gender'));
        $data['username']        = html_escape($this->input->post('username'));
        if ($this->input->post('password') != "") {
            $data['password'] = sha1($this->input->post('password'));
        }
        $data['address']           = html_escape($this->input->post('address'));
        $data['transport_id']      = html_escape($this->input->post('transport_id'));
        $data['dormitory_id']      = html_escape($this->input->post('dormitory_id'));
        $data['diseases']          = html_escape($this->input->post('diseases'));
        $data['allergies']         = html_escape($this->input->post('allergies'));
        $data['doctor']            = html_escape($this->input->post('doctor'));
        $data['doctor_phone']      = html_escape($this->input->post('doctor_phone'));
        $data['authorized_person'] = html_escape($this->input->post('auth_person'));
        $data['authorized_phone']  = html_escape($this->input->post('auth_phone'));
        $data['branch_id']         = html_escape($this->input->post('branch_id'));
        $data['shifts_id']          = html_escape($this->input->post('shifts_id'));
        $data['note']    = html_escape($this->input->post('note'));
        if ($_FILES['userfile']['size'] > 0) {
            $data['image']         = $md5 . str_replace(' ', '', $_FILES['userfile']['name']);
        }
        $data['parent_id']         = $this->input->post('parent_id');
        $data['student_session']   = $this->input->post('student_session');
        $this->db->where('student_id', $studentId);
        $this->db->update('student', $data);
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'public/uploads/student_image/' . $md5 . str_replace(' ', '', $_FILES['userfile']['name']));
    }

    public function updateCurrentStudent()
    {
        $md5 = md5(date('d-m-Y H:i:s'));
        $data['email'] = html_escape($this->input->post('email'));
        $data['phone'] = html_escape($this->input->post('phone'));
        $data['address'] = html_escape($this->input->post('address'));
        if ($this->input->post('password') != "") {
            $data['password'] = sha1($this->input->post('password'));
        }
        if ($_FILES['userfile']['size'] > 0) {
            $data['image']     = $md5 . str_replace(' ', '', $_FILES['userfile']['name']);
        }
        $this->db->where('student_id', $this->session->userdata('login_user_id'));
        $this->db->update('student', $data);
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'public/uploads/student_image/' . $md5 . str_replace(' ', '', $_FILES['userfile']['name']));
    }

    public function updateModalStudent($studentId)
    {
        $md5 = md5(date('d-m-Y H:i:s'));
        $data['first_name']      = html_escape($this->input->post('first_name'));
        $data['last_name']       = html_escape($this->input->post('last_name'));
        $data['username']        = html_escape($this->input->post('username'));
        $data['phone']           = html_escape($this->input->post('phone'));
        $data['address']         = html_escape($this->input->post('address'));
        $data['parent_id']       = $this->input->post('parent_id');
        $data['student_session'] = $this->input->post('student_session');
        $data['email']           = html_escape($this->input->post('email'));
        if ($_FILES['userfile']['size'] > 0) {
            $data['image']     = $md5 . str_replace(' ', '', $_FILES['userfile']['name']);
        }
        if ($this->input->post('password') != "") {
            $data['password'] = sha1($this->input->post('password'));
        }
        $this->db->where('student_id', $studentId);
        $this->db->update('student', $data);
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'public/uploads/student_image/' . $md5 . str_replace(' ', '', $_FILES['userfile']['name']));
    }

    public function downloadExcel()
    {
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', getEduAppGTLang('first_name'));
        $objPHPExcel->getActiveSheet()->setCellValue('B1', getEduAppGTLang('last_name'));
        $objPHPExcel->getActiveSheet()->setCellValue('C1', getEduAppGTLang('username'));
        $objPHPExcel->getActiveSheet()->setCellValue('D1', getEduAppGTLang('email'));
        $objPHPExcel->getActiveSheet()->setCellValue('E1', getEduAppGTLang('phone'));
        $objPHPExcel->getActiveSheet()->setCellValue('F1', getEduAppGTLang('gender'));
        $objPHPExcel->getActiveSheet()->setCellValue('G1', getEduAppGTLang('class'));
        $objPHPExcel->getActiveSheet()->setCellValue('H1', getEduAppGTLang('section'));
        $objPHPExcel->getActiveSheet()->setCellValue('I1', getEduAppGTLang('parent'));

        $a = 2;
        $b = 2;
        $c = 2;
        $d = 2;
        $e = 2;
        $f = 2;
        $g = 2;
        $h = 2;
        $i = 2;

        $query = $this->db->get_where('enroll', array('class_id' => $this->input->post('class_id'), 'section_id' => $this->input->post('section_id'), 'year' => $this->runningYear))->result_array();
        foreach ($query as $row) {
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $a++, $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->first_name);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $b++, $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->last_name);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $c++, $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->username);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $d++, $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->email);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $e++, $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->phone);
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $f++, $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->sex);
            $objPHPExcel->getActiveSheet()->setCellValue('G' . $g++, $this->db->get_where('class', array('class_id' => $row['class_id']))->row()->name);
            $objPHPExcel->getActiveSheet()->setCellValue('H' . $h++, $this->db->get_where('section', array('section_id' => $row['section_id']))->row()->name);
            $parent_id = $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->parent_id;
            $objPHPExcel->getActiveSheet()->setCellValue('I' . $i++, $this->crud->get_name('parent', $parent_id));
        }
        $objPHPExcel->getActiveSheet()->setTitle(getEduAppGTLang('students'));

        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="export_students_' . date('d-m-y:h:i:s') . '.xlsx"');
        header("Content-Transfer-Encoding: binary ");
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->setOffice2003Compatibility(true);
        $objWriter->save('php://output');
    }

    public function updateCurrentAccountant()
    {
        $md5 = md5(date('d-m-y H:i:s'));
        $data['email']        = html_escape($this->input->post('email'));
        $data['idcard']       = html_escape($this->input->post('idcard'));
        $data['phone']        = html_escape($this->input->post('phone'));
        $data['address']      = html_escape($this->input->post('address'));
        if ($this->input->post('password') != "") {
            $data['password'] = sha1($this->input->post('password'));
        }
        if ($_FILES['userfile']['name'] != "") {
            $data['image']    = $md5 . str_replace(' ', '', $_FILES['userfile']['name']);
        }
        $this->db->where('accountant_id', $this->session->userdata('login_user_id'));
        $this->db->update('accountant', $data);
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'public/uploads/accountant_image/' . $md5 . str_replace(' ', '', $_FILES['userfile']['name']));
    }

    public function updateCurrentLibrarian()
    {
        $md5 = md5(date('d-m-y H:i:s'));
        $data['email']        = html_escape($this->input->post('email'));
        $data['idcard']       = html_escape($this->input->post('idcard'));
        $data['phone']        = html_escape($this->input->post('phone'));
        $data['address']      = html_escape($this->input->post('address'));
        if ($this->input->post('password') != "") {
            $data['password'] = sha1($this->input->post('password'));
        }
        if ($_FILES['userfile']['name'] != "") {
            $data['image']    = $md5 . str_replace(' ', '', $_FILES['userfile']['name']);
        }
        $this->db->where('librarian_id', $this->session->userdata('login_user_id'));
        $this->db->update('librarian', $data);
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'public/uploads/librarian_image/' . $md5 . str_replace(' ', '', $_FILES['userfile']['name']));
    }

    public function createPublicTeacherAccount()
    {
        $data['first_name']        = html_escape($this->input->post('first_name'));
        $data['last_name']        = html_escape($this->input->post('last_name'));
        $data['since']     = $this->crud->getDateFormat();
        $data['username']    = html_escape($this->input->post('username'));
        $data['phone']       = html_escape($this->input->post('phone'));
        $data['email']        = html_escape($this->input->post('email'));
        $data['sex']       = html_escape($this->input->post('sex'));
        $data['birthday']    = html_escape($this->input->post('birthday'));
        $data['type']    = "teacher";
        $data['password']    = sha1($this->input->post('password'));
        $this->db->insert('pending_users', $data);
        $user_id = $this->db->insert_id();
        $this->mail->welcomeUser($user_id);

        $notify['notify'] = "<strong>" . getEduAppGTLang('register') . ":</strong>," . " " . getEduAppGTLang('reg_teacher') . "<b>" . $this->input->post('name') . "</b>";
        $admins = $this->db->get('admin')->result_array();
        foreach ($admins as $row) {
            $notify['user_id'] = $row['admin_id'];
            $notify['user_type'] = 'admin';
            $notify['url'] = "admin/pending/";
            $notify['date'] = $this->crud->getDateFormat();
            $notify['time'] = date('h:i A');
            $notify['status'] = 0;
            $notify['original_id'] = "";
            $notify['original_type'] = "";
            $this->db->insert('notification', $notify);
        }
    }

    public function createPublicStudentAccount()
    {
        $data['class_id']    = html_escape($this->input->post('class_id'));
        $data['section_id']  = html_escape($this->input->post('section_id'));
        $data['parent_id']   = html_escape($this->input->post('parent_id'));
        $data['first_name']        = html_escape($this->input->post('first_name'));
        $data['last_name']        = html_escape($this->input->post('last_name'));
        $data['since']     = $this->crud->getDateFormat();
        $data['username']    = html_escape($this->input->post('username'));
        $data['phone']       = html_escape($this->input->post('phone'));
        $data['email']        = html_escape($this->input->post('email'));
        $data['sex']         = html_escape($this->input->post('sex'));
        $data['birthday']    = html_escape($this->input->post('birthday'));
        $data['roll']        = html_escape($this->input->post('roll'));
        $data['type']        = "student";
        $data['password']    = sha1($this->input->post('password'));
        $this->db->insert('pending_users', $data);
        $user_id = $this->db->insert_id();
        $this->mail->welcomeUser($user_id);

        $notify['notify'] = "<strong>" . getEduAppGTLang('register') . ":</strong>," . " " . getEduAppGTLang('reg_student') . "<b>" . $this->input->post('name') . "</b>";
        $admins = $this->db->get('admin')->result_array();
        foreach ($admins as $row) {
            $notify['user_id'] = $row['admin_id'];
            $notify['user_type'] = 'admin';
            $notify['url'] = "admin/pending/";
            $notify['date'] = $this->crud->getDateFormat();
            $notify['time'] = date('h:i A');
            $notify['status'] = 0;
            $notify['original_id'] = "";
            $notify['original_type'] = "";
            $this->db->insert('notification', $notify);
        }
    }

    public function createPublicParentAccount()
    {
        $data['first_name']        = html_escape($this->input->post('first_name'));
        $data['last_name']        = html_escape($this->input->post('last_name'));
        $data['email']        = html_escape($this->input->post('email'));
        $data['since']     = $this->crud->getDateFormat();
        $data['username']    = html_escape($this->input->post('username'));
        $data['phone']       = html_escape($this->input->post('phone'));
        $data['profession']    = html_escape($this->input->post('profession'));
        $data['type']        = "parent";
        $data['password']    = sha1($this->input->post('password'));
        $this->db->insert('pending_users', $data);
        $user_id = $this->db->insert_id();
        $this->mail->welcomeUser($user_id);

        $notify['notify'] = "<strong>" . getEduAppGTLang('register') . ":</strong>," . " " . getEduAppGTLang('reg_parent') . "<b>" . $this->input->post('name') . "</b>";
        $admins = $this->db->get('admin')->result_array();
        foreach ($admins as $row) {
            $notify['user_id'] = $row['admin_id'];
            $notify['user_type'] = 'admin';
            $notify['url'] = "admin/pending/";
            $notify['date'] = $this->crud->getDateFormat();
            $notify['time'] = date('h:i A');
            $notify['status'] = 0;
            $notify['original_id'] = "";
            $notify['original_type'] = "";
            $this->db->insert('notification', $notify);
        }
    }

    public function updateCurrentTeacher()
    {
        $md5 = md5(date('d-m-y H:i:s'));
        $data['email']          = html_escape($this->input->post('email'));
        $data['phone']          = html_escape($this->input->post('phone'));
        $data['idcard']         = html_escape($this->input->post('idcard'));
        $data['birthday']       = html_escape($this->input->post('birthday'));
        $data['address']        = html_escape($this->input->post('address'));
        $data['username']       = html_escape($this->input->post('username'));
        if ($_FILES['userfile']['name'] != "") {
            $data['image']      = $md5 . str_replace(' ', '', $_FILES['userfile']['name']);
        }
        if ($_FILES['signature']['name'] != "") {
            $data['signature']      = $md5 . str_replace(' ', '', $_FILES['signature']['name']);
        }
        if ($this->input->post('password') != "") {
            $data['password']      = sha1($this->input->post('password'));
        }
        $this->db->where('teacher_id', $this->session->userdata('login_user_id'));
        $this->db->update('teacher', $data);
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'public/uploads/teacher_image/' . $md5 . str_replace(' ', '', $_FILES['userfile']['name']));
        move_uploaded_file($_FILES['signature']['tmp_name'], 'public/uploads/teacher_image/' . $md5 . str_replace(' ', '', $_FILES['signature']['name']));
    }
}
