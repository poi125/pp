<?php
namespace Admin\Controller;

use THink\Controller;

class MessageController extends Controller{
	public function kk(){
		echo "4534564564654";



		m('message') ->add([
				'user_name' =>$user_name,
				'content'	=$content,
			])
	}
}

?>