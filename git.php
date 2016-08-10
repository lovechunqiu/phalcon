1255  git init
 1256  git remote add demo3 git@code.aliyun.com:woshitongliango/demo3.git
 1257  git remote add demo2 git@code.aliyun.com:woshitongliango/demo2.git
 1258  git fetch demo3
 1259  git checkout -b demo3master demo3/master
 1260  git checkout -b demo3tong demo3/tong
 1261  git branch
 1262  ll
 1263  touch git.php
 1264  git add *

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
