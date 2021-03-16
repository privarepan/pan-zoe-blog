## 环境要求 
    php : "^7.3|^8.0",

## 部署
- npm install -g laravel-echo-server --save
- composer install
- cp .env.example .env
- php artisan key:generate
- php migrate
- php artisan  db:seed
- php artisan queue:work  --sleep=3 --tries=3 
- npm install
- npm run dev
   
> 1. laravel-echo-server.json 已经在项目的根目录，修改 authHost 
> 2. cd 你的项目目录  laravel-echo-server start 
> 3. 如需使用github 授权登录请填写 .env GITHUB_CLIENT_ID GITHUB_CLIENT_SECRET


## 命令
  php artisan msg:clear     清除聊天数据以及缓存 

## 关于
[我的博客](http://www.pan-zoe.com)
> 这篇博客主要技术栈使用一下核心特别感谢作者为写了这么多好用的轮子，这篇博客仅做技术交流，大家喜欢的话，希望能给一个star

一下为使用的技术栈

> 1. livewire
> 2. tailwindcss
> 3. laravel-echo
> 4. dcat-admin
> 5. Aplinejs

## 模块

1. 文章
> 1. 文章添加删除编辑
> 2. 评论，添加删除，回复,点赞
> 3. 搜索，按标题，内容，以及标签查询

2. 标签
> 1. 标签增删改查
   
3. 用户
> 1. 登录，注册，退出，忘记密码，头像上传，个人中心，2次认证
> 2. 账号管理，删除账号，删除其他设备登录信息

4. 聊天
> 1. 支持私聊
> 2. 已读,未读消息数量提示
> 3. 用户正在输入提示

## 效果图

1. 首页




