<?php
namespace Common\Model;

class SpecModel extends \Think\Model\RelationModel{
	// 关联定义
	protected $_link = [
		'Spec_items' => [
		'mapping_type' => self::HAS_MANY,
		]
	];
	// 静态验证
	protected $_validate = [
		['spec_name','require','规格名称不能为空'],
		['spec_name','spec_name','规格名称不能重复',1,'unique'],
		['item','require','规格选项不能为空'],
		
	];

	public function spec_add($data=[])
	{
		// 收集数据
		$res = $this -> create();
		

		if ($res === false) 
		{
			return $this -> getError();
		}

		$item = I('item');
				// 字符串转数组
		$itemArray = explode("\r\n",$item);
		// 删除 数组重复值
		
		$itemArray = array_unique($itemArray);
		// 弄个空数组
		$temp = [];

		foreach ($itemArray as $key => $value) 
		{
			// 去除空格函数 trim 
			// 判断 $t 是否为空 并且不在tepm数组里面 不为空就
			// 组装二维数组
			 $t= trim($value);
			if (!empty($t) ) 
			{
				$temp[] = ['item' => $value];
			}		
		}
			// 判断temp
			if (empty($temp)) 
			{
				return '规格选项不能为空';
			}
			$res['Spec_items'] = $temp;

			$id= $this -> relation(true) -> add($res);

			
			if (empty($id)) 
			{
				return '添加失败';
			}
			return (int)$id;
	}
	public function spec_edit()
	{	
		// 收集数据
		$res = $this -> relation(true) -> create();

		if ($res === false) 
		{
			return $this -> getError();
		}

		$item = I('item');
		// 字符串转数组
		$itemArray = explode("\r\n",$item);
		// 删除 数组重复值
		$itemArray = array_unique($itemArray);
		

		$old = M('spec_items') -> where(['spec_id'=>$res['id']])-> getField('id,item');

		$del = array_diff($old,$itemArray);
		$add = array_diff($itemArray,$old);

		// 弄个空数组
		$new = [];

		foreach ($add as $key => $value) 
		{
			// 去除空格函数 trim 
			// 判断 $t 是否为空 并且不在tepm数组里面 不为空就
			// 组装二维数组
			 $t= trim($value);
			if (!empty($t) ) 
			{
				$new[] = ['item' => $value];
			}		
		}

		// 判断temp
		// if (empty($new)) 
		// {
		// 	return '规格选项不能为空';
		// }

		// 弄个空数组
		// $spec_array =[];
		// 查出数据库里的数据 
		
		// 遍历查出数据库里的数据 再弄成想要数组的样子
		// foreach ($old_items as $key => $value) {
		// 	$spec_array[] = ['item' => $value['item']];
		// }

		// 判断 查出数据库里的数据 和填进来的数据是否相同
		// if ($del == $add) {
		// 	return "没有修改";
		// }
		
		if (!empty($del)) {
		$del_row = M('spec_items')
		 			-> where(['spec_id'=>I('get.id'),'item'=>['in',$del]])
		 			-> delete();
		}
		
		
		$res['Spec_items'] = $new;
		// 修改
		$row = $this -> relation(true) -> save($res);
		

		if (empty($row) && empty($del_row) && empty($add)) 
		{
			return '修改失败'; 
		}
		return true;
	}
	public function spec_del()
	{
		// 事务
		// 开启事务
		$this -> startTrans();
		$row = M('Spec_items') -> where(['spec_id' => I('get.id')]) -> delete();
		if (empty($row)) {
			// 回滚
			$this -> rollback();
			return false;
		}
		$id = $this -> delete( I('get.id'));
		if (empty($id)) {
			// 回滚
			$this -> rollback();
			return false;
		}
		// 提交事务
		$this -> commit();
		return true;
	}
}