<?php
namespace Admin\Controller;

class GoodsTypeController extends CommonController{
	public function index(){
		$keywords = I('keywords');
			$map =[];
			if ($keywords) {
				$map['type_name'] = ['like',"%{$keywords}%"];
			}
		$count = M('goods_type') -> where($map) -> count();

		$Show_pages = 2;

		$Page = new \Think\Page($count,$Show_pages);

		$show = $Page -> show();

		$list = M('goods_type') -> where($map) -> page(I('P'),$Show_pages) -> select();

		$this -> assign('list',$list);
		$this -> assign('page',$show);
		$this -> display();
	}
	public function add(){
		if (IS_POST) {
			
			$validate = [
				['type_name','require','类型名称不能为空'],
				['type_name','type_name','类型名称已存在',1,'unique']
			];

			$res = M('goods_type') -> validate($validate) -> create();
				if ($res === false) {
					return $this -> error(M('goods_type') -> getError());
				}
			$row = M('goods_type') -> add();
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
				['type_name','require','类型名称不能为空'],
				['type_name','type_name','类型名称已存在',1,'unique'],
			];

			$res = M('goods_type') -> validate($validate) -> create();
				if ($res === false) {
					return $this -> error(M('goods_type') -> getError());
				}
			$row = M('goods_type') -> where(['id' => I('get.id')]) -> save();
				if ($row < 0) {
					return $this -> error('修改失败');
				}elseif ($row == 0) {
					return $this -> error('没有修改数据');
				}
				return $this -> success('修改成功',U('index'));
		}
		$goods_type = M('goods_type') -> find(I('get.id'));
	
		// 赋值到视图
		$this -> assign('goods_type',$goods_type);
		// 加载视图
		$this -> display(add);
	}
	public function delete(){
		$id = I('get.id');
			if (empty($id)) {
				return $this -> error('参数错误');
			}
		$row = M('goods_type') -> delete($id);
			if (empty($row)) {
				return $this -> error('删除失败');
			}
			return $this -> success('删除成功');
	}
}