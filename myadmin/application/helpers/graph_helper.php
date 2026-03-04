<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if (! function_exists('monthly_job')) {
  function monthly_job() {
    $CI = &  get_instance();
    $CI->load->database();
     $sql = "select t_job_date from arya_jobs_tbl"; 
     $query = $CI->db->query($sql);
     $result = $query->result();
    //$result = $CI->db->get('arya_jobs_tbl')->result();
    foreach ($result as $key) {
        $sources[] = $key->t_job_date;
    }
    foreach ($result as $mnth) {
    	$CI->db->where('t_job_date',date('Y-m-d')); 
       	$rslt = $CI->db->count_all_results('arya_jobs_tbl');
       	$months[] = $rslt;
    }
    $data = array("counsolers"=>$sources, "months"=>$months);
    return json_encode($data);
  }
}