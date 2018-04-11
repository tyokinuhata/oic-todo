# todoom

おもしろいTODOアプリです。

# 開発環境の構築

### クローン

```bash
$ git clone https://github.com/tyokinuhata/todoom.git
```

### インストール

```bash
$ cd todoom 
$ composer install
$ npm install
```

### .envの作成

```bash
$ cp .env.example .env
```

### APP_KEYの作成

```bash
$ php artisan key:generate
```

### Laravel Homesteadの設定

```bash
$ php vencor/bin/homestead make
```

# 起動方法

```bash
$ vagrant up
$ vagrant ssh
$ npm run watch
$ open http://{your_private_ip_address}:8000
```
