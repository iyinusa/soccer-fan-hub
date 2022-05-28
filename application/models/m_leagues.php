<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_leagues extends CI_Model {
	 
		public function reg_insert($data) {
			$this->db->insert('sfh_league', $data);
			return $this->db->insert_id();
		}
		
		public function query_single_league($data) {
			$query = $this->db->get_where('sfh_league', array('slug' => $data));
			if($query->num_rows() > 0) {
				return $query->result();
			}
		}
		
		public function query_league_id($data) {
			$query = $this->db->get_where('sfh_league', array('id' => $data));
			if($query->num_rows() > 0) {
				return $query->result();
			}
		}
		
		public function query_all_league() {
			$query = $this->db->order_by('name', 'asc');
			$query = $this->db->get('sfh_league');
			if($query->num_rows() > 0) {
				return $query->result();
			}
		}
		
		public function check_by_name($data) {
			$query = $this->db->get_where('sfh_league', array('name' => $data));
			return $query->num_rows();
		}
		
		public function update_league($id, $data) {
			$this->db->where('id', $id);
			$this->db->update('sfh_league', $data);
			return $this->db->affected_rows();	
		}
		
		public function delete_league($id) {
			$this->db->where('id', $id);
			$this->db->delete('sfh_league');
			return $this->db->affected_rows();
		}
	}