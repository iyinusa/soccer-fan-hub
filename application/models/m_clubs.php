<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_clubs extends CI_Model {
	 
		public function reg_insert($data) {
			$this->db->insert('sfh_club', $data);
			return $this->db->insert_id();
		}
		
		public function query_single_club($data) {
			$query = $this->db->get_where('sfh_club', array('slug' => $data));
			if($query->num_rows() > 0) {
				return $query->result();
			}
		}
		
		public function query_single_club_id($data) {
			$query = $this->db->get_where('sfh_club', array('id' => $data));
			if($query->num_rows() > 0) {
				return $query->result();
			}
		}
		
		public function query_club_fans($data) {
			$query = $this->db->get_where('sfh_users', array('club_id' => $data));
			if($query->num_rows() > 0) {
				return $query->result();
			}
		}
		
		public function query_all_club() {
			$query = $this->db->order_by('name', 'asc');
			$query = $this->db->get('sfh_club');
			if($query->num_rows() > 0) {
				return $query->result();
			}
		}
		
		public function query_club_fan($data) {
			$query = $this->db->order_by('display_name', 'asc');
			$query = $this->db->get_where('sfh_users', array('club_id' => $data, 'club_ban' => 0));
			if($query->num_rows() > 0) {
				return $query->result();
			}
		}
		
		public function query_club_league_id($data) {
			$query = $this->db->get_where('sfh_club', array('league_id' => $data));
			if($query->num_rows() > 0) {
				return $query->result();
			}
		}
		
		public function check_by_name($data) {
			$query = $this->db->get_where('sfh_club', array('name' => $data));
			return $query->num_rows();
		}
		
		public function update_club($id, $data) {
			$this->db->where('id', $id);
			$this->db->update('sfh_club', $data);
			return $this->db->affected_rows();	
		}
		
		public function delete_club($id) {
			$this->db->where('id', $id);
			$this->db->delete('sfh_club');
			return $this->db->affected_rows();
		}
	}