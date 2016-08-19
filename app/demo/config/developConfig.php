<?php
$baseConfig = require_once WEB_ROOT.'common/config/config.php';        
//合并配置文件
return $baseConfig->merge(new \Phalcon\Config(
    array(        
        'application' => array(       
            'demo' =>'admin config',
            'controllersDir'=>APP_PATH . 'controllers/',
            'viewsDir'=>APP_PATH . 'views/',
            'voltCacheDir'=>WEB_ROOT.'cache/volt/'.APP_FILE_NAME.'/',            
            'urlExt' =>'.html',
            'session' =>array(
                'type'=>'files',
                'files'=>array(                  
                    'expire'=>TIME+60*60*24,
                    'path'=>'/',
                    'domain'=>'.demo.com',
                    'sessionCacheDir'=>WEB_ROOT.'cache/session/'.APP_FILE_NAME.'/',                    
                ),
            ),            
            'cookie' =>array(
                'expire'=>TIME+60*60*24,
                'path'=>'/',
                'domain'=>'.demo.com',
                'useEncryption'=>false
            ),
            //'viewsDir'=>WEB_ROOT.'public/template/admin/default/'
        ),
        'caches' => array(         
            'cacheDataTypeBase64' => array(
                'type' => 'base64',  
                'working' => true, 
                'lifetime'=>10,
                'cachePath'=>'cache/cacheData/'
            )                         
        ),         
    )
));