<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*------------------------------------------------
| Front Home Controller - Virtual Expo v1.0
| By Amydin Syahira
| 17 Oct 2016
--------------------------------------------------
*/

/**
 * @author amydinsyahira
 */
class Home extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('FrontModel');
    }
    
    public function index() {
    	$data = array();
    	$template_data = array(
    		'navigation' => $this->load->view('navigation',$data,true),
    		'content_page' => $this->load->view('page_home',$data,true),
    		'footer' => ''
    	);
        $this->load->view('template',$template_data);
    }

    public function template_event_list()
    {
    	$this->load->view('template_event_list');
    }

    public function template_book_event()
    {
    	$this->load->view('template_book_event');
    }

    public function get_event()
    {
    	$arr_result = array();
    	$var_data = array();

    	$startdate = $this->input->get('startdate');
    	$enddate = $this->input->get('enddate');
    	//$startdate = '2016-10-01';
    	//$enddate = '2016-10-30';
    	$eventcategory = $this->input->get('eventcategory');
    	//$eventcategory = 1;

    	$get_event = $this->FrontModel->getevent($startdate,$enddate,$eventcategory);
    	foreach ($get_event->result() as $e) {
    		$event_list = array();
    		$var_data2 = array();
    		$e_id = explode("~", $e->ev_id);
    		$e_name = explode("~", $e->ev_name);
    		$e_startdate = explode("~", $e->ev_startdate);
    		$e_enddate = explode("~", $e->ev_enddate);
    		$e_location = explode("~", $e->ev_location);
    		for ($i=0; $i < count($e_id); $i++) { 
    			$ev_startdate = explode(" ", $e_startdate[$i]);
    			$ev_enddate = explode(" ", $e_enddate[$i]);
    			$var_data2['event_id'] = $e_id[$i];
    			$var_data2['event_name'] = $e_name[$i];
    			$var_data2['event_startdate'] = $ev_startdate[0];
    			$var_data2['event_starttime'] = $ev_startdate[1];
    			$var_data2['event_enddate'] = $ev_enddate[0];
    			$var_data2['event_endtime'] = $ev_enddate[1];
    			$var_data2['event_location'] = $e_location[$i];
    			array_push($event_list, $var_data2);
    		}
    		$var_data['event_list'] = $event_list;
    		$var_data['event_map'] = $e->ev_map;	
    		array_push($arr_result, $var_data);
    	}
    	echo json_encode($arr_result);
    }
    public function get_eventcategory()
    {
    	$arr_result = array();
    	$var_data = array();

    	$get_eventcategory = $this->FrontModel->geteventcategory();
    	foreach ($get_eventcategory->result() as $e) {
    		$var_data['event_category_id'] = $e->em_id;
    		$var_data['event_category_value'] = $e->em_value;	
    		array_push($arr_result, $var_data);
    	}
    	echo json_encode($arr_result);
    }
    public function get_eventstands()
    {
    	$arr_result = array();
    	$var_data = array();
    	$event_id = $this->input->get('events_id');
        //$event_id = 1;
    	$get_eventstands = $this->FrontModel->geteventstands($event_id);
    	foreach ($get_eventstands->result() as $es) {
            $arr_stand = array();
            $var_data2 = array();
            $ex_stand = explode("~", $es->stand_resv);
            $ex_c_logo = explode("~", $es->company_logo);
            $ex_c_doc = explode("~", $es->company_doc);
            for($i = 0; $i < count($ex_stand); $i++) {
                $var_data2['stand_resv'] = $ex_stand[$i];
                $var_data2['company_logo'] = $ex_c_logo[$i];
                $var_data2['company_doc'] = $ex_c_doc[$i];
                array_push($arr_stand, $var_data2);
            }
    		$var_data['event_stands_id'] = $es->es_id;
    		$var_data['event_stands'] = $es->es_stands;
            $var_data['event_resv']	= $arr_stand;
    		array_push($arr_result, $var_data);
    	}
    	echo json_encode($arr_result);
    }
    public function get_stands_detail()
    {
    	$arr_result = array();
    	$var_data = array();
    	$event_id = $this->input->get('event_id');
    	$stands_id = $this->input->get('stands_id');
    	$get_eventstands = $this->FrontModel->geteventstandsdetail($event_id,$stands_id);
    	foreach ($get_eventstands->result() as $es) {
    		$ev_startdate = explode(" ", $es->e_startdatetime);
    		$ev_enddate = explode(" ", $es->e_enddatetime);

    		$var_data['event_id'] = $es->e_id;
    		$var_data['event_name'] = $es->e_name;
    		$var_data['event_startdate'] = $ev_startdate[0];
    		$var_data['event_starttime'] = $ev_startdate[1];
    		$var_data['event_enddate'] = $ev_enddate[0];
    		$var_data['event_endtime'] = $ev_enddate[1];
    		$var_data['event_location'] = $es->e_location;
    		$var_data['event_description'] = $es->e_description;
    		if(!empty($es->stand_price)) {
    			$var_data['event_price'] = $es->stand_price;
    		} else {
    			$var_data['event_price'] = $es->es_priceinfo;
    		}
    		$var_data['event_standimage'] = $es->stand_image;
    		array_push($arr_result, $var_data);
    	}
    	echo json_encode($arr_result);
    }

    public function login()
    {
        $data = array();
        $template_data = array(
            'navigation' => $this->load->view('navigation',$data,true),
            'content_page' => $this->load->view('page_login',$data,true),
            'footer' => ''
        );
        $this->load->view('template',$template_data);
    }

    public function doLogin() 
    {
    	$source_form = $this->input->post('source_form');
    	$email = $this->input->post('email');
    	$password = $this->input->post('password');
    	$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if ($this->form_validation->run() == TRUE)
		{
			$doLogin = $this->FrontModel->doLogin($email, $password,$source_form);
		}
    }
    public function doLogout() 
    {
        $array_items = array('c_id', 'c_name');
        $this->session->unset_userdata($array_items);
        redirect("home");
    }
    public function doRegister() 
    {
    	$source_form = $this->input->post('source_form');
    	$name = $this->input->post('company_name');
    	$telp = $this->input->post('telp');
    	$email = $this->input->post('email');
    	$password = $this->input->post('password');
    	$address = $this->input->post('address');

    	$doRegister = $this->FrontModel->doRegister($name,$telp,$email, $password,$address,$source_form);
		if($doRegister != 'false') {
			$config['upload_path'] = './uploads/company_logo/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = 10000;
            $config['max_width'] = 1024;
            $config['max_height'] = 768;
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('logo'))
            {
            	
				$doLogin = $this->FrontModel->doLogin($email, $password,$source_form);	
            }
            else
            {
                //insert logo
                $data = array(
                    'company.c_logo' => 'uploads/company_logo/'.$this->upload->data('file_name')
                );

                $this->db->where('company.c_id', $doRegister);
                $this->db->update('company', $data);

            	$doLogin = $this->FrontModel->doLogin($email, $password,$source_form);
            }
		} else {
			$this->session->set_flashdata('signup_err','<div class="alert alert-danger" role="alert">Oops, something error. Please try again</div>');
			if($source_form == 'reserve_stand') {
				redirect('reserve_stand');
			}
		}
    }
}
?>