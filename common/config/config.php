<?php
return new \Phalcon\Config(
    array(
        'databases' => array(
            'test' => array(
                'working' => true,
                'debug' => true,
                'adapter' => 'Mysql',
                'host' => '127.0.0.1',
                'port' => '3306',
                'username' => 'root',
                'password' => '111111',
                'dbname' => 'invo',
                "options" => array(
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'",
                    PDO::ATTR_CASE => PDO::CASE_NATURAL
                ),                    
            ),                       
        ),
        'caches' => array(
            'viewFileCache' => array(
                'type' => 'output',  
                'working' => true, 
                'lifetime'=>10,
                'cachePath'=>'cache/viewCache/'
            ),
            'viewFileCacheDemo' => array(
                'type' => 'output',  
                'working' => true, 
                'lifetime'=>10,
                'cachePath'=>'cache/viewFileCacheDemo/'
            ),     
            //系统表的缓存
            'systemData' => array(
                'type' => 'data',  
                'working' => true, 
                'lifetime'=>100,
                'cachePath'=>'cache/cacheData/systemData/'
            ),      
            'cacheDataTypeJson' => array(
                'type' => 'json',  
                'working' => true, 
                'lifetime'=>100,
                'cachePath'=>'cache/cacheData/'
            ), 
            'cacheDataTypeBase64' => array(
                'type' => 'base64',  
                'working' => true, 
                'lifetime'=>10,
                'cachePath'=>'cache/cacheData/'
            )                         
        ),    
        'application' => array(
            'scriptDir' => 'common/scripts/',
            'pluginsDir' =>'common/plugins/',
            'modelsDir' => 'common/models/',
            'libraryDir' => 'common/library/',
            'comApiDir' => 'common/api/',
            'demo' =>'common config',                
        )
    )
);
