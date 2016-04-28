<?php
class UserModel extends Model{
	public function register(){
		// Sanitize POST
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

		$password = md5($post['pass']);

		if($post['submit']){
			if($post['uname'] == '' || $post['email'] == '' || $post['pass'] == ''){
				Messages::setMsg('Please Fill In All Fields', 'error');
				return;
			}

			// Insert into MySQL
			$this->query('INSERT INTO users (user_name, user_email, user_pass) VALUES(:uname, :email, :pass)');
			$this->bind(':user_name', $post['uname']);
			$this->bind(':user_email', $post['email']);
			$this->bind(':user_pass', $password);
			$this->execute();
			// Verify
			if($this->lastInsertId()){
				// Redirect
				header('Location: '.ROOT_URL.'users/UyeGirisi.php');
			}
		}
		return;
	}

	public function login(){
		// Sanitize POST
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

		$password = md5($post['pass']);

		if($post['submit']){
			// Compare Login
			$this->query('SELECT * FROM users WHERE user_email = :email AND user_pass = :pass');
			$this->bind(':user_email', $post['email']);
			$this->bind(':user_pass', $password);
			
			$row = $this->single();

			if($row){
				$_SESSION['is_logged_in'] = true;
				$_SESSION['user_data'] = array(
					"id"	=> $row['user_id'],
					"name"	=> $row['user_name'],
					"email"	=> $row['user_email']
				);
				header('Location: '.ROOT_URL.'products');
			} else {
				Messages::setMsg('Incorrect Login', 'error');
			}
		}
		return;
	}
}