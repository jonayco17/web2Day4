<?php
    class Admin extends CI_Controller{
        public function index(){
            if($this->check_admin_permission()){
                $data['title'] = 'Manage Users';

                //Get Users
                $data['users'] = $this->user_model->get_users();

                $this->load->view('templates/header');
                $this->load->view('admin/index', $data);
                $this->load->view('templates/footer');
            }else{
                redirect('/');
            }
            
        }

        public function create(){
            if($this->check_admin_permission()){
                $data['title'] = 'Create User';
        
                $this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_exists');
                $this->form_validation->set_rules('password', 'Password', 'required');
                $this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password]');
                $this->form_validation->set_rules('name', 'Full Name', 'required');
                $this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists');
                $this->form_validation->set_rules('address', 'Home Address', 'required');
    
                if($this->form_validation->run() === FALSE){
                    $this->load->view('templates/header');
                    $this->load->view('admin/create', $data);
                    $this->load->view('templates/footer');
                }else{
                    // Encrypt password
                    $enc_password = md5($this->input->post('password'));
    
                    $this->user_model->register($enc_password);
    
                    $this->session->set_flashdata('user_success', 'User Created Successfully');
    
                    redirect('admin');
                }
            }else{
                redirect('/');
            }
        }

        public function toggleStatus($id){
			if($this->check_admin_permission()){

			$this->user_model->toggle_user_status($id);

			$this->session->set_flashdata('user_success', 'User Status Updated Successfully');

			redirect('admin');

            }else{
                redirect('/');
            }
		}

        public function delete($id){
			if($this->check_admin_permission()){

                $this->user_model->delete_user($id);

                $this->session->set_flashdata('user_success', 'User Deleted Successfully');

                redirect('admin');
            }else{
                redirect('/');
            }
		}

		public function edit($id){
			if($this->check_admin_permission()){
                $data['user'] = $this->user_model->get_users($id);

                if(empty($data['user'])){
                    show_404();
                }

                $data['title'] = 'Edit User';
                $this->load->view('templates/header');
                $this->load->view('admin/edit', $data);
                $this->load->view('templates/footer');
            }else{
                redirect('/');
            }
		}

		public function update(){
			if($this->check_admin_permission()){

                //Check if Password is Changed
                $password = $this->input->post('password');
                if(!$this->compare_password($password)){
                    $password = md5($password);
                }

                $this->user_model->update_user($password);

                $this->session->set_flashdata('user_success', 'User Updated Successfully');

                redirect('admin');
            }else{
                redirect('/');
            }
		}

        //Helper

        private function compare_password($password){
            $id = $this->session->userdata('user_id');
            return $this->user_model->compare_user_password($id, $password);
        }

        private function check_admin_permission(){
            if($this->session->userdata('logged_in') && $this->session->userdata('user_type') == 'admin'){
                return true;
            }else{
                return false;
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