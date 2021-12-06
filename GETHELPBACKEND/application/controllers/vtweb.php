<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Vtweb extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */


	public function __construct()
	{
		parent::__construct();
		$params = array('server_key' => 'SB-Mid-server-x6tl1BHbdj2pj72x6BitsVyf', 'production' => false);
		$this->load->library('veritrans');
		$this->veritrans->config($params);
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->model('campaign_model');
		$this->load->model('users_model');
		$this->load->model('donasi_model');
	}

	public function index($slug)
	{
		$data['user'] = $this->users_model->getuserlogin($this->session->userdata('user_data'));
		$data['detail'] = $this->campaign_model->detailcampaign($slug);
		$data['biodata'] = $this->users_model->getuserbiodata($data['detail']['id']);
		// var_dump($data['user']);
		// die;
		$data['title'] = 'Donasi' . $data['detail']['nama_campaign'];
		$data['css'] = 'donate';
		$data['js'] = 'donate';

		$this->form_validation->set_rules('nominal', 'Nominal', 'required|min_length[6]', [
			'required' => '*Nominal minimal Rp 10.000',
			'min_length' => '*Nominal minimal Rp 10.000'
		]);
		$this->form_validation->set_rules('nama-lengkap', 'Nama-lengkap', 'required|trim', [
			'required' => '*Nama wajib harus ada'
		]);
		$this->form_validation->set_rules('nomor', 'Nomor', 'required|numeric|min_length[12]', [
			'required' => '*Wajib di isi!',
			'numeric' => '*Isi nomor telepon dengan angka saja',
			'min_length' => '*Panjang nomor terlalu pendek',
		]);
		$this->form_validation->set_rules('alamat-email', 'Alamat-email', 'required|trim', [
			'required' => '*Email wajib harus ada'
		]);
		$this->form_validation->set_rules('persetujuan', 'Persetujuan', 'required|trim', [
			'required' => '*Wajib di setujui'
		]);
		if ($this->form_validation->run() == true) {

			$nama = $this->input->post('nama-lengkap');
			$email = $this->input->post('alamat-email');
			$nominal = (int) preg_replace("/[^0-9]/", "", $this->input->post('nominal'));
			$nomor = $this->input->post('nomor');
			$doa = $this->input->post('doa');

			$transaction_details = array(
				'order_id' 			=> uniqid(),
				'gross_amount' 	=>  $nominal
			);

			$custom_field1 = $data['detail']['campaign_id']; // id campaign yang didonasikan user
			$custom_field2 = $nama; // nama orang yang berdonasi
			$custom_field3 = $doa; // doa user
			// Populate items
			$items = [
				array(
					'id' 				=> 'donasi',
					'price' 		=> $nominal,
					'quantity' 	=> 1,
					'name' 			=> $data['detail']['nama_campaign']
				)

			];

			// Populate customer's billing address
			$billing_address = array(
				'first_name' 		=> $nama,
				'country_code'	=> 'IDN'
			);

			// // Populate customer's shipping address
			// $shipping_address = array(
			// 	'first_name' 	=> "John",
			// 	'last_name' 	=> "Watson",
			// 	'address' 		=> "Bakerstreet 221B.",
			// 	'city' 				=> "Jakarta",
			// 	'postal_code' => "51162",
			// 	'phone' 			=> "081322311801",
			// 	'country_code' => 'IDN'
			// );

			// Populate customer's Info
			$customer_details = array(
				'first_name' 			=> $nama,
				'email' 					=> $email,
				'phone' 					=> $nomor,
				'billing_address' => $billing_address,
			);

			// Data yang akan dikirim untuk request redirect_url.
			// Uncomment 'credit_card_3d_secure' => true jika transaksi ingin diproses dengan 3DSecure.
			$transaction_data = array(
				'payment_type' 			=> 'vtweb',
				'vtweb' 						=> array(
					//'enabled_payments' 	=> ['credit_card'],
					'credit_card_3d_secure' => true
				),
				'transaction_details' => $transaction_details,
				'item_details' 			 => $items,
				'customer_details' 	 => $customer_details,
				'custom_field1' => $custom_field1,
				'custom_field2' => $custom_field2,
				'custom_field3' => $custom_field3
			);

			try {
				$vtweb_url = $this->veritrans->vtweb_charge($transaction_data);
				header('Location: ' . $vtweb_url);
			} catch (Exception $e) {
				$this->session->set_flashdata('message', 'Sepertinya ada kesalahan, coba refresh kembali halaman ini...');
				redirect(base_url('donate/') . $slug);
			}
		} else {
			$this->load->view('templates/home_header', $data);
			$this->load->view('templates/home_topbar', $data);
			$this->load->view('midtrans/donate', $data);
			$this->load->view('templates/home_footer', $data);
		}
	}


	public function notification()
	{
		$json_result = file_get_contents('php://input');
		$result = json_decode($json_result, true);

		// if ($result) {
		// 	$notif = $this->veritrans->status($result['order_id']);
		// }

		// // error_log(print_r($result, TRUE));

		//notification handler sample

		$transaction = $result['transaction_status'];
		$order_id = $result['order_id'];
		$status_code =  $result['status_code'];

		if ($transaction == 'settlement') {
			// TODO set payment status in merchant's database to 'Settlement'
			$data = [
				'status_code' => $status_code
			];
			$this->db->where('order_id', $order_id);
			$this->db->update('transaksi_midtrans', $data);
			// echo "Transaction order_id: " . $order_id . " successfully transfered using " . $type;
		} else if ($transaction == 'pending') {
			// TODO set payment status in merchant's database to 'Pending'
			$data = [
				'order_id' => $result['order_id'],
				'campaign_id' => $result['custom_field1'],
				'nama' => $result['custom_field2'],
				'gross_amount' => $result['gross_amount'],
				'payment_type' => $result['payment_type'],
				'transaction_time' => $result['transaction_time'],
				'va_number' => $result['va_numbers'][0]['va_number'],
				'status_code' => $status_code,
				'doa' => $result['custom_field3']
			];
			$this->db->insert('transaksi_midtrans', $data);
			// echo "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type;
		} else if ($transaction == 'expire') {
			// TODO set payment status in merchant's database to 'Pending'
			$this->db->where('order_id', $order_id);
			$this->db->delete('transaksi_midtrans');
			// echo "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type;
		}
	}


	public function finish()
	{
		$data['user'] = $this->users_model->getuserlogin($this->session->userdata('user_data'));
		$data['title'] = 'Terima Kasih Telah Berdonasi';
		$data['css'] = 'donate';


		$this->load->view('templates/home_header', $data);
		$this->load->view('templates/home_topbar', $data);
		$this->load->view('midtrans/finish', $data);
	}
}
