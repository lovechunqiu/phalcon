install phalcon like this

#check php version >5
/opt/php55/bin/php -v

PHP 5.5.15 (cli) (built: Nov 19 2014 08:14:35) (DEBUG)
Copyright (c) 1997-2014 The PHP Group
Zend Engine v2.5.0, Copyright (c) 1998-2014 Zend Technologies
    with Xdebug v2.3.3, Copyright (c) 2002-2015, by Derick Rethans

# git clone phalcon code
git clone git://github.com/phalcon/cphalcon
git checkout  -f -b origin/master
cd cphalcon/ext

#install phalcon
/opt/php55/bin/phpize
./configure --with-php-config=/opt/php55/bin/php-config --enable-phalcon

make && make install

vim /opt/php55/etc/php.ini 
extension=phalcon.so

service php-fpm-9001 restart

phpinfo();

.gitignore
