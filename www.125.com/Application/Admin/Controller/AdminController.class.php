<?php

namespace Admin\Controller;

class AdminController extends CommonController{
	public function index(){
		$keywords = I('keywords');

		$map =[];

			if (!empty($keywords) ) {
				$map['user_name'] = ['like',"%{$keywords}%"];
			}
		// 查询满足要求的总记录数
		$count = M('admin') -> where($map) -> count(); 

		$Show_pages = 2;
		// 实例化分页类 传入总记录数和每页显示的记录数(2)
		$Page = new \Think\Page($count,$Show_pages);


		// 分页显示输出
		$show = $Page -> show();


		// 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 I('id')获取
		$list = M('admin') -> where($map) -> page(I('p'),$Show_pages) -> select();

		// 赋值数据集到视图
		$this ->assign('list',$list);

		// 赋值分页输出
		$this ->assign('page',$show);

		$this ->display();
	}
	public function add(){

		if (IS_POST) {
			// $user_name = I('user_name');
			// $password = I('password');
			// $password2 = I('password2');

			// dump($user_name);
			// dump($password);
			// dump($password2);
			// exit;

				// 验证
			$validate = [
				['user_name','require','用户名不能为空'],
				['user_name','3,10','用户名长度3-10',1,'length'],
				['user_name','user_name','用户名已存在',1,'unique'],
				['password','require','密码不能为空'],
				['password','3,10', '密码长度3-10',1,'length'],
				['password','password2','密码不一致',1,'confirm'],
			];

				// 自动完成
			
			// $auto =[
			// 	['password','md5',3,'function'],
			// ];


			$res = M('admin')  -> validate($validate) -> create();

			if ($res === false) {
				return $this -> error(M('admin') -> getError());
			}
			$res['password'] =  md5($res['password']);

			$row  = M('admin') -> add($res);

				if (empty($row)) {
					return $this -> error('添加失败');
				}
						return $this -> success('添加成功',U('index'));

		}	

		$this -> display();
	}
	public function edit(){
		if (IS_POST) {
			$_POST['id'] = I('get.id');

				// 验证
				
				$validate = [
		
					['password','require','密码不能为空'],
					['password','3,10','密码长度3-10',1,'length'],
					['password','password2','密码不一致',1,'confirm'],
				];

				$res = M('admin') -> validate($validate) -> create();

					if ($res === false) {
					 return	$this -> error(M('admin') -> getError());
					}

				$res['password'] = md5($res['password']);

				$row = M('admin') -> where(['id' => I('get.id')])-> save($res);

				if ($row < 0) {
					return $this -> error('修改失败');
				}	elseif($row == 0){
					return $this -> error('没有修改');
				}

					return $this -> success('修改成功',U('index'));

			
		}	
		$user = M('admin') -> find(I('id'));
				if (empty($user)) {
					return $this -> error('没有找到数据');
				}
				// 赋值数据集到视图
				$this -> assign('user',$user);

		// 加载视图
		$this -> display(add);
	}
	public function delete(){
		$id = I('get.id');

		if (empty($id)) {
			return $this -> error('参数错误');
		}

		$row = M('admin') ->delete($id);
		if (empty($row)) {
			return $this -> error('删除失败');
		}
		return $this -> success('删除成功' ,U('index'));
	}
}