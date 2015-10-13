<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Top extends MY_Controller
{
//class Top extends CI_Controller {

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

	function __construct()
	{
		parent::__construct();

		// セッション書き込み
		if (!$this->session->userdata('ticket')) {
			$setData = array(
					'ticket' => md5(uniqid(mt_rand(), true)),
					'login_chk' => '',
					'login_mem' => '',
			);
			$this->session->set_userdata($setData);
		} else {
			// ログイン有無のチェック
			$this->smarty->assign('login_chk', $this->session->userdata('login_chk'));
			$this->smarty->assign('login_mem', $this->session->userdata('login_mem'));
		}
	}

	public function index()
	{

		$this->smarty->assign('login_chk', $this->session->userdata('login_chk'));
		$this->smarty->assign('login_mem', $this->session->userdata('login_mem'));
		$this->view('writer/top/index.tpl');

		//phpinfo();

	}

	// ログアウト チェック
	public function logout()
	{
		// セッションのチェック
		$this->ticket = $this->session->userdata('ticket');
		if (!$this->ticket) {
			$message = 'セッション・エラーが発生しました。';
			show_error($message, 400);
		} else {
			$this->smarty->assign('ticket', $this->ticket);
		}

		// SESSION クリア
		$this->load->model('comm_auth', 'auth', TRUE);
		$this->auth->logout();

		// TOPへリダイレクト
		$this->load->helper('url');
		redirect(base_url());
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */