<html>
    <head>
        <title>CodeIgniterWeb2</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
        <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-expand-md navbar-light navbar-white"">
            <div class="container">
                    <a class="navbar-brand" href="<?php echo base_url();?>">CodeIgniterWeb2</a>
                <div id="navbarCollapse">
                    <ul class="navbar-nav">
                        
                        <li class="nav-item"><a href="<?php  echo base_url();?>">Home</a></li>
                        
                        <?php if(!$this->session->userdata('logged_in')): ?>
                            <li class="nav-item"><a href="<?php echo base_url();?>users/register">Register</a></li>
                            <li class="nav-item"><a href="<?php echo base_url();?>users/login">Log-in</a></li>
                        <?php endif; ?>
                        
                        <?php if($this->session->userdata('logged_in')): ?>
                            <li class="nav-item"><a href="<?php echo base_url();?>posts/create">Create Post</a></li>
                            <li class="nav-item"><a href="<?php echo base_url();?>users/logout">Logout</a></li>
                        <?php endif; ?>

                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">

            <?php if($this->session->flashdata('post_success')):?>
                <?= '<p class="alert alert-success">'.$this->session->flashdata('post_success').'</p>'?>
            <?php endif ?>

            <?php if($this->session->flashdata('post_error')):?>
                <?= '<p class="alert alert-success">'.$this->session->flashdata('post_error').'</p>'?>
            <?php endif ?>

            <?php if($this->session->flashdata('user_error')):?>
                <?= '<p class="alert alert-danger">'.$this->session->flashdata('user_error').'</p>'?>
            <?php endif ?>

            <?php if($this->session->flashdata('user_success')):?>
                <?= '<p class="alert alert-success">'.$this->session->flashdata('user_success').'</p>'?>
            <?php endif ?>

