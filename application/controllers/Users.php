<?php
    class Users extends CI_Controller{
        public function register(){
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

                $this->session->set_flashdata('user_registered', 'Registered Successfully');

                redirect('posts');
            }
        }


        public function login(){
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

                $user_id =  $this->user_model->login($username, $password);

                if($user_id){
                    $user_data = array(
                        'user_id' => $user_id,
                        'username' => $username,
                        'logged_in' => true,
                    );

                    $this->session->set_userdata($user_data);

                    $this->session->set_flashdata('user_loggedin', 'Login Successful');

                    redirect('posts');
                }else{
                    $this->session->set_flashdata('login_failed', 'Login Failed');

                    redirect('users/login');
                }
            }
        }

        public function logout(){
            $this->session->unset_userdata('logged_in');
            $this->session->unset_userdata('user_id');
            $this->session->unset_userdata('username');

            $this->session->set_flashdata('user_loggedout', 'User Logged Out');
        
            redirect('users/login');
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