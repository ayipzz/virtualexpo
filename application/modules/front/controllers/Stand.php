<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*------------------------------------------------
| Front Stand Controller - Virtual Expo v1.0
| By Amydin Syahira
| 20 October 2016 (Thursday)
--------------------------------------------------
*/

/**
 * @author amydinsyahira
 */
class Stand extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('FrontModel');
        $this->load->helper('inflector');
    }
    
    public function index() {
    	$event_id = $this->input->post('event_id');
    	$stand_id = $this->input->post('stand_id');
    	if(empty($event_id) && empty($this->session->userdata("event_id"))) {
    		redirect('home');
    	} else {
    		if(!empty($event_id)) {
		    	$sess_data['event_id'] = $event_id;
				$sess_data['stand_id'] = $stand_id;
				
				$this->session->set_userdata($sess_data);
			}

	    	$stand_idnew = explode("_", $this->session->userdata("stand_id"));
	    	$standdetail = $this->get_stands_detail($this->session->userdata("event_id"), $this->session->userdata("stand_id"));
	    	$data = array(
	    		'event_id' => $this->session->userdata("event_id"),
	    		'stand_id' => $stand_idnew[1],
	    		'stand_detail' => $standdetail
	    	);
	    	$template_data = array(
	    		'navigation' => $this->load->view('navigation',$data,true),
	    		'content_page' => $this->load->view('page_reserve_stand',$data,true),
	    		'footer' => ''
	    	);
	        $this->load->view('template',$template_data);
    	}
    }

    public function get_stands_detail($event_id, $stands_id)
    {
    	$arr_result = array();
    	$var_data = array();
    	$get_eventstands = $this->FrontModel->geteventstandsdetail($event_id,$stands_id);
    	foreach ($get_eventstands->result() as $es) {
    		$ev_startdate = explode(" ", $es->e_startdatetime);
    		$ev_enddate = explode(" ", $es->e_enddatetime);
    		$stand_image = '';
			if($es->stand_image = '' || $es->stand_image == null) {
				$stand_image = 'assets/front/images/stand_empty.jpg';
			} else {
				$stand_image = $es->stand_image;
			}

    		$var_data['event_id'] = $es->e_id;
    		$var_data['event_name'] = $es->e_name;
    		$var_data['event_startdate'] = xdate_format($ev_startdate[0]);
    		$var_data['event_starttime'] = $ev_startdate[1];
    		$var_data['event_enddate'] = xdate_format($ev_enddate[0]);
    		$var_data['event_endtime'] = $ev_enddate[1];
    		$var_data['event_location'] = $es->e_location;
    		$var_data['event_description'] = $es->e_description;
    		if(!empty($es->stand_price)) {
    			$var_data['event_price'] = $es->stand_price;
    		} else {
    			$var_data['event_price'] = $es->es_priceinfo;
    		}
    		$var_data['event_standimage'] = $stand_image;
    		array_push($arr_result, $var_data);
    	}
    	return $arr_result;
    }

    public function reserve()
    {
    	$event_id = $this->input->post('event_id');
    	$c_id = $this->input->post('c_id');
    	$stand_id = $this->input->post('stand_id');
    	$stand_price = $this->input->post('stand_price');

    	$config['upload_path'] = 'uploads/company_doc/';
        $config['allowed_types'] = 'doc|docx|pdf|ppt|pptx|zip|rar';
        $this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('marketing_doc'))
        {
            $this->session->set_flashdata('reserve_stand_msg','<div class="alert alert-danger" role="alert">Oops, sorry upload marketing document failed, please try again</div>');
			redirect('reserve_stand');
        }
        else
        {
        	// insert into  comapny doc
            $var_data = array(
            	'c_id' => $c_id,
            	'e_id' => $event_id,
            	'cd_doc' => 'uploads/company_doc/'.$this->upload->data('file_name')
            );
            if($this->db->insert('company_doc',$var_data)) {
            	$var_data2 = array(
            		'erv_created' => date("Y-m-d H:i:s"),
            		'erv_modified' => date("Y-m-d H:i:s"),
            		'e_id' => $event_id,
            		'c_id' => $c_id,
            		'stand_id' => $stand_id,
            		'stand_price' => $stand_price
            	);
            	if(!$this->db->insert('events_resv', $var_data2)) {
 		        	$this->session->set_flashdata('reserve_stand_msg','<div class="alert alert-danger" role="alert">Oops, failed to book your stand. please try again</div>');
            	} else {
            		$this->session->set_flashdata('reserve_stand_msg','<div class="alert alert-success" role="alert">Congrulations, booking stand success</div>');
					
				}
            	redirect('reserve_stand');
            }
        }
    }
}
?>