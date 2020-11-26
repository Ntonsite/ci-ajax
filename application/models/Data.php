<?php


class Data extends CI_Model
{

	public function insert_entry($data)
	{
		return $this->db->insert('user', $data);
	}
}
