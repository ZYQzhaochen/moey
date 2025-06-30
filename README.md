# Moey API
简单纯前端实现的一言网站+相关api

config文件夹——
1. config.php：设置基础信息
2. links.txt：友链储存文件
   thanks_team.txt和thanks_per.txt：鸣谢对象储存文件
3. 两个.dat后缀文件为语句和图片接口调用次数统计的数据

admin文件夹——(后端面板未完成)
1. yanup.php和wpup.php分别为语句和图片的快捷提交页面，可直接访问后根据页面提示自行添加语句/图片
2. 访问lp.php可快捷添加友链信息至前文links.txt，也可以直接编辑links.txt
3. audit.txt储存了用户提交待审核的语句信息，没写后端面板，只能自己查看和编辑文件

萌言网后端不便暴露的接口/页面等敏感部分未在此仓库中开源
如有问题可提交issue或发送邮件至zc@moey.cn，感谢您的阅读