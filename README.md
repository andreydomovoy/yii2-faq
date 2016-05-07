Yii2 FAQ module
===============
FAQ extension for Yii2

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Add repo to your composer.json

```
"repositories":[
    {
        "type": "git",
        "url": "https://github.com/andreydomovoy/yii2-faq"
    }
]
```
and run

```
php composer.phar require ando/yii2-faq:dev-master
```

Usage
-----

Once the extension is installed, simply use it in your code by  :


- **Применить миграции**
```
yii migrate -p=@ando/faq/migrations
```

- **Инициализация**

Добавьте модуль в конфигурацию приложения:

```php
'modules'   => [
    'faq'   => 'ando\faq\Module',
],
```

- **Работа с ЧАВО**

Администрирование: 
```
faq/admin
```

Публичная часть: 
```
faq/public
```

Язык использован из Application::language

