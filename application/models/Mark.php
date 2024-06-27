<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mark extends School 
{
    private $runningYear = '';
    
    function __construct() 
    {
        parent::__construct();
        $this->load->database();
        $this->runningYear = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
    }
    
    public function get_enroll_students($subject_id = '', $class_id = '', $section_id = '', $year = '', $orden = '')
    {
        if ($orden == '1') {
            $query = $this->db->query('SELECT s.student_id, e.roll FROM student AS s INNER JOIN enroll AS e ON s.student_id = e.student_id INNER JOIN subject AS su ON su.section_id = e.section_id WHERE su.subject_id = ' . $subject_id . ' AND e.class_id = ' . $class_id . ' AND e.section_id = ' . $section_id . ' AND e.year = ' . $year . ' ORDER BY s.first_name ASC')->result_array();
        } elseif ($orden == '2') {
            $query = $this->db->query('SELECT s.student_id,e.roll FROM student AS s INNER JOIN enroll AS e ON s.student_id = e.student_id INNER JOIN subject AS su ON su.section_id = e.section_id WHERE su.subject_id = ' . $subject_id . ' AND e.class_id = ' . $class_id . ' AND e.section_id = ' . $section_id . ' AND e.year = ' . $year . ' ORDER BY s.first_name DESC')->result_array();
        }
        return $query;
    }
    
    public function uploadMarks($datainfo = '', $exam_id = '', $orden = '')
    {
        $info               = base64_decode($datainfo);
        $ex                 = explode('-', $info);
        $data['class_id']   = $ex[0];
        $data['section_id'] = $ex[1];
        $data['subject_id'] = $ex[2];
        $data['exam_id']    = $exam_id;
        $year               = $this->runningYear;
        
        $students           = $this->get_enroll_students($ex[2], $ex[0], $ex[1], $year, $orden);
        foreach ($students as $row) 
        {
            $verify_data = array('exam_id' => $exam_id, 'class_id' => $ex[0], 'section_id' => $ex[1], 'student_id' => $row['student_id'], 'subject_id' => $ex[2], 'year' => $year);
            $query = $this->db->get_where('mark', $verify_data);
            if ($query->num_rows() < 1) 
            {
                $data['year'] = $year;
                $data['student_id'] = $row['student_id'];
                $this->db->insert('mark', $data);
            }
        }
    }

    public function newActivity($datainfo, $exam_id)
    {
        $info = base64_decode($datainfo);
        $ex = explode('-', $info);
        $year = $this->runningYear;
        
        $data['exam_id']    = $exam_id;
        $data['class_id']   = $ex[0];
        $data['section_id'] = $ex[1];
        $data['subject_id'] = $ex[2];
        $data['name']       = $this->input->post('name');
        $data['year']       = $year;
        $this->db->insert('mark_activity', $data);
        $data2['mark_activity_id']  = $this->db->insert_id();
        $students = $this->db->get_where('enroll', array('class_id' => $ex[0], 'section_id' => $ex[1], 'year' => $year))->result_array();
        $capacidades = $this->db->get_where('mark_activity', array('exam_id' => $exam_id, 'class_id' => $ex[0], 'section_id' => $ex[1], 'subject_id' => $ex[2], 'year' => $year))->result_array();
        $total = 0;
        $average = 0;
        
        foreach ($students as $row)
        {
            $data2['student_id'] = $row['student_id'];
            $this->db->insert('nota_capacidad', $data2);
            
            foreach($capacidades as $rowx)
            {
                $queryMark = $this->db->get_where('nota_capacidad', array('mark_activity_id' => $rowx['mark_activity_id'], 'student_id' => $row['student_id']))->result_array();
                foreach($queryMark as $rm)
                {
                    $total += $rm['nota'];
                }
            }   
            
            if(count($capacidades) > 0) 
            {
                $average = number_format($total/count($capacidades),2,".",",");
            } else {
                $average = '0.00';   
            }
            
            $dataM['mark_obtained'] = $total;
            $dataM['final']         = $average;

            $this->db->where('student_id', $row['student_id']);
            $this->db->where('subject_id', $ex[2]);
            $this->db->where('exam_id', $exam_id);
            $this->db->where('class_id', $ex[0]);
            $this->db->where('section_id', $ex[1]);
            $this->db->where('year', $year);
            $this->db->update('mark', $dataM);
            
            $average = 0;
            $total   = 0;
        }
    }

    public function updateActivity()
    {
        $data['name'] = $this->input->post('name');
        $this->db->where('mark_activity_id', $this->input->post('mark_activity_id'));
        $this->db->update('mark_activity', $data);
    }
    
    public function delete_capacity($capac_id = '', $order = '')
    {
        $query = $this->db->get_where('mark_activity', array('mark_activity_id' => $capac_id))->row();
        
        $this->db->where('mark_activity_id', $capac_id);
        $this->db->delete('mark_activity');

        $this->db->where('mark_activity_id', $capac_id);
        $this->db->delete('nota_capacidad');
        
        $this->recalculateMark($query,$order);
    }
    
    function recalculateMark($query, $order)
    {
        $capacidades = $this->db->get_where('mark_activity', array('exam_id' => $query->exam_id, 'class_id' => $query->class_id, 'section_id' => $query->section_id, 'subject_id' => $query->subject_id, 'year' => $query->year))->result_array();
        $total = 0;
        $average = 0;
        $studs = $this->mark->get_enroll_students($query->subject_id, $query->class_id, $query->section_id, $query->year, $order);
        foreach($studs as $rows)
        {
            foreach($capacidades as $row)
            {
                $queryMark = $this->db->get_where('nota_capacidad', array('mark_activity_id' => $row['mark_activity_id'], 'student_id' => $rows['student_id']))->result_array();
                foreach($queryMark as $rm)
                {
                    $total += $rm['nota'];
                }
            }   
            
            if(count($capacidades) > 0) 
            {
                $average = number_format($total/count($capacidades),2,".",",");
            } else {
                $average = '0.00';   
            }
            
            $dataM['mark_obtained'] = $total;
            $dataM['final']         = $average;

            $this->db->where('student_id', $rows['student_id']);
            $this->db->where('subject_id', $query->subject_id);
            $this->db->where('exam_id', $query->exam_id);
            $this->db->where('class_id', $query->class_id);
            $this->db->where('section_id', $query->section_id);
            $this->db->where('year', $query->year);
            $this->db->update('mark', $dataM);
            
            $average = 0;
            $total   = 0;
        }
    }
    
    public function notasUpdate($datainfo = '', $exam_id = ' ', $orden = '')
    {
        $info = base64_decode($datainfo);
        $ex = explode('-', $info);
        $data['class_id']   = $ex[0];
        $data['section_id'] = $ex[1];
        $data['subject_id'] = $ex[2];
        $data['exam_id']    = $exam_id;
        $year               = $this->runningYear;
        $students           = $this->get_enroll_students($ex[2], $ex[0], $ex[1], $year, $orden);
        foreach ($students as $row) 
        {
            $capacidades = $this->db->order_by('mark_activity_id', 'ASC')->get_where('mark_activity', array('subject_id' => $ex[2], 'exam_id' => $exam_id, 'class_id' => $ex[0], 'section_id' => $ex[1], 'year' => $year))->result_array();
            foreach ($capacidades as $cap) 
            {
                $nota_cap = $this->db->order_by('nota_capacidad_id', 'ASC')->get_where('nota_capacidad', array('mark_activity_id' => $cap['mark_activity_id'], 'student_id' => $row['student_id']))->result_array();
                foreach ($nota_cap as $nota) 
                {
                    $data2['nota'] = $this->input->post('mark_' . $row['student_id'] . '_' . $cap['mark_activity_id'] . '');
                    $this->db->where('nota_capacidad_id', $nota['nota_capacidad_id']);
                    $this->db->update('nota_capacidad', $data2);
                }
            }

            $data['mark_obtained'] = $this->input->post('mark_obtained_' . $row['student_id'] . '');
            $data['final']         = $this->input->post('final_avg_' . $row['student_id'] . '');
            $data['comment']       = $this->input->post('comment_' . $row['student_id'] . '');

            $this->db->where('student_id', $row['student_id']);
            $this->db->where('subject_id', $ex[2]);
            $this->db->where('exam_id', $exam_id);
            $this->db->where('class_id', $ex[0]);
            $this->db->where('section_id', $ex[1]);
            $this->db->where('year', $year);
            $this->db->update('mark', $data);
        }
    }
  
}