# PHP抓取MaxRnb.cn网站"听音乐"模块音乐


[演示地址](http://maxrnb.hashx.cn)

maxrnb.cn是我一直喜欢上的一个音乐论坛。菜单上面有个"听音乐"的栏目，我特别喜欢里面推荐的歌曲。但是有个问题就是每次只能听一首歌曲，所以才有了这个小程序。
通过程序抓取了这个栏目上的所有音乐(516首歌曲),然后存入到数据库中。其中最重要的就是mp3的url，结果如下
![maxrnb mp3 data](https://oss.v2url.com/2018/03/01/016c2aa4142d42e4a26a31f60966652d.png)


## 使用方法
1. 将仓库中的`maxrnb.sql`文件导入到数据库中;
2. 修改`config`目录下的`mysql.ini.sample`为`mysql.ini`，然后修改对应的数据库连接信息;
3. 最后在**命令行**下进入到程序根目录执行`php worker.php`即可。

抓取日志存放在`/tmp/maxrnb.log`中


---
## 遇到的坑
1. maxrnb上抓取到的音乐设置了referer防盗链，所以直接在网页中引用会导致无法播放。通过搜索是直接在`index.html`中加入了
`<meta name="referrer" content="never">`就可以了

2. 使用了[audiojs](https://github.com/kolber/audiojs)这个前端播放器。但是有时候在播放过程中会出现不自动切换下一曲的情况，针对这个问题我目前还不知道是什么情况。也试了另外的播放器也会出现不自动切换的情况。
但是我改用本地mp3文件貌似就不会有这个问题。如果有大神知道的话，请不吝赐教，感谢。
