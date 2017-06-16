<?php
namespace Admin\Controller;


// 控制器 里面一个方法代表一个页面
class IndexController extends  CommonController {

   
   


    public function index(){
       
        $this ->display();

    }

    public function welcome(){

    	echo '你终于都进来了';
    }
   


}






