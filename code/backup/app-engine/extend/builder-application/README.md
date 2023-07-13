基于laravel-modules修改

### 创建新应用

新增应用（可选择是否创建后台）
> php artisan builder-application:make Blog --is_admin 创建后台

生成数据库表
> php artisan builder-application:migrate Blog

生成基础数据
> php artisan builder-application:seed Blog

为指定模块生成迁移
>php artisan builder-application:make-migration create_posts_table Blog
