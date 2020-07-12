<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_risk extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //load model admin
        $this->load->model('risk/m_login_risk');
    }

    public function index()
    {

        if($this->m_login_risk->login_risk())
        {
            //jika memang session sudah terdaftar, maka redirect ke halaman dahsboard
            redirect("risk/dashboard_risk");
        }
        else
        {
            //jika session belum terdaftar
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            //set message form validation
            $this->form_validation->set_message('required', '<div class="alert alert-danger" style="margin-top: 3px">
                <div class="header"><b><i class="fa fa-exclamation-circle"></i> {field}</b> harus diisi</div></div>');

            //cek validasi
            if ($this->form_validation->run() == TRUE) 
            {
                //get data dari FORM
                $username  = strtolower($this->input->post("username", TRUE));
                $password  = sha1(md5($this->input->post('password', TRUE)));

                //checking data via model
                $checking = $this->m_login_risk->check_login($username, $password);

                //jika ditemukan, maka create session
                if ($checking != FALSE) 
                {
                    foreach ($checking as $apps) 
                    {
                        $session_data = array(
                            'id_user'           => $apps->id_user,
                            'nama_lengkap_risk' => $apps->nama_lengkap,
                            'username_risk'     => $apps->username,
                            'password'          => $apps->password,
                            'level_risk'        => $apps->level,
                            'nama_bagian_risk'  => $apps->nama_bagian,
                            'untuk_web_risk'    => $apps->untuk_web,
                            'status_risk'       => "login" 
                        );
                        //set session userdata
                        $this->session->set_userdata($session_data);
                        redirect('risk/dashboard_risk');
                    }
                }
                else
                {
                    $data['error'] = '<div class="row">
                                        <div class="col-sm-10 col-sm-offset-1">
                                            <div class="alert alert-danger alert-dismissable" role="alert">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                                <strong>Login Gagal!</strong> Username atau Password salah atau Hubungi admin KDR
                                            </div>
                                            <div class="space-6"></div>
                                        </div>
                                    </div>';
                    $this->load->view('risk/login/v_login_risk', $data);
                }
            }
            else
            {
                $this->load->view('risk/login/v_login_risk');
            }
        }
    }

    public function check()
    {
        $nama_lengkap   = $this->input->post("nama_lengkap");
        $username       = strtolower($this->input->post("username"));
        $password       = sha1(md5($this->input->post('password', TRUE)));
        $level          = null;
        $status         = 0;
        $nama_bagian    = $this->input->post("nama_bagian");
        $untuk_web      = $this->input->post("untuk_web");
        $check_username = $this->m_login_risk->check_username($username);

        //jika username belum ada
        if(!$check_username)
        {
            $simpan = $this->m_login_risk->simpan_user_baru($nama_lengkap,$username,$password,$level,$status,$nama_bagian,
                      $untuk_web);
            if($simpan)
            {
                echo '<script>';
                echo 'alert("User berhasil ditambahkan, silahkan konfirmasi ke admin KDR");';
                echo 'window.location.href ="' . base_url('risk/login_risk') . '"';
                echo '</script>';
            }
            else
            {
                echo '<script>';
                echo 'alert("User gagal ditambahkan!!!");';
                echo 'window.location.href ="' . base_url('risk/login_risk') . '"';
                echo '</script>';
            }
        }

        //jika username sudah ada
        else
        {
            echo '<script>';
            echo 'alert("Username sudah terdaftar!! Gunakan username yang lain");';
            echo 'window.location.href ="' . base_url('risk/login_risk') . '"';
            echo '</script>';
        }
    }
}