<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta name="renderer" content="webkit">
<title></title>
<link rel="stylesheet" href="/Public/Admin/css/pintuer.css">
<link rel="stylesheet" href="/Public/Admin/css/admin.css">
<script src="/Public/Admin/jquery/2.1.1/jquery.min.js"></script>
<script src="/Public/Admin/js/jquery.js"></script>
<script src="/Public/Admin/js/pintuer.js"></script>
</head>
<body>
 <link href="/Public/Admin/css/bootstrap.min.css" rel="stylesheet">
   <script src="/Public/Admin/jquery.js"></script>
   <script src="/Public/Admin/js/bootstrap.min.js"></script>
   


<ul id="myTab" class="nav nav-tabs">
   <?php if(is_array($specname)): foreach($specname as $k=>$v): ?><li class="<?php if($k == 0): ?>active<?php endif; ?>"><a href="#home<?php echo ($k); ?>" data-toggle="tab">

      <?php echo ($v["spec_name"]); ?></a>
   </li><?php endforeach; endif; ?>
   
</ul>


<div id="myTabContent" class="tab-content">
   <?php if(is_array($specname)): foreach($specname as $kk=>$vv): ?><div class="tab-pane fade in <?php if($kk == 0): ?>active<?php endif; ?>" id="home<?php echo ($kk); ?>">
      <?php if(is_array($vv["cc"])): foreach($vv["cc"] as $key=>$value): ?><button class="btn btn-small" type="button" item-id="<?php echo ($value["id"]); ?>"  ><?php echo ($value["item"]); ?></button><?php endforeach; endif; ?>
   </div><?php endforeach; endif; ?>
      <div style="padding: 100px 0 0 0;">
         <button class="bb" type="button" >添加规格</button>
         <button type="button">取消</button>
      </div>
</div>
<script type="text/javascript">
$('.btn').click(function(){
   
  
   if ($(this).hasClass('btn-success')) {
      $(this).removeClass('btn-success');
   }else{
      $(this).addClass('btn-success');
   }

})

$('.bb').click(function(){
   var item_id = [];
  $('.btn-success').each(function(){
      
      item_id.push($(this).attr('item-id'));
  });
  
  if (item_id.length ==0) {
      layer.msg('请选择规格',{icon:5});
      return;
  }
  $.ajax({
      type:'POST',
      data:{id:item_id},
      url:'<?php echo U("Goods/handel_group");?>',
      dataType:'josn',
      success : function (data) {
         console.log(data);
      }
  })
})


</script>
 <script type="text/javascript">

//搜索
function changesearch(){	
		
}

//单个删除
function del(id,mid,iscid){
	if(confirm("您确定要删除吗?")){
		
	}
}

//全选
$("#checkall").click(function(){ 
  $("input[name='id[]']").each(function(){
	  if (this.checked) {
		  this.checked = false;
	  }
	  else {
		  this.checked = true;
	  }
  });
})

//批量删除
function DelSelect(){
	var Checkbox=false;
	 $("input[name='id[]']").each(function(){
	  if (this.checked==true) {		
		Checkbox=true;	
	  }
	});
	if (Checkbox){
		var t=confirm("您确认要删除选中的内容吗？");
		if (t==false) return false;		
		$("#listform").submit();		
	}
	else{
		alert("请选择您要删除的内容!");
		return false;
	}
}

//批量排序
function sorts(){
	var Checkbox=false;
	 $("input[name='id[]']").each(function(){
	  if (this.checked==true) {		
		Checkbox=true;	
	  }
	});
	if (Checkbox){	
		
		$("#listform").submit();		
	}
	else{
		alert("请选择要操作的内容!");
		return false;
	}
}


//批量首页显示
function changeishome(o){
	var Checkbox=false;
	 $("input[name='id[]']").each(function(){
	  if (this.checked==true) {		
		Checkbox=true;	
	  }
	});
	if (Checkbox){
		
		$("#listform").submit();	
	}
	else{
		alert("请选择要操作的内容!");		
	
		return false;
	}
}

//批量推荐
function changeisvouch(o){
	var Checkbox=false;
	 $("input[name='id[]']").each(function(){
	  if (this.checked==true) {		
		Checkbox=true;	
	  }
	});
	if (Checkbox){
		
		
		$("#listform").submit();	
	}
	else{
		alert("请选择要操作的内容!");	
		
		return false;
	}
}

//批量置顶
function changeistop(o){
	var Checkbox=false;
	 $("input[name='id[]']").each(function(){
	  if (this.checked==true) {		
		Checkbox=true;	
	  }
	});
	if (Checkbox){		
		
		$("#listform").submit();	
	}
	else{
		alert("请选择要操作的内容!");		
	
		return false;
	}
}


//批量移动
function changecate(o){
	var Checkbox=false;
	 $("input[name='id[]']").each(function(){
	  if (this.checked==true) {		
		Checkbox=true;	
	  }
	});
	if (Checkbox){		
		
		$("#listform").submit();		
	}
	else{
		alert("请选择要操作的内容!");
		
		return false;
	}
}

//批量复制
function changecopy(o){
	var Checkbox=false;
	 $("input[name='id[]']").each(function(){
	  if (this.checked==true) {		
		Checkbox=true;	
	  }
	});
	if (Checkbox){	
		var i = 0;
	    $("input[name='id[]']").each(function(){
	  		if (this.checked==true) {
				i++;
			}		
	    });
		if(i>1){ 
	    	alert("只能选择一条信息!");
			$(o).find("option:first").prop("selected","selected");
		}else{
		
			$("#listform").submit();		
		}	
	}
	else{
		alert("请选择要复制的内容!");
		$(o).find("option:first").prop("selected","selected");
		return false;
	}
}

</script>
</body>
</html>