<?php
/**
 * @Author: ayipzz
 * @Date:   2016-10-19 16:39:16
 * @Last Modified by:   ayipzz
 * @Last Modified time: 2016-10-22 15:04:42
 */
Class FrontModel extends CI_Model
{
	function __constuct()
	{
		parent::__constuct(); 
		loader::database();
	}

	function doLogin($email,$password,$source_form)
	{
		$var_data['c_email'] = $email;
		$var_data['c_password'] = smart_encrypt($password);
		$query = $this->db->get_where('company', $var_data);
		if($query->num_rows() > 0) {
			$q = $query->row();
			$sess_data['c_id'] = $q->c_id;
			$sess_data['c_name'] = $q->c_name;
			
			$this->session->set_userdata($sess_data);
			if($source_form == 'reserve_stand') {
				redirect('reserve_stand');
			} else if($source_form == 'login') {
				redirect('home');
			}
		} else {
			$this->session->set_flashdata('login_err','<div class="alert alert-danger" role="alert">Please try again, we can\'t find your account</div>');
			if($source_form == 'reserve_stand') {
				redirect('reserve_stand');
			} else if($source_form == 'login') {
				redirect('login');
			}
		}
	}
	function doRegister($name,$telp,$email, $password,$address,$source_form) {
		$var_data = array(
			'c_email' => $email,
			'c_password' => smart_encrypt($password),
			'c_name' => $name,
			'c_address' => $address,
			'c_telp' => $telp
		);
		if($this->db->insert('company',$var_data)) {
			// get last company id
			$this->db->order_by('c_id', 'DESC');
			$q = $this->db->get('company')->row();
			return $q->c_id;
		} else {
			return 'false';
		}
	}
	function getevent($start_date = '', $end_date = '', $eventcategory = '')
	{
		$this->db->select('
			GROUP_CONCAT(events.e_id SEPARATOR "~") AS ev_id,
			GROUP_CONCAT(events.e_name SEPARATOR "~") AS ev_name, 
			GROUP_CONCAT(events.e_startdatetime SEPARATOR "~") AS ev_startdate,
			GROUP_CONCAT(events.e_enddatetime SEPARATOR "~") AS ev_enddate,
			GROUP_CONCAT(events.e_location SEPARATOR "~") AS ev_location,
			events.e_map as ev_map, 
			events_master.em_value
		');
		$this->db->from('events');
		$this->db->join('events_relationship', 'events_relationship.e_id = events.e_id');
		$this->db->join('events_master', 'events_master.em_id = events_relationship.em_id');

		if($start_date != '') {
			$where = "((events.e_startdatetime BETWEEN '".$start_date." 00:00:00' AND '".$end_date." 23:59:59') OR (events.e_enddatetime BETWEEN '".$start_date." 00:00:00' AND '".$end_date." 23:59:59'))";
			$this->db->where($where);
		}
		if($eventcategory != '') {
			$this->db->where('events_master.em_id = '.$eventcategory);
		}
		$this->db->group_by("events.e_map");
		$query = $this->db->get();

		return $query;
	}

	function geteventcategory()
	{
		$this->db->select('events_master.*');
		$this->db->from('events_master');
		$query = $this->db->get();

		return $query;
	}

	function geteventstands($eventid)
	{
		$query = $this->db->query('
			SELECT 
			    events_stands.*,
					(SELECT GROUP_CONCAT(events_resv.stand_id SEPARATOR "~") FROM events_resv WHERE events_resv.e_id = events.e_id) AS stand_resv,
					(SELECT GROUP_CONCAT(company.c_logo SEPARATOR "~") FROM company LEFT JOIN events_resv ON events_resv.c_id = company.c_id WHERE events_resv.e_id = events.e_id) AS company_logo,
					(SELECT GROUP_CONCAT(DISTINCT(company_doc.cd_doc) SEPARATOR "~") FROM company_doc LEFT JOIN company ON company.c_id = company_doc.c_id LEFT JOIN events_resv ON events_resv.c_id = company.c_id WHERE events_resv.e_id = events.e_id) AS company_doc
			FROM
			    events_stands
			        LEFT JOIN
			    events ON events.e_id = events_stands.e_id
			WHERE
			    events_stands.e_id = '.$eventid.'
			GROUP BY events.e_id
			');
		return $query;
	}

	function geteventstandsdetail($eventid,$standsid)
	{
		$query = $this->db->query("
			SELECT 
			    events.*,
			    events_stands.es_priceinfo,
			    (SELECT 
			            events_standsdetail.esd_price
			        FROM
			            events_standsdetail
			        WHERE
			            events_standsdetail.es_id = events_stands.es_id AND events_standsdetail.stand_id = '".$standsid."') AS stand_price,
				(SELECT 
			            events_standsdetail.esd_image
			        FROM
			            events_standsdetail
			        WHERE
			            events_standsdetail.es_id = events_stands.es_id AND events_standsdetail.stand_id = '".$standsid."') AS stand_image
			FROM
			    events
			        LEFT JOIN
			    events_stands ON events_stands.e_id = events.e_id
			WHERE
			    events.e_id = ".$eventid."
		");
		return $query;
	}

}
?>
