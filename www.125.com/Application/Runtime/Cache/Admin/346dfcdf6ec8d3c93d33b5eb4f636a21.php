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
 <script src="/Public/Admin/Huploadify/jquery.js" type="text/javascript"></script>
<script src="/Public/Admin/Huploadify/jquery.Huploadify.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="/Public/Admin/Huploadify/Huploadify.css">
<script src="/Public/Admin/layer/layer.js"></script>
<script src="/Public/Admin/layer/layer.min.js"></script>
<div class="panel admin-panel">
  <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>增加内容</strong></div>
  <div class="body-content">
    <form method="post" class="form-x" action="" ENCTYPE="multipart/form-data" >  
      <div class="form-group">
        <div class="label">
          <label>标题：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" value="" name="goods_name" data-validate="required:请输入商品名称" />
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>图片：</label>
        </div>
        <div class="field"> 
          <div id="fileid"></div> <!--图片上传按钮-->
          <div id="imgid">
            <dt><img src="" alt="" class="cardImg" /></dt> <!--预览图片-->
               <!--  <dd>
                <button>主图</button>
                <button>删除</button>
                </dd> -->
          </div>  
        </div>
      </div>     
      
      <?php if($iscid == 1): ?><div class="form-group">
          <div class="label">
            <label>分类标题：</label>
          </div>
          <div class="field">
            <select name="cid" class="input w50">
              <option value="">请选择分类</option>
              <option value="">产品分类</option>
              <option value="">产品分类</option>
              <option value="">产品分类</option>
              <option value="">产品分类</option>
            </select>
            <div class="tips"></div>
          </div>
        </div>
        <div class="form-group">
          <div class="label">
            <label>其他属性：</label>
          </div>
          <div class="field" style="padding-top:8px;"> 
            首页 <input id="ishome"  type="checkbox" />
            推荐 <input id="isvouch"  type="checkbox" />
            置顶 <input id="istop"  type="checkbox" /> 
         
          </div>
        </div><?php endif; ?>
      <div class="clear"></div>
      <div class="form-group">
        <div class="label">
          <label>规格选项：</label>
        </div>
        <div class="field">
          <button type="button" id="ff"  name="item" onclick="add_spec(this)">添加规格</button> 
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label></label>
        </div>
        <div class="field">
          <button class="button bg-main icon-check-square-o" type="submit"> 提交</button>
        </div>
      </div>
    </form>
  </div>
</div>

  <script type="text/javascript">
    function uploadInit(domName,domPic)
    {  
        $("#fileid").Huploadify(
        {  
            auto:true,  
            fileTypeExts:'*.*',  
            multi:false,  
            fileObjName:'pic',  
            fileSizeLimit:99999999999,  
            showUploadedPercent:false,  
            buttonText:'上传',  
            uploader:'<?php echo U("upload");?>',
            onDelete:function(file)
            {
              console.log('删除的文件：'+file);
              console.log(file);
            },
            onUploadSuccess:function(file,data)
            {  
                // var Data=JSON.parse(data);  
                // if(Data.success==true){  
                //      $("#imgid").attr("src",Data.result);  
                //     param.uploadsuccess(Data.result);  
                // }else{  
                //      jQuery.longhz.alert(Data.resultDes);  
                // }
                var data = eval("("+data+")");
                 if(data.code == 0){
                 var html = '<dl style="float:left;margin-right:20px;" id="'+file.id+'">'+
                        '<dt style="border:1px solid #01a1ff;padding:5px;">'+
                           '<img src="/'+data.path+'" width="100" height="100">'+
                        '</dt>'+
                        '<dd style="text-align:center;">'+
                          '<button onclick="main(this)" type="button">主图<tton>'+
                          '<button onclick="removepic(this)" type="button">删除<tton>'+
                          '<input type="hidden" name="pic" value="'+data.path+'">'+
                        '</dd>'+
                      '</dl>';
                    $('#imgid').append(html);
                  }  
            },   
        });        
    }
    uploadInit("fileid","imgid");

    function removepic(o) 
    {
      $(o).parents('dl').remove();
    }
    function main(o) 
    {
      $(o).parents('#imgid').find('input[type="hidden"]').prop('name','pic');
      $(o).parents('dl').find('input[type="hidden"]').prop('name','image');
      $(o).parents('#imgid').find('dt').css({border:'1px solid #01a1ff'});
      $(o).parents('dl').find('dt').css({border:'1px solid black'});
    }

    function add_spec() {

      $.ajax({
          type : 'GET',
          url  : '<?php echo U("Goods/add_spec");?>',
          data : {},
          dataType: 'html',
        
          success : function (data) {
            layer.open({
                type: 1,
                skin: 'layui-layer-rim',
                area: ['600px', '385px'],
                content: data,
            });
          }
      })
    }

   
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