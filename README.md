# アプリケーション
Pigry（体重管理アプリ）

## 環境構築

### 1. Docker ビルド
・git clone gitgit@github.com:tsumika0524/Pigry.git<br>
・DockerDesktopアプリを立ち上げる<br>
・docker-compose up -d --build

### Laravel環境構築
1.docker-compose exec php bash<br>
2.composer install<br>
3.「.env.example」ファイルを 「.env」ファイルに命名を変更。または、新しく.envファイルを作成<br>
4..envに以下の環境変数を追加<br>

DB_CONNECTION=mysql<br>
DB_HOST=mysql<br>
DB_PORT=3306<br>
DB_DATABASE=laravel_db<br>
DB_USERNAME=laravel_user<br>
DB_PASSWORD=laravel_pass<br>

5.アプリケーションキーの作成<br>
php artisan key:generate<br>
6.マイグレーションの実行<br>
php artisan migrate<br>
7.シーディングの実行<br>
php artisan db:seed<br>

#### 環境開発URL
・トップページ(管理画面)ːhttp://localhost/weight_logs<br>
・体重登録ːhttp://localhost/weight_logs/create<br>
・体重検索ːhttp://localhost/weight_logs/search<br>
・目標設定ːhttp://localhost/wight_logs/goal_setting<br>
・会員登録ːhttp://localhost/register/step1<br>
・初期目標体重登録ːhttp://localhost/register/step2<br>
・ログインːhttp://localhost/login<br>

##### 使用技術(実行環境)
・PHP 8.4.13<br>
・Laravel 8.83.29<br>
・MySQL 8.0.26 <br>
・nginx 1.21.1 <br>
・jquery 3.7.1.min.js<br>

######　ER図
![ER図](src/docs/ER図.png)

