<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_Wagers extends CI_Model {
	 
		public function reg_insert($data) {
			$this->db->insert('sfh_wager', $data);
			return $this->db->insert_id();
		}
		
		public function reg_insert_wagerer($data) {
			$this->db->insert('sfh_wagerer', $data);
			return $this->db->insert_id();
		}
		
		public function query_wager_id($data) {
			$query = $this->db->get_where('sfh_wager', array('id' => $data));
			if($query->num_rows() > 0) {
				return $query->result();
			}
		}
		
		public function query_all_wager() {
			$query = $this->db->order_by('id', 'desc');
			$query = $this->db->get('sfh_wager');
			if($query->num_rows() > 0) {
				return $query->result();
			}
		}
		
		public function query_all_wagerer($data) {
			$query = $this->db->where('wager_id', $data);
			$query = $this->db->order_by('id', 'asc');
			$query = $this->db->get('sfh_wagerer');
			if($query->num_rows() > 0) {
				return $query->result();
			}
		}
		
		public function check_user_wagerer($id, $user_id) {
			$query = $this->db->get_where('sfh_wagerer', array('wager_id' => $id, 'user_id' => $user_id));
			if($query->num_rows() > 0) {
				return $query->result();
			}
		}
		
		public function check_wager($type,$content,$amt,$start) {
			$query = $this->db->get_where('sfh_wager', array('type' => $type, 'content' => $content, 'amt' => $amt, 'starts' => $start));
			return $query->num_rows();
		}
		
		public function check_wagerer($wager,$user) {
			$query = $this->db->get_where('sfh_wagerer', array('wager_id' => $wager, 'user_id' => $user));
			return $query->num_rows();
		}
		
		public function update_wager($id, $data) {
			$this->db->where('id', $id);
			$this->db->update('sfh_wager', $data);
			return $this->db->affected_rows();	
		}
		
		public function update_wagerer($id, $data) {
			$this->db->where('id', $id);
			$this->db->update('sfh_wagerer', $data);
			return $this->db->affected_rows();	
		}
		
		public function delete_wager($id) {
			$this->db->where('id', $id);
			$this->db->delete('sfh_wager');
			return $this->db->affected_rows();
		}
		
		public function delete_wagerer($id) {
			$this->db->where('id', $id);
			$this->db->delete('sfh_wagerer');
			return $this->db->affected_rows();
		}
	}