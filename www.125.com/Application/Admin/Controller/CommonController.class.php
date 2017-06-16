<?php

namespace Admin\Controller;

use Think\Controller;
class CommonController extends Controller{

	public function _initialize(){

			// 检查登录
			$this -> checkLogin();
		
	}
			// 检查登录
	protected function checkLogin(){

		if (! session('?admin')) {
			return $this -> error('请登录',U('Login/index'));
		}
	}
}