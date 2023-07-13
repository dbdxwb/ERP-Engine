##开发环境
建立 sail 命令别名，将用 sail 来代替 vendor/bin/sail
```bash
alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'
```
启动
```bash
sail up -d
``` 
停止
```bash
sail down
``` 

##Octane
安装
```bash
sail composer require laravel/octane
sail php artisan octane:install

 Which application server you would like to use?:
  [0] roadrunner
  [1] swoole
 > swoole
```
