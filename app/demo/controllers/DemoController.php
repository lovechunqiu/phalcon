<?php
class DemoController extends ControllerBase
{
    public function initialize()
    {        
        parent::initialize();
    }
 
   
    public function indexAction()
    { 
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
        //p('删除一个值', session('name', null));
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
        p('demoColler demo action');   
    }
     
}
