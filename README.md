Yii2 FAQ module
===============
Yii2 FAQ extension

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist ando/yii2-faq "*"
```

or add

```
"ando/yii2-faq": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :


- **Применить миграции**
```
yii migrate -p=@ando/yii2-faq/migrations
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