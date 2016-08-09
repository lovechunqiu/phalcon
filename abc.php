
安装 
yum list | grep ^git
yum -y install git-all.noarch
yum list installed | grep git*

生成密钥 
ssh-keygen -t rsa
/root/.ssh

创建一个 Git 仓库
git init

配置 
git config --global user.name zhangyidan
git config --global user.email 609854340@qq.com
查看配置
git config --l 
 
克隆一个仓库
git clone git@code.aliyun.com:woshitongliango/demo2.git
克隆指定分支
git clone -b tong  git@code.aliyun.com:woshitongliango/demo2.git

添加一个仓库
git remote add ali git@code.aliyun.com:woshitongliango/demo2.git
git remote add ali git@code.aliyun.com:woshitongliango/demo3.git
git remote add hub git@github.com:freeskyala/demo.git
查看所有仓库
git remote -v

检出
git fetch ali
git checkout master

git merge ali/tong

touch hello.rb

git status -s
?
git add *

git status -s
A
date >> hello.rb 

git status -s
AM
 
git diff

git commit -a -m 'haha'

git push origin master
git push origin num2
git fetch origin
git fetch tong
git fetch testing
git merge origin/testing
git merge origin/num2
git merge ali/tong
git merge origin/tong

git push origin testing
git reset --hard

git checkout -b testing
git pull origin testing

http://www.360doc.com/content/13/1227/19/11948835_340607423.shtml

http://www.360doc.com/userhome/11948835#
