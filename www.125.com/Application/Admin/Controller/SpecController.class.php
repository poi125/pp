<?php

namespace Admin\Controller;

class SpecController extends CommonController{
	public function index()
	{
		//把传过来的 赋值
		$keywords = I('keywords');
		// 弄个空数组
		$map = [];
		// 判断赋值的是否为空 不为空就组装
		if (!empty($keywords)) {
			$map['spec_name'] = ['like',"%{$keywords}%"];
		}
		// 查总数
		$count = M('Spec') -> where($map) -> count();
		// 赋值显示条数
		$pagesmub = 2;
		// 实例化
		$Page = new \Think\Page($count,$pagesmub);

		$show = $Page -> show();
		//分页查询
		$list = D('Spec') -> where($map) -> page(I('p'),$pagesmub) -> select();
		// 赋值查到的东西到视图
		$this -> assign('list',$list);
		// 赋值查到的东西 show函数 显示到视图
		$this -> assign('page',$show);
		// 加载视图
		$this -> display();
	}
	public function add()
	{
		// 判断有没东西传过来
		if (IS_POST) 
		{
			
			
			// 添加
			$row = D('Spec') -> spec_add();

			// 判断
			if (is_string($row)) 
			{
				return $this -> error($row);
			}
			return $this -> success('添加成功',U('index'));
			
		}
		// 赋值到视图
		$this -> assign('spec',$row);
		$this -> display();
	}
	public function edit()
	{
		if (IS_POST) 
		{
			$_POST['id'] = I('get.id');
			
			// 修改
			$row = D('Spec') -> spec_edit();
			// dump($row);
			// return;
			// 判断
			
			if ($row !== true)
			{
				return $this -> error($row);
			}
			return $this -> success('修改成功',U('index'));

		}
		// 查询出要修改的
		
		$spec = D('Spec') -> where(['id' => I('id')]) -> relation(true) -> find();

		//弄个空数组
		$temp =[];
		// 因为$SPEC 是个三维数组 要遍历
		foreach ($spec['Spec_items'] as $key => $value) 
		{
			$temp[] = $value['item']; 
		}
			$temp = implode("\r\n",$temp);
		
		// 赋值到视图
		$this -> assign('spec',$spec);
		// 赋值到视图
		$this -> assign('spec_items',$temp);
		// 加载视图
		$this -> display(add);
	}
	public function delete()
	{
		$row =  D('Spec') -> spec_del();

		if (! $row) {
			return $this -> error('删除失败');
		}
		return $this -> success('删除成功');
	}
	
}

