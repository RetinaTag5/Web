###路由與控制器 (如下圖表示) 
<span style="color:red">**1. 路由 : **</span>
- **" /" **和 **"route('home')"**皆導向** "HomePageController@ index"**，若未通過 
   Middleware('auth') 則導向 "route('login')"。
   
<span style="color:red">**2. 使用RESTFUL網路服務 : **</span>
- post : 使用者可 **新增/修改/刪除/讀取** 屬於自己的文章。 
- comment : 目前提供 **新增評論**。 
- likethumb: 目前提供對朋友文章按讚的功能 (類似臉書按讚功能)。

<span style="color:red">**3. 路由列表 : **</span>

[![php aritsan route:list](https://i.imgur.com/173M5nM.jpg "php aritsan route:list")](https://i.imgur.com/173M5nM.jpg "php aritsan route:list")
###Model模型 (參考Web/app )
<span style="color:red">**1. Comment : **</span>
- 與post 模型關係 : 一對多(一個post可以有很多comments) 
   
<span style="color:red">**2. friendship : **</span>
- **friendship ($authid, $userid)** 函式 : 
  回傳與其他使用者的 "**朋友/加朋友/等待回覆/接受好友邀請**" 狀態。
- **myfriend ($authid, $userid)** 函式 : 
  回傳與其他使用者是否為好友。
- **getfriendname($id)** 函式 : 
  回傳朋友資訊。

<span style="color:red">**3. likethumb(按讚功能) : **</span>
 - 與post 模型關係 : 一對多(一個post可以有很多likethumbs) 
 - **likeornot ($postId)** 函式 : 
  回傳使用者喜歡或不喜歡此文章。


<span style="color:red">**2. post : **</span>
 - 與post 模型關係 : 一對多(一個post可以有很多likethumbs) 
 -** likeornot ($postId)** 函式 : 
  回傳使用者喜歡或不喜歡此文章。


<span style="color:red">**＊Migration (參考Web/database/migrations底下.php檔案)**</span>
 - 新增6種tabl至資料庫 - **users/password/posts/comments/likethumbs/friendship **

<span style="color:red">**＊Layouts (參考Web/resources/views底下.php檔案)**</span></span>
 - 所有皆繼承** /layouts/page.blade.php**

<span style="color:red">**＊工具**</span>
- **Laravel Version : **Laravel Framework 5.6.5
- **PHP Version : PHP 7.2.2**
- **MySQL Version: **
 mysql  Ver 14.14 Distrib 5.7.21, for Linux (x86_64) using  EditLine wrapper
- **Nginx Version: **
 nginx version: nginx/1.13.6
- **Environment : **
 Linux homestead 4.4.0-112-generic #135-Ubuntu SMP Fri Jan 19 11:48:36 UTC 
 2018 x86_64 x86_64 x86_64 GNU/Linux
