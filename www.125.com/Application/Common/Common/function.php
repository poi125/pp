<?php
function get_array_group($arr)
{
	$group = [];
	foreach ($arr as  $value) {
		if (empty($group)) {
			// 只有一项的时候 遍历出里面的值并且以数组的形式输出
			foreach ($value as $val) {
				$group[] = [$val]; //拿到数组中第一个值
			}
			
		}else
		{
			$tmp =[];
			foreach ($group as $g ) 
			{
				foreach ($value as $v) 
				{
					if (! is_array($g)) 
					{
						$tmp[]= [$g,$v];//拿到另外一些数组中第一个值
						
					}else
					{
						$g[]=$v;
						$tmp[]= $g;
						array_pop($g);//删除数组中最后个元素
					}
				}
			}
			$group = $tmp;
		}
	}
	return $group;
}
// 无极分类

 function cate_tree($cateArr,$parent_id=0,$level= 1)
{		$data = [];
	// 先取出 parent_id =0的
	foreach ($cateArr as $key => $value) {
		if ($value['parent_id'] == $parent_id) {
			$value['level'] = $level;
			$data[] = $value;

			unset($cateArr[$key]);
			// 找出自己的下一级
			$tmp = cate_tree($cateArr,$value['id'],$level+1);
			if (!empty($tmp)) {
				$data = array_merge($data,$tmp);
			}
		}	
	}		
		return $data;	
}


 
