<?php
namespace Admin\Controller;

class GoodsController extends CommonController{
	public function index()
	{

		$keywords = I('keywords');

		$map =[];

			if (!empty($keywords)) {
				$map['goods_name'] = ['like',"%{$keywords}%"];

			}
			// 查询满足要求的总记录数
			$count = M('0201_goods') -> where($map) -> count();

			// 实例化分页类 传入总记录数和每页显示的记录数(2)
			
			$Show_pages = 2;
			$Page = new \Think\Page($count,$Show_pages);
			// 分页显示
			$show =  $Page -> show();

			// 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用I('id')获取
			$list = M('0201_goods') -> where($map) -> page(I('p'),$Show_pages) -> select();

			// 赋值数据集到视图
			$this -> assign('list',$list);

			// 赋值分页输出	
			$this -> assign('page',$show);
		// 加载视图
		$this -> display();
	}
	public function add()
	{


		if (IS_POST) 
		{
			
			$validate = [
				['goods_name','require','品牌名称不能为空'],
				['goods_name','goods_name','品牌名称已经存在',1,'unique'],
				['image','require','图片不能为空'],
			];

			$res = M('0201_goods') -> validate($validate) -> create();

				if ($res === false) {
					return $this -> error(M('brand')->getError());
				}

			$row = M('0201_goods') -> add();

				if (empty($row)) {
					return $this ->error('添加失败');
				}
					return $this ->success('添加成功',U('index'));
		}

		$this ->display();
	}
	public function edit()
	{

		if (IS_POST) 
		{
			$_POST['id'] = I('get.id');

				// 验证
				$validate = [
					['goods_name','require','商品名称不能为空'],
					['goods_name','goods_name','商品名称',1,'unique'],
				];

				$res = M('0201_goods') ->validate($validate) ->create();
					if ($res === false) {
						return $this -> error(M('0201_goods') -> getError());
					}
				$row = M('0201_goods') -> where(['id' => I('get.id')]) -> save();
					if ($row < 0) 
					{
						return $this -> error('修改失败');
					}elseif ($row == 0) {
						return $this -> error('没有修改');
					}
					return $this -> success('修改成功',U('index'));
		}
		// 查询
		$goods = M('0201_goods') -> find(I('id'));
			if (empty($goods)) 
			{
				return $this -> error('没有找到数据');
			}

		// 赋值
		$this -> assign('goods',$goods);
		// 加载视图
		$this -> display(add);
	}
	public function delete()
	{
		$id = I('get.id');
			if (empty($id)) 
			{
				return $this -> error('参数错误');
			}
			$row = M('goods') -> delete('$id');
				if (empty($row)) 
				{
					return $this -> error('删除失败');
				}
				return $this -> success('删除成功',U('index'));
	}
	public function add_spec()
	{	
		$specname = M('Spec') -> select();
			foreach ($specname as $key => $value) {
				$specname [$key]['cc']= M('spec_items') ->where(['spec_id' => $value['id']]) ->select();
			}
		// print_r($specname);
		$this -> assign('specname',$specname);

		$this -> display();
	}
	public function handel_group()
	{
		// 通过规格选项ID到数据库查询选项内容
		$id = I('id');

		$items = M('spec_items') -> where(['id' => ['in',$id]]) -> select();

		$item_id = [];
		$spec_items =[];
			foreach ($items as $key =>$value) 
			{
				$item_id[$value['spec_id']][] = $value['id'];
				$spec_items[$value]['id'] = &$items[$key];
			}
		// 获取套餐选项
		$group = get_array_group($item_id);
		// 取出所有规格ID
		$spec_id = array_keys($item_id);

		$spec = M('Spec') -> where(['id'],['in',[$spec_id]]) -> select();
		$html = '<table>';
		// 组合标题
		$th = '';
		foreach ($spec as  $value) {
			$th.='<th>'.$value['spec_name'].'</th>';
		}
		$th.='<th>价格</th>';
		$html.=$th;
		$td ='';
		foreach ($group as $key => $value) {
			# code...
		}
		$html.='</table';

		echo $html;
	}
	public function upload()
	{

		
		// 实例化上传类
		$upload = new \Think\Upload;
		// 设置文件大小
		$upload ->maxSize =3145728;
		// 设置上传的类型
		$upload ->exts = ['jpg','gif','png','jpeg'];
		// 设置根目录
		$upload ->rootPath = './Public/Uploads/';
		if (!is_dir($upload ->rootPath)) {
			mkdir($upload ->rootPath);
		}
		// 上传文件
		$info = $upload->uploadOne($_FILES['pic']);
		if ($info === false) {
			die(json_encode(['error' =>1, 'msg' => $upload -> getError()]));
		}
		$path = $upload ->rootPath . $info['savepath'] .$info['savename'];

		die(json_encode(['code' => 0, 'path' => $path]));
	}
}