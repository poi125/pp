<?php
return array(
	//'配置项'=>'配置值'
	//
	'TMPL_PARSE_STRING'  =>array(
     '__PUBLIC__' => '/Public/Admin/', // 更改默认的/Public 替换规则
     '__JS__'     => '/Public/Admin/', // 增加新的JS类库路径替换规则
     '__UPLOAD__' => '/Uploads', // 增加新的上传路径替换规则
),
	// 模板布局配置
	
	'LAYOUT_ON'=>true,  // 打开布局
	'LAYOUT_NAME'=>'Layout/index', // 布局文件名称

	 //开启trace调控
	"SHOW_PAGE_TRACE"=>true
);