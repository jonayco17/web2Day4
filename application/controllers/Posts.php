<?php
	class Posts extends CI_Controller{
		public function index($page = 'home'){
			$title = array('title' => 'Latest Posts');
            $data['posts'] = $this->post_model->get_posts();

			$this->load->view('templates/header', $title);
			$this->load->view('posts/index', $data);
			$this->load->view('templates/footer');
		}

		public function view($slug = NULL){
			$data['post'] = $this->post_model->get_posts($slug);

			if(empty($data['post'])){
				show_404();
			}

			$title = array('title' => 'View Post');
			$this->load->view('templates/header', $title);
			$this->load->view('posts/view', $data);
			$this->load->view('templates/footer');
		}

		public function create(){
			if(!$this->session->userdata('logged_in')){
				redirect('users/login');
			}

			$title = array('title' => 'Create Post');
            
			$this->form_validation->set_rules('title', 'Title', 'required|callback_check_slug_exists');
			$this->form_validation->set_rules('body', 'Body', 'required');

			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header', $title);
				$this->load->view('posts/create');
				$this->load->view('templates/footer');
			}else{
				$this->post_model->create_post();

				$this->session->set_flashdata('post_success', 'Posted Successfully');

				redirect('/');
			}
		}

		public function delete($id){
			if(!$this->session->userdata('logged_in')){
				redirect('users/login');
			}

			$this->post_model->delete_post($id);

			$this->session->set_flashdata('post_success', 'Post Deleted Successfully');

			redirect('/');
		}

		public function edit($slug){
			if(!$this->session->userdata('logged_in')){
				redirect('users/login');
			}

			$data['post'] = $this->post_model->get_posts($slug);

			if($this->session->userdata('user_id') != $data['post']['user_id']){
				redirect('/');
			}

			if(empty($data['post'])){
				show_404();
			}

			$this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('body', 'Body', 'required');

			$title = array('title' => 'Edit Post');
			$this->load->view('templates/header', $title);
			$this->load->view('posts/edit', $data);
			$this->load->view('templates/footer');
		}

		public function update(){
			if(!$this->session->userdata('logged_in')){
				redirect('users/login');
			}

			$this->post_model->update_post();

			$this->session->set_flashdata('post_success', 'Post Updated Successfully');

			redirect('/');
		}

		public function check_slug_exists($title){
			$this->form_validation->set_message('check_slug_exists', 'The Title already exists.');
			$slug = url_title($title);

            if($this->post_model->check_slug_exists($slug)){
                return true;
            }else{
                return false;
            }
        }
	}