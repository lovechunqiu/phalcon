<?php
class DemoController extends ControllerBase
{
    public function initialize()
    {        
        parent::initialize();
    }
 
   
    public function indexAction()
    { 
        
//        $catid= $this->dispatcher->getParam("catid");
//        $_GET['abc']=222;
//                    
        p(Com::getData(),$_GET,session());die; 
        
        
        G('demo2');
         //echo $homepage = file_get_contents('http://ss0.hao123img.com/res/r/image/2016-08-16/3a2c7a2b2edb77eadd10a0d0ea4a2e4d.png');die;
        //p($_GET);die;
         //sleep(3);
        p('func 12 track point 建立跟踪点');
        G('demo3');
        G('demo2','demo3');die; 
       
        
        p('func 11 microtime 得到微妙时间');
        p(mtime());
        die;
        
        p('func 10 del dir 删除目录');
        p(delDir(WEB_ROOT.'cache/aaa/',true));
        die;        
        
        p('func 9 del filename 删除文件');
        p(delFile(WEB_ROOT.'cache/aaa/abc.html.txt'));
        die;
        
        p('func 8 tree dirname 便利目录');
        p(getDirList(WEB_ROOT.'cache'));
        die;
        
        p('func 7 read or write file 读取或写入文件');
        p('写入文件',mFile(WEB_ROOT.'cache/aaa/abc.html.txt','aaa',true));
        p('读取文件',mFile(WEB_ROOT.'cache/aaa/abc.html.txt'));        
        die;  
                
        p('func 6 show error 抛出异常');
        //trigger_error ('Trigger a fatal error');     
        //throw new \Exception("An error");
        //3/0;
        unlink('abc');
        die;
        
        p('func 5 judge path if filename 判断一个字符串是否是文件');
        p(isFileName(WEB_ROOT.'cache/abc.html.txt'),isFileName(WEB_ROOT.'cache/abc/'));
        die;
        
        p('func 4 cookie manage cookie管理');      
        p('设置一个值', cookie('name', 'value'));
        p('获取一个值', cookie('name'));
        p('获取全部', cookie());
        //p('删除一个值', cookie('name', null));
        die;
        
        p('func 3 session manage session管理');
        p('设置一个值', session('name', 'value'));
        p('获取一个值', session('name'));
        p('获取全部', session());
        p('删除一个值', session('name', null));
        //会删除sessionr的文件
        p('销毁session', session(null));
        die;
        
        p('func 2 mkdir 创建目录', mmkdir(WEB_ROOT . 'cache/mkdirdemo'));
        die;
        
        p('func 1 print args  参数打印', __DIR__, 1, true, ['hello' => 'world']);
        die;

        $this->view->pick('demo/demo');
    }
    
    public function demoAction()
    {  
        //p('demoColler demo action'); 
        $this->view->start();
        echo 333;
        $this->view->pick('demo/demo');
        $this->view->finish();
        $html = $this->view->getContent(); 
        p($html);die;
        p($this->view,$this->view->getContent());die;
    }
     
}
