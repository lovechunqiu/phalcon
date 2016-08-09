 
cat /etc/sysconfig/network-scripts/ifcfg-eth0
DEVICE=eth0
HWADDR=00:0C:29:3B:2A:E0
TYPE=Ethernet
UUID=fa9a32c2-0922-4df9-9266-b8150e0319ab
ONBOOT=yes
NM_CONTROLLED=yes
BOOTPROTO=dhcp
GATEWAY=192.168.21.2
NETMASK=255.255.255.0

cat /etc/resolv.conf
nameserver 192.168.21.2

cat /etc/sysconfig/network
NETWORKING=yes
NETWORKING_IPV6=no
IPV6INIT=no
HOSTNAME=localhost.localdomain


https://www.centos.bz/2012/02/vmware-deploy-centos-virtual-nat-connect/



欢迎使用新建虚拟机向导
CentOS-6.5-x86_64-minimal
1 自定义高级
2 稍后安装操作系统
3 linux centos 64
4 使用桥接
5 新创建虚拟磁盘
6 将虚拟磁盘拆分成多个文件
7 编辑虚拟机 cd/dvd ide 使用iso映像文件
8 skip 跳过
9 中文 基本存储设备
10 使用所有空间

卸载防火墙
service iptables stop
chkconfig iptables off

//关闭selinxu的设置
/etc/selinux/config
#SELINUX=enforcing
SELINUX=disabled

vi /etc/sysconfig/network
NETWORKING=yes
NETWORKING_IPV6=no
IPV6INIT=no
HOSTNAME=localhost.localdomain
GATEWAY=192.168.1.1

vi /etc/resolv.conf
nameserver 192.168.1.1

 
vi /etc/sysconfig/network-scripts/ifcfg-eth0
DEVICE=eth0
HWADDR=00:0C:29:CC:32:4D
TYPE=Ethernet
UUID=3564429b-0b12-460d-82d8-a829907f4291
ONBOOT=yes
NM_CONTROLLED=no
BOOTPROTO=static
IPADDR=192.168.1.63
NETMASK=255.255.255.0
BROADCAST=192.168.1.255
NETWORK=192.168.1.0
NETWORKING_IPV6=no
IPV6INIT=no
IPV6_AUTOCONF=no

service network start
ping www.baidu.com
ping 192.168.1.1
 
 
解决办法：主要原因就是mac的地址发生了变化
http://www.cnblogs.com/sixiweb/archive/2013/05/31/3110734.html
rm -f /etc/udev/rules.d/70-persistent-net.rules
vi /etc/sysconfig/network-scripts/ifcfg-eth0
reboot


vm虚拟机无法安装64位系统分析及解决方案
bios里的cpu
找到选项Intel&nbsp;Virtualization&nbsp;Technology(英特尔处理器虚拟化技术)
