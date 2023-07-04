<?php defined('BASEPATH') OR exit('No direct script access');

class User_Model extends CI_Model
{
	private $_table = "user";
	public $id;
	public $username;
	public $password;
	public $level;

	public function rules()
	{
		return [
			['field' => 'username',
			'label' => 'Username',
			'rules' => 'required'],

			['field' => 'password',
			'label' => 'Password',
			'rules' => 'required'],

			['field' => 'level',
			'label' => 'Level',
			'rules' => 'required']
		];				
	}

	public function getAll()
	{
		return $this->db->get($this->_table)->result();
	}

	public function getById($id)
	{
		return $this->db->get_where($this->_table,["id_user" => $id])->row();
	}

	public function insert()
	{	
		$post = $this->input->post(); 
		$this->username = $post["username"];
		$this->password = md5($post["password"]);
		$this->level = $post["level"];
		$this->db->set('username',$this->username);
		$this->db->set('password',$this->password);
		$this->db->set('level',$this->level);
		$this->db->insert($this->_table);
	}

	public function update()
	{
		$post = $this->input->post();
		$this->username = $post["username"];
		$this->password = md5($post["password"]);
		$this->level = $post["level"];
		$this->db->set('password',$this->password);
		$this->db->set('level',$this->level);
		$this->db->where('id_user', $post["id"]);
		$this->db->update($this->_table);
	}

	public function delete($id)
	{
		return $this->db->delete($this->_table, array("id_user" => $id));
	}
}