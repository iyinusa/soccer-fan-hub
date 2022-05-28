<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_facts extends CI_Model {
	 
		public function reg_insert($data) {
			$this->db->insert('sfh_club_fact', $data);
			return $this->db->insert_id();
		}
		
		public function query_fact_id($data) {
			$query = $this->db->get_where('sfh_club_fact', array('id' => $data));
			if($query->num_rows() > 0) {
				return $query->result();
			}
		}
		
		public function query_fact_club_id($data) {
			$query = $this->db->where('club_id', $data);
			$query = $this->db->order_by('fact_year', 'asc');
			$query = $this->db->get('sfh_club_fact');
			if($query->num_rows() > 0) {
				return $query->result();
			}
		}
		
		public function query_all_fact() {
			$query = $this->db->order_by('id', 'desc');
			$query = $this->db->get('sfh_club_fact');
			if($query->num_rows() > 0) {
				return $query->result();
			}
		}
		
		public function check_by_name($club_id,$fact_date,$fact_details) {
			$query = $this->db->get_where('sfh_club_fact', array('club_id' => $data, 'fact_date' => $fact_date, 'fact_details' => $fact_details));
			return $query->num_rows();
		}
		
		public function update_fact($id, $data) {
			$this->db->where('id', $id);
			$this->db->update('sfh_club_fact', $data);
			return $this->db->affected_rows();	
		}
		
		public function delete_fact($id) {
			$this->db->where('id', $id);
			$this->db->delete('sfh_club_fact');
			return $this->db->affected_rows();
		}
	}