<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

class Auth_model extends Model
{

	public function login($email, $password)
	{				
    	$row = $this->db->table('user as user')
						->select('user.id as user_id, user.email, user.user_type, user.password')					
    					->where('email', $email)
    					->get();
		if($row)
		{
			if(password_verify($password, $row['password'])) {
				return $row;
			} else {
				return false;
			}
		}
	}

	public function is_user_verified($email) {
		$this->db->table('user as user')
				->select('user.status')
				->where('email', $email)
				->where('status', 1)
				->get();
		return $this->db->row_count();
	}
	
	public function passwordhash($password)
	{
		$options = array(
			'cost' => 4,
		);
		return password_hash($password, PASSWORD_BCRYPT, $options);
	}

	public function register($email, $password, $token, $user_type)
	{
		$data = array(
			'email' => $email,
			'password' => $this->passwordhash($password),
			'token' => $token,
			'user_type' => $user_type
		);
		return $this->db->table('user')->insert($data);
	}

	public function get_token($email)
	{
		$res = $this->db->table('user as user')
				->select('user.token')
				->where('email', $email)
				->get();

		if($res){
			return $res['token'];
		}else{
			return false;
		}
	}

	public function verified($token)
	{
		$data = array(
			'status' => 1
		);
		return $this->db->table('user')->where('token', $token)->update($data);
	}

	public function update_passwordtoken($email, $password_token)
	{
		$data = array(
			'password_token' => $password_token
		);
		return $this->db->table('user')->where('email', $email)->update($data);
	}

	public function change_password($password, $password_token)
	{
		$data = array(
			'password' => $this->passwordhash($password)
		);
		return $this->db->table('user')->where('password_token', $password_token)->update($data);
	}

}
