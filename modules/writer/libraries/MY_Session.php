<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Session extends CI_Session {

	public function __construct()
	{
		$CI = get_instance();

		// CLIからはセッションクラスを読み込まない
		if ($CI->input->is_cli_request()) {
			return;
		}

		parent::__construct();
	}
}