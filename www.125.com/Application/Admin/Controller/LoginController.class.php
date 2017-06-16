<?php

namespace Admin\Controller;

use Think\Controller;
class LoginController extends  Controller{

	public function index(){

		// md5
		// sha1

		if (IS_POST) {
			
			$user_name  = I('user_name');
			$password  = I('password');
			$code  = I('code');

			
			if (empty($user_name)) {
				return $this -> error('请填用户名');
			}
			if (empty($password)) {
				return $this -> error('请填密码');
			}

			// 验证码对比
			// 
			if (empty($code)) {
				return $this -> error('请填验证码');
			}

			$verify = new \Think\Verify;

			if (!$verify -> check($code)) {
				return $this -> error('验证码错误');
			}

			// 查询用户
			
			$user = M('admin') ->where(['user_name'=>$user_name]) ->find();

				if (empty($user)) {
					return $this -> error('用户不存在');
				}
				
				// 对比密码
				if (md5($password) !== $user['password']) {
					return $this -> error('密码错误');
				}

				unset($user['password']);
				// 保存登录状态
				// 
				session('admin',$user);

				// 跳转
				// 
				return $this -> success('好了',U('Index/index'));
		}


		$this -> display();
	}

	public function verify(){


		$verify = new \Think\Verify();

		$verify ->imageW = 100;

		$verify ->imageH = 45;

		$verify ->length = 1;

		$verify -> entry();
	}

	public function logout(){

		session ('admin',null);

		return $this -> success('已退出',U('index'));
	}
} 




?>