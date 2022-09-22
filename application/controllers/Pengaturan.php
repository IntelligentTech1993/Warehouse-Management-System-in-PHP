<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengaturan extends CI_Controller {

    public function __construct()
    {
    	parent::__construct();
		$this->load->model('M_admin', 'ADM', TRUE);
		$this->load->model('M_config', 'CONF', TRUE);
    }

	public function index()
	{
		if ($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_user'] 	= $this->session->userdata('admin_user');
			$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
			$data['web']					= $this->ADM->identitaswebsite();
			$data['dashboard_info']		= TRUE;
			$data['breadcrumb']				= 'Dashboard';
			$data['dashboard'] 			= 'admin/dashboard/statistik';
			$data['boxmenu'] 			= 'admin/boxmenu/setting';
			$data['menu_terpilih']		= '1';
			$data['submenu_terpilih']	= '';
			$this->load->vars($data);
			$this->load->view('admin/home');
		} else {
			redirect("wp_login");
		}
	}

	//FUNCTION User
	public function pengguna($filter1='', $filter2='', $filter3='')
	{
		if ($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_user'] 	= $this->session->userdata('admin_user');
			$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
			$data['web']				= $this->ADM->identitaswebsite();
			@date_default_timezone_set('Asia/Jakarta');
			$data['dashboard_info']		= FALSE;
			$data['breadcrumb']				= 'User';
			$data['content'] 			= 'admin/content/pengaturan/pengguna';
			$data['menu_terpilih']		= '1';
			$data['submenu_terpilih']	= '13';
			$data['action']				= (empty($filter1))?'view':$filter1;			
			if ($data['action'] == 'view'){
				$data['berdasarkan']		= array('admin_user'=>'USERNAME',
													'admin_nama'=>'FULL NAME',
													'admin_telepon'=>'TELEPHONE',
													'admin_level_kode'=>'GROUP');
				$data['cari']				= ($this->input->post('cari'))?$this->input->post('cari'):'admin_nama';
				$data['q']					= ($this->input->post('q'))?$this->input->post('q'):'';
				$data['halaman']			= (empty($filter2))?1:$filter2;
				$data['batas']				= 10;
				$data['page']				= ($data['halaman']-1) * $data['batas'];
				$where_admin2['admin_status']	= 'A';
				$where_admin3['admin_status']	= 'A';
				$where_admin3['admin_user']	= $this->session->userdata('admin_user');
				$like_admin[$data['cari']]	= $data['q'];
				$data['jml_data_admin']		= $this->ADM->count_all_admin('');
				$data['jml_data']			= $this->ADM->count_all_admin($where_admin2, $like_admin);
				$data['jml_data2']			= $this->ADM->count_all_admin($where_admin3, $like_admin);
				$data['jml_halaman'] 		= ceil($data['jml_data']/$data['batas']);
			} elseif ($data['action'] == 'tambah'){
				if ($data['admin']->admin_level_kode == 1) {
				$data['validate']			= array('admin_user'=>'Username',
												'admin_pass'=>'Password',
												'admin_nama'=>'Full name',
												'admin_alamat'=>'Address',
												'admin_telepon'=>'Telephone',
												'admin_level_kode'=>'Group'
											);
				$data['onload']				= 'admin_user';
				$data['admin_user']			= ($this->input->post('admin_user'))?$this->input->post('admin_user'):'';
				$data['admin_pass']			= ($this->input->post('admin_pass'))?$this->input->post('admin_pass'):'';
				$data['admin_nama']			= ($this->input->post('admin_nama'))?$this->input->post('admin_nama'):'';
				$data['admin_alamat']		= ($this->input->post('admin_alamat'))?$this->input->post('admin_alamat'):'';				
				$data['admin_telepon']		= ($this->input->post('admin_telepon'))?$this->input->post('admin_telepon'):'';
				$data['admin_level_kode']	= ($this->input->post('admin_level_kode'))?$this->input->post('admin_level_kode'):'';
				
				$where['admin_user']		= $data['admin_user'];
				$jml_pengguna				= $this->ADM->count_all_admin($where);
								
				$simpan						= $this->input->post('simpan');
				if ($simpan && $jml_pengguna < 1 ){								
					$insert['admin_user']		= validasi_sql($data['admin_user']);
					$insert['admin_pass']		= validasi_sql(do_hash(($data['admin_pass']), 'md5'));
					$insert['admin_nama']		= validasi_sql($data['admin_nama']);
					$insert['admin_alamat']		= validasi_sql($data['admin_alamat']);
					$insert['admin_telepon']	= validasi_sql($data['admin_telepon']);
					$insert['admin_level_kode']	= validasi_sql($data['admin_level_kode']);			
					$insert['admin_status']		= validasi_sql('A');
					$this->ADM->insert_admin($insert);
					$this->session->set_flashdata('success','New user has been added successfully!,');
					redirect("pengaturan/pengguna");
				} elseif ($simpan && $jml_pengguna > 0 ){
					echo '<script type="text/javascript">
						  	alert("Pengguna telah terdaftar!,");
						  </script>';
				}
				} else {
					redirect("pengaturan/pengguna");
				}
			} elseif ($data['action'] == 'edit'){
				$data['validate']			= array('admin_user'=>'User',
												'admin_nama'=>'Full name',
												'admin_alamat'=>'Address',
												'admin_telepon'=>'Telephone',
												'admin_level_kode'=>'Group'
											);
				$data['onload']					= 'admin_nama';
				$where_admin['admin_user']		= $filter2; 
				$admin							= $this->ADM->get_admin('*', $where_admin);
				$data['admin_user']				= ($this->input->post('admin_user'))?$this->input->post('admin_user'):$admin->admin_user;
				$data['admin_pass']				= ($this->input->post('admin_pass'))?$this->input->post('admin_pass'):$admin->admin_pass;				
				$data['admin_nama']				= ($this->input->post('admin_nama'))?$this->input->post('admin_nama'):$admin->admin_nama;				
				$data['admin_alamat']			= ($this->input->post('admin_alamat'))?$this->input->post('admin_alamat'):$admin->admin_alamat;				
				$data['admin_telepon']			= ($this->input->post('admin_telepon'))?$this->input->post('admin_telepon'):$admin->admin_telepon;				
				$data['admin_level_kode']		= ($this->input->post('admin_level_kode'))?$this->input->post('admin_level_kode'):$admin->admin_level_kode;	
				$simpan							= $this->input->post('simpan');
				if ($simpan){
					$where_edit['admin_user']	= validasi_sql($data['admin_user']);
					if ($data['admin_pass'] <> '') {						
					$edit['admin_pass']			= validasi_sql(do_hash(($data['admin_pass']), 'md5')); }
					$edit['admin_nama']			= validasi_sql($data['admin_nama']);
					$edit['admin_alamat']		= validasi_sql($data['admin_alamat']);
					$edit['admin_telepon']		= validasi_sql($data['admin_telepon']);					
					$edit['admin_level_kode']	= validasi_sql($data['admin_level_kode']);
					$this->ADM->update_admin($where_edit, $edit);
					$this->session->set_flashdata('success','User has been edited successfully!,');
					redirect("pengaturan/pengguna");
				}
			} elseif ($data['action'] == 'reject'){
				if ($data['admin']->admin_level_kode == 1) {
				$where_edit['admin_user']= $filter2;
				$edit['admin_status']	= 'H';
				$this->ADM->update_admin($where_edit, $edit);
				$this->session->set_flashdata('success','The user has been successfully blocked!,');
					redirect("pengaturan/pengguna");
				} else {
					redirect("pengaturan/pengguna");
				}
			} elseif ($data['action'] == 'accept'){
				if ($data['admin']->admin_level_kode == 1) {
				$where_edit['admin_user']= $filter2;
				$edit['admin_status']	= 'A';
				$this->ADM->update_admin($where_edit, $edit);
				$this->session->set_flashdata('success','The user has been successfully activated!,');
					redirect("pengaturan/pengguna");
				} else {
					redirect("pengaturan/pengguna");
				}
			}
			$this->load->vars($data);
			$this->load->view('admin/home');
		} else {
			redirect("wp_login");
		}
	}
	
	//FUNCTION KELOMPOK PENGGUNA
	public function kelompok_pengguna($filter1='', $filter2='', $filter3='')
	{
		if ($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_user'] 	= $this->session->userdata('admin_user');
			$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
			if ($data['admin']->admin_level_kode == 1) {
			$data['web']					= $this->ADM->identitaswebsite();
			@date_default_timezone_set('Asia/Jakarta');
			$data['dashboard_info']		= FALSE;
			$data['content'] 			= 'admin/content/pengaturan/kelompok_pengguna';
			$data['menu_terpilih']		= '1';
			$data['submenu_terpilih']	= '13';
			$data['action']				= (empty($filter1))?'view':$filter1;
			$data['validate']			= array('admin_level_kode'=>'Code',
												'admin_level_nama'=>'Name'
											);
			if ($data['action'] == 'view'){
				$data['berdasarkan']		= array('admin_level_nama'=>'NAME');
				$data['cari']				= ($this->input->post('cari'))?$this->input->post('cari'):'admin_level_nama';
				$data['q']					= ($this->input->post('q'))?$this->input->post('q'):'';
				$data['halaman']			= (empty($filter2))?1:$filter2;
				$data['batas']				= 10;
				$data['page']				= ($data['halaman']-1) * $data['batas'];
				$where_admin_level['admin_level_status']	= 'A';
				$like_admin_level[$data['cari']]	= $data['q'];
				$data['jml_data']			= $this->ADM->count_all_admin_level($where_admin_level, $like_admin_level);
				$data['jml_halaman'] 		= ceil($data['jml_data']/$data['batas']);
			} elseif ($data['action'] == 'add'){
				$data['onload']				= 'admin_level_nama';
				$data['admin_level_kode']	= ($this->input->post('admin_level_kode'))?$this->input->post('admin_level_kode'):'';
				$data['admin_level_nama']	= ($this->input->post('admin_level_nama'))?$this->input->post('admin_level_nama'):'';
				$simpan						= $this->input->post('simpan');
				if ($simpan){
					$insert['admin_level_kode']			= validasi_sql($data['admin_level_kode']);
					$insert['admin_level_nama']			= validasi_sql($data['admin_level_nama']);
					$insert['admin_level_status']		= validasi_sql('A');
					$this->ADM->insert_admin_level($insert);
					$this->session->set_flashdata('success','A new user group has been successfully added!,');
					redirect("pengaturan/kelompok_pengguna");
				}
			} elseif ($data['action'] == 'edit'){
				$data['onload']				= 'admin_level_kode';
				$where_admin_level['admin_level_kode']	= $filter2; 
				$admin_level				= $this->ADM->get_admin_level('*', $where_admin_level);
				$data['admin_level_kode']	= ($this->input->post('admin_level_kode'))?$this->input->post('admin_level_kode'):$admin_level->admin_level_kode;				
				$data['admin_level_nama']	= ($this->input->post('admin_level_nama'))?$this->input->post('admin_level_nama'):$admin_level->admin_level_nama;				
				$simpan						= $this->input->post('simpan');
				if ($simpan){
					$where_edit['admin_level_kode']	= $data['admin_level_kode'];
					$edit['admin_level_nama']	= $data['admin_level_nama'];
					$this->ADM->update_admin_level($where_edit, $edit);
					$this->session->set_flashdata('success','The user group has been successfully edited!');
					redirect("pengaturan/kelompok_pengguna");
				}
			} elseif ($data['action'] == 'hapus'){
				$where_edit['admin_level_kode']= $filter2;
				$edit['admin_level_status']	= 'H';
				$this->ADM->update_admin_level($where_edit, $edit);
				$this->session->set_flashdata('success','The user group has been successfully deleted!');
				redirect("pengaturan/kelompok_pengguna");
			}
			$this->load->vars($data);
			$this->load->view('admin/home');
			} else {
				redirect("admin");	
			}
		} else {
			redirect("wp_login");
		}
	}

	 //Fungsi Change Password
	 public function edit_password($filter1='', $filter2='', $filter3='')
	 {
		 if ($this->session->userdata('logged_in') == TRUE) {
			 $where_admin['admin_user']			= $this->session->userdata('admin_user');
			 $data['web']					= $this->ADM->identitaswebsite();
			 $data['admin']						= $this->ADM->get_admin('',$where_admin);
			 @date_default_timezone_set('Asia/Jakarta');
			 $data['dashboard_info']			= FALSE;
			 $data['breadcrumb']				= 'Change Password';
			 $data['content']					= 'admin/content/pengaturan/edit_password';
			 $data['menu_terpilih']				= '1';
			 $data['submenu_terpilih']			= '';
			 $data['validasi']					= array('admin_pass_recent'=>'Current Password','admin_pass'=>'New Password','admin_pass_ulang'=>'New Password');
			 
			 $data['admin_user']				= $this->session->userdata('admin_user');
			 $data['admin_pass_recent']			= ($this->input->post('admin_pass_recent'))?$this->input->post('admin_pass_recent'):'';
			 $data['admin_pass']				= ($this->input->post('admin_pass'))?$this->input->post('admin_pass'):'';
			 $data['admin_pass_ulang']			= ($this->input->post('admin_pass_ulang'))?$this->input->post('admin_pass_ulang'):'';
			 	
			 $simpan							= $this->input->post('simpan');
			 if($simpan){
				 if(do_hash($data['admin_pass_recent'], 'md5') == $data['admin']->admin_pass) {
					if($data['admin_pass'] == $data['admin_pass_ulang']) {
						$where_edit['admin_user']	= validasi_sql($data['admin_user']);
						if($data['admin_pass'] <> '') {
							$edit['admin_pass']		= validasi_sql(do_hash(($data['admin_pass']), 'md5')); 
						}
						$this->ADM->update_admin($where_edit, $edit);
						echo '<script type="text/javascript"> alert("Password has been changed!");</script>';
						
					} else {
						echo'<script type="text/javascript"> alert("Password does not match!");</script>';
					}
					} else {
						echo'<script type="text/javascript"> alert("Password is now wrong!");</script>';
					}
				 }
				 $this->load->vars($data);
				 $this->load->view('admin/home');
			 } else {
				 redirect("wp_login");
			 }
		 }
}
