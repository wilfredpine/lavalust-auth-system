<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Auth extends Controller {

	public function __construct()
    {
        parent::__construct();
		$this->call->library(array('email', 'passwordchecker'));
    }


	public function login() 
	{
        if (is_logged_in())
            redirect('dashboard');

        if ($this->form_validation->submitted()) {

            $this->form_validation
                    ->name('email')->required()
                                ->max_length(100)
								->valid_email()
                    ->name('password')->required();

            if ($this->form_validation->run()) 
            {
                $email = $this->io->post('email');
                $password = $this->io->post('password');

                $this->call->model('Auth_model', 'auth_model');

                $data = $this->auth_model->login($email, $password);
                if (empty($data)) 
                {
                    set_flash_alert('danger', 'Invalid email or password.');
                } 
                else 
                {

					if (!$this->auth_model->is_user_verified($email))
					{
						set_flash_alert('danger', 'Account not yet verified. Check your email.');
						redirect('verify');

					}else{
					
                        // set sessions when logged in using session library
                        $this->session->set_userdata(
                            array(
                                'logged_in' => 1,
                                'user_id' => $data['user_id'],
                                'email' => $data['email'],
                                'user_type' => $data['user_type']
                            )
                        );
                        set_flash_alert('success', 'Welcome '.$this->session->userdata('email'));
                        
                        redirect('dashboard');

                    }
                }

            } 
            else 
            {
                set_flash_alert('danger', $this->form_validation->get_errors());
            }
        }

		$this->call->view('auth/signin_view');
	}

    public function logout()
    {

        // clear sessions when logged out using session library
        $this->session->unset_userdata(
            array(
                'logged_in',
                'user_id',
                'email',
                'user_type'
            )
        );
        $this->session->sess_destroy();
        redirect();
    }

    public function recover() 
	{
        if (is_logged_in())
			redirect('dashbaord');

        if ($this->form_validation->submitted()) {

            $email = filter_io('email', $this->io->post('email'));
            $this->form_validation
                ->name('email')
                ->required('Email is required.')
                ->valid_email();

            if ($this->form_validation->run()) {
                $password_token = random_string('alnum', 45);

                $this->call->model('Auth_model','auth_model');
                if($this->auth_model->update_passwordtoken($email, $password_token))
                {
                    $this->send_password_token_to_email($email, $password_token);
                    set_flash_alert('success', 'Please check your email.');
                }else{
                    set_flash_alert('danger', 'Your email is not register.');
                }

            } else {
                set_flash_alert('danger', $this->form_validation->errors());
            }
        }

        $this->call->view('auth/recover_view');
    }

	public function register() 
	{
		if (is_logged_in())
            redirect('dashboard');

        if ($this->form_validation->submitted()) {

            $password_err = array();

			$email = filter_io('email', $this->io->post('email'));
            $this->form_validation
				->name('user_type')->required('Choose your desired account type.')
                ->name('email')
                ->required('Email is required.')
                ->valid_email()
                ->max_length(100)
                ->min_length(8)
                ->is_unique('user', 'email', $email, 'Email was already taken.')
                ->name('password')
                ->required('Password must not be empty.')
                ->min_length(8, 'Password must be atleast 8 charaters in length.')
                ->name('confirm_password')
                ->required('Confirm your password.')
                ->matches('password', 'Password do not match!');

            if ($this->form_validation->run()) {
                $password = $this->io->post('password');
                $user_type = filter_io('string', $this->io->post('user_type'));
                $token = random_string('alnum', 45);

                if(strlen($this->io->post('password')) < 8) {
                    array_push($password_err, 'At least eight characters is required in your password.');
                }
                if($this->passwordchecker->count_numbers($this->io->post('password')) < 1) {
                    array_push($password_err, 'At least one number is required in your password.');
                }
                if($this->passwordchecker->count_symbols($this->io->post('password')) < 1) {
                    array_push($password_err, 'At least one symbol is required in your password.');                       
                }
                if(! $this->passwordchecker->detect_any_uppercase($this->io->post('password'))) {
                    array_push($password_err, 'At least one uppercase letter is required in your password.');                       
                }
                if(! $this->passwordchecker->detect_any_lowercase($this->io->post('password'))) {
                    array_push($password_err, 'At least one lowercase letter is required in your password.');                       
                }
                if(count($password_err) > 0) {
                    set_flash_alert('danger', implode('<br>', $password_err)); 
                    redirect('register');
                }

                $this->call->model('Auth_model','auth_model');

                if ($this->auth_model->register($email, $password, $token, $user_type)) {

                    $this->send_verification_email($email, $token);

                    set_flash_alert('success', 'You were successfully registered! Please check your email for verification.');

                    redirect('verify');
                }

            } else {
                set_flash_alert('danger', $this->form_validation->errors());
            }
        }

		$this->call->view('auth/signup_view');
	}

    public function verify() 
	{
        if (is_logged_in())
            redirect('dashboard');

        if ($this->form_validation->submitted()) {

            $email = filter_io('email', $this->io->post('email'));
            $this->form_validation
                ->name('email')
                ->required('Email is required.')
                ->valid_email();

            if ($this->form_validation->run()) {

                $this->call->model('Auth_model','auth_model');
                $token = $this->auth_model->get_token($email);

                if($token){
                
                    $this->send_verification_email($email, $token);

                    set_flash_alert('success', 'Please check your email for verification.');
                }else{
                    set_flash_alert('danger', 'email not registered.');
                }

            } else {
                set_flash_alert('danger', $this->form_validation->errors());
            }
        }

        $this->call->view('auth/resend_view');
    }

    public function verify_token($code)
    {
        if(!empty($code)){
            $this->call->model('Auth_model','auth_model');
            $this->auth_model->verified($code);
            set_flash_alert('success', 'Congratz!');
            redirect('login');
        }else{
            set_flash_alert('danger', 'Something went wrong.');
            redirect('verify');
        }
        
    }


	
    public function reset_password($password_token)
    {
        //change password view
        // update password where password_token = $password_token
        if (is_logged_in())
			redirect('dashboard');

		if ($this->form_validation->submitted()) {

			$password_err = array();
			$this->form_validation
				->name('password')
				->required('Password must not be empty.')
				->min_length(8, 'Password must be atleast 8 charaters in length.')
				->name('confirm_password')
				->required('Confirm your password.')
				->matches('password', 'Password do not match!');

			if ($this->form_validation->run()) {
				$password = $this->io->post('password');

				if(strlen($this->io->post('password')) < 8) {
					array_push($password_err, 'At least eight characters is required in your password.');
				}
				if($this->passwordchecker->count_numbers($this->io->post('password')) < 1) {
					array_push($password_err, 'At least one number is required in your password.');
				}
				if($this->passwordchecker->count_symbols($this->io->post('password')) < 1) {
					array_push($password_err, 'At least one symbol is required in your password.');                       
				}
				if(! $this->passwordchecker->detect_any_uppercase($this->io->post('password'))) {
					array_push($password_err, 'At least one uppercase letter is required in your password.');                       
				}
				if(! $this->passwordchecker->detect_any_lowercase($this->io->post('password'))) {
					array_push($password_err, 'At least one lowercase letter is required in your password.');                       
				}
				if(count($password_err) > 0) {
					set_flash_alert('danger', implode('<br>', $password_err)); 
					redirect('reset/'.$password_token);
				}

				$this->call->model('Auth_model','auth_model');

				if ($this->auth_model->change_password($password, $password_token)) {
					set_flash_alert('success', 'Please login.'); 
					redirect('login');
				}

			} else {
				set_flash_alert('danger', $this->form_validation->errors());
			}
			
		}

		$this->call->view('auth/reset_view');

    }

	
    /**
     * Send Email
     */
    private function send_verification_email($email, $token) {
		$template = file_get_contents(ROOT_DIR.PUBLIC_DIR.'/templates/registration_email.html');
		$search = array('{code}', '{app_name}', '{base_url}');
		$replace = array($token, 'LavaLust Auth System', BASE_URL);
		$template = str_replace($search, $replace, $template);
		$this->email->recipient($email);
		$this->email->subject('LavaLust Auth System Email Verification');
		$this->email->sender('confiredmail11@gmail.com', 'LavaLust Auth System');
        $this->email->isHTML(true);
		$this->email->email_content($template);
		$this->email->send();
	}

    public function send_password_token_to_email($email, $password_token) {
		$template = file_get_contents(ROOT_DIR.PUBLIC_DIR.'/templates/reset_password_email.html');
		$search = array('{token}', '{app_name}', '{base_url}');
		$replace = array($password_token, 'LavaLust Auth System', BASE_URL);
        $template = str_replace($search, $replace, $template);
		$this->email->recipient($email);
		$this->email->subject('LavaLust Auth System Reset Password');
		$this->email->sender('confiredmail11@gmail.com', 'LavaLust Auth System');
        $this->email->isHTML(true);
		$this->email->email_content($template);
		$this->email->send();
	}
    /**
     * END Send Email
     */



}
?>