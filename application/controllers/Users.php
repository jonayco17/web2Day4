<?php
    class Users extends CI_Controller{
        public function register(){
            if($this->session->userdata('logged_in')){
				redirect('/');
			}

            $data['title'] = 'Create An Account';
        
            $this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_exists');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password]');
            $this->form_validation->set_rules('name', 'Full Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists');
            $this->form_validation->set_rules('address', 'Home Address', 'required');

            if($this->form_validation->run() === FALSE){
                $this->load->view('templates/header');
                $this->load->view('users/register', $data);
                $this->load->view('templates/footer');
            }else{
                // Encrypt password
                $enc_password = md5($this->input->post('password'));

                $this->user_model->register($enc_password);

                $this->session->set_flashdata('user_success', 'Registered Successfully');

                redirect('/');
            }
        }


        public function login(){
            if($this->session->userdata('logged_in')){
				redirect('home');
			}

            $data['title'] = 'Log-in';
        
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if($this->form_validation->run() === FALSE){
                $this->load->view('templates/header');
                $this->load->view('users/login', $data);
                $this->load->view('templates/footer');
            }else{
                
                $username = $this->input->post('username');
                $password = md5($this->input->post('password'));

                $user_data =  $this->user_model->login($username, $password);

                if($user_data['status'] === 'approved'){
                    $login_data = array(
                        'user_id' => $user_data['id'],
                        'username' => $username,
                        'user_type' => $user_data['type'],
                        'logged_in' => true,
                    );

                    $this->session->set_userdata($login_data);

                    $this->session->set_flashdata('user_success', 'Login Successful');

                    redirect('/');
                }elseif($user_data['status'] === 'pending'){
                    $this->session->set_flashdata('user_error', 'User Needs Admin Approval');

                    redirect('/');
                }
                else{
                    $this->session->set_flashdata('user_error', 'Login Failed');

                    redirect('users/login');
                }
            }
        }

        public function logout(){
            if($this->session->userdata('logged_in')){
                $this->session->unset_userdata('logged_in');
                $this->session->unset_userdata('user_id');
                $this->session->unset_userdata('username');

                $this->session->set_flashdata('user_success', 'User Logged Out');
            
                redirect('users/login');
			}else{
                redirect('/');
            }
            
        }


        public function check_username_exists($username){
            $this->form_validation->set_message('check_username_exists', 'The Username is taken.');


            if($this->user_model->check_username_exists($username)){
                return true;
            }else{
                return false;
            }
        }

        public function check_email_exists($email){
            $this->form_validation->set_message('check_email_exists', 'The Email is taken.');


            if($this->user_model->check_email_exists($email)){
                return true;
            }else{
                return false;
            }
        }
    }