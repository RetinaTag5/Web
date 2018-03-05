### ＊路由與控制器 (如下圖表示) 
 **1. 路由 :** 
-  **"route('home')"** 和 **"/"** 皆導向 **"HomePageController@ index"** ，若未通過 
   Middleware('auth') 則導向 "route('login')"。
   
 **2. 使用RESTFUL網路服務 :** 
- post : 使用者可 **新增/修改/刪除/讀取** 屬於自己的文章。 
- comment : 目前提供 **新增評論**。 
- likethumb: 目前提供對朋友文章按讚的功能 (類似臉書按讚功能)。

**3. 路由列表 :**

[![php aritsan route:list](https://i.imgur.com/173M5nM.jpg "php aritsan route:list")](https://i.imgur.com/173M5nM.jpg "php aritsan route:list")

### ＊Model模型 ( [參考Web/app](https://github.com/RetinaTag5/Web/tree/master/app) )
**1. Comment :**
- 與post 模型關係 : 一對多(一個post可以有很多comments) 
   
**2. friendship :**
- **friendship ($authid, $userid)** 函式 : 
  回傳與其他使用者的 "**朋友/加朋友/等待回覆/接受好友邀請**" 狀態。
- **myfriend ($authid, $userid)** 函式 : 
  回傳與其他使用者是否為好友。
- **getfriendname($id)** 函式 : 
  回傳朋友資訊。

**3. likethumb(按讚功能) :**
 - 與post 模型關係 : 一對多(一個post可以有很多likethumbs) 
 - **likeornot ($postId)** 函式 : 
  回傳使用者喜歡或不喜歡此文章。


**2. post :**
 - 與post 模型關係 : 一對多(一個post可以有很多likethumbs) 
 - **likeornot ($postId)** 函式 : 
  回傳使用者喜歡或不喜歡此文章。


### ＊Migration (參考 [Web/database/migrations](https://github.com/RetinaTag5/Web/tree/master/database/migrations) 底下.php檔案)
 - 新增6種模型至資料庫 - **users/password/posts/comments/likethumbs/friendship**

### ＊Layouts (參考 [Web/resources/views](https://github.com/RetinaTag5/Web/tree/master/resources/views) 底下.php檔案)
 - 所有皆繼承 **/layouts/page.blade.php**

### ＊工具
- **Laravel Version :** Laravel Framework 5.6.5
- **PHP Version :** PHP 7.2.2
- **MySQL Version:**
 mysql  Ver 14.14 Distrib 5.7.21, for Linux (x86_64) using  EditLine wrapper
- **Nginx Version:**
 nginx version: nginx/1.13.6
- **Environment :**
 Linux homestead 4.4.0-112-generic #135-Ubuntu SMP Fri Jan 19 11:48:36 UTC 
 2018 x86_64 x86_64 x86_64 GNU/Linux
