<?php
namespace Admin\Controller;

class CategoryController extends CommonController{

	public function index(){
		$keywords = I('keywords');

		$map =[];
			if (!empty($keywords)) {
				$map['cate_name'] = ['like',"%{$keywords}%"];
			}
		// //查询满足要求的总记录数	
		// $count = M('category') -> where($map) -> count();
		// //实例化分页类 传入总记录数和每页显示的记录数(2)
		// //
		// $Show_pages = 2;
		// $Page = new \Think\Page($count,$Show_pages);
		// // 分页显示输出
		// $show = $Page -> show();
		// 进行分页数据查询
		$list = M('category') -> where($map) ->order('id asc') -> select();

		
		// // 赋值到视图
		// $this -> assign('page',$show);
		// 赋值到视图
		$this -> assign('list',cate_tree($list));
		// 加载视图	
		$this -> display();	
	}
	public function add(){
		if (IS_POST) {
			// 验证
			$validate = [
				['cate_name','require','分类名称不能为空'],
			];
			$res = M('category') -> validate($validate) ->create();
				if ($res === false) {
					return $this -> error(M('category') -> getError());
				}
				$row =M('category') -> add();
					if (empty($row)) {
						return $this -> error('添加失败');
					}
					return $this -> success('添加成功',U('index'));
		}
		// 查出所有分类
		$cate = M('category') ->select();

		
		// 使用函数
		 $list = cate_tree($cate);

		// 赋值到视图
		$this -> assign('cate',$list
			);



		// 加载视图
		$this -> display();
	}
	public function edit(){
		if(IS_POST){
			$_POST['id'] = I('get.id');

			// 验证
			$validate =[
				['cate_name','require','分类名称不能为空'],
				['cate_name','cate_name','分类名称已存在',1,'unique'],
			];

			$res = M('category') -> validate($validate) -> create();
				if ($res === false) {
					return $this -> error(M('category') -> getError());
				}

			$row = M('category') -> save();
				if ($row < 0) {
					return $this -> error('修改失败');
				}elseif ($row == 0) {
					return $this -> error('没有修改');
				}
				return $this -> success('修改成功');
			
		}

		$data = M('category') -> field('cate_name,parent_id,id') -> where(['id' => I('get.id')]) ->find();

		dump($data);

		// 找出所有分类
		$cate = M('category') -> select();



		// 使用函数
		$tree = cate_tree($cate);
		// 剔除自己和子孙
		$level = 0;

		foreach ($tree as $key => $value) {
		 	
		 	// 找到自己
		 	if ($value['id'] == I('get.id') ) {
		 		$level = $value['level'];
		 		//删除自己
		 		unset($tree[$key]);
		 		// 跳过当前循环
		 		continue;
		 	}
		 	// 如果 level > 0 说明找到自己
		 	if($level  > 0) {
		 		// 如果下一项等级大于自己 说明是自己的子级
			 	if($value['level'] > $level){
			 		unset($tree[$key]);
			 	}elseif (condition) {
			 		// 退出循环
			 		break;
			 	}	
			}	
		}

		 // 赋值到视图
		$this -> assign('info',$data);

		 // 赋值到视图
		$this -> assign('cate',$tree);
		// 加载视图
		
		$this -> display(add);
	}
	public function delete(){
		$id = I('get.id');
			if (empty($id)) {
				return $this -> error('参数错误');
			}
			// 删除分类之前 先查出有没有子分类
			$child =M('category') -> where(['parent_id' =>$id]) -> find();
				if (!empty($child)) {
					return $this -> error('删除分类之前先删除了子分类先');
				}
			// 删除分类之前 先查出该分类下有没有商品
			$goods_id = M('0201_goods') -> where(['cagegory_id' => $id]) -> getField('id');
				if (!empty($goods_id)) {
					return $this -> error('删除分类之前先删除了该分类下商品先');
				}
			$row = M('category') -> delete($id);
				if (empty($row)) {
					return $this -> error('删除失败');
				}
				return $this -> success('删除成功');
	}
}