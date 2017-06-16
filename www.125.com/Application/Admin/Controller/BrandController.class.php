<?php
namespace Admin\Controller;



class BrandController extends CommonController{

	public function index(){

		$keywords = I('keywords');

		$map = [];

			if (!empty($keywords)) {
				$map['brand_name'] = ['like',"%{$keywords}%"]; 
			}


		$count = M('brand') -> where($map) -> count(); //查询满足要求的总记录数

		$Show_pages = 2;
		$Page = new \Think\Page($count,$Show_pages); //实例化分页类 传入总记录数和每页显示的记录数(2)

		$show = $Page ->show(); // 分页显示输出

		$list = M('brand') ->field('id,brand_name') -> where($map) ->page(I('p'),$Show_pages) ->select(); // 进行分页数据查询

		
		$this -> assign('list',$list);// 赋值数据集到视图

		$this -> assign('page',$show);// 赋值分页输出

		
		$this ->display();// 加载视图
	}
	
	public function add(){

		if (IS_POST) {
			
				$brand_name = I('brand_name');

				// 验证
				$validate =[
					['brand_name','require','品牌不能为空'],
					['brand_name','brand_name','已存在',1,'unique']
				];

				
				$res =M('brand') -> validate($validate) -> create();

				// create() 这个方法可以自动接收POST过来的数据
				// 并且自动过滤非数据表字段数据
				// 自动验证数据
				// 自动完成数据
				
					if ($res === false ) {
						return $this ->error(M('brand')-> getError());
					}
				
				$result = M('brand') ->add();

				 if (empty($result)) {
				 	 return $this -> error('添加失败');
				 }
					return $this ->  success('添加成功',U('index'));
		}
		


		// 加载视图
		$this ->display();
	}

	public function edit(){

		
		
		

		if (IS_POST) {
			
			$_POST['id'] = I('get.id');

			// 验证
			
			$validate =[
				['brand_name','require','品牌不能为空'],
				['brand_name','brand_name','已存在',1,'unique']
			];	

			$res = M('brand') -> validate($validate) -> create();

			if ($res === false) {
				return $this -> error(M('brand') -> getError());
			}

			$row = M('brand') ->where(['id' =>I('get.id')]) -> save();

				if ($row < 0) {
					return $this ->error('修改失败');

				}elseif($row = 0){
					return $this -> error('没有修改');
				}
					return $this -> success('修改成功',U('index'));
		 }

	

		$brand = M('brand') -> find(I('id'));// 查询
			if (empty($brand)) {
				return $this -> error('没有找到数据');
			}
		$this -> assign('brand',$brand);// 赋值数据集到视图

		$this -> display(add); // 加载视图
	}

	public function delete(){
		$id = I('get.id');

		if (empty($id)) {
			 return $this -> error('参数错误');
		}

		$isGoods = M('goods') ->field('id') ->where(['brand_id => $id']) -> find();
			if (empty($isGoods)) {
				return $this -> error('请把该品牌下的所有商品删除后在执行操作');
			}
		$res = M('brand') -> delete($id);

		
		if (empty($res)) {
			return $this -> error('删除失败');
		}
			return $this -> success('删除成功');

		
	}
}



