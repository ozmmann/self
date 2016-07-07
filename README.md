Self Service Pokupon&SuperDeal
============================

Установка
------------
### Добавтье в файл .env необходимые настроки подключения к базе данных

```DB_DSN=mysql:host=<HOST>;dbname=<DBNAME>
DB_USER=<USERNAME>
DB_PASSWORD='<PASSWORD>'
```

а также настройки SMTP

```
SMTP_HOST="<HOST|smtp.gmail.com>"
SMTP_USER="<USERNAME>"
SMTP_PASSWORD="<PASSWORD>"
SMTP_PORT="<PORT|587>"
```

### Выполните миграцию базы данных
```
yii migrate
```

### Сделайте импорт данных из
~~~
selfservice_min.sql
~~~

### Теперь можете зайти под админом, добавить города, категории и коммисии

###Модератор
Для добавления модератора, зарегестрируйте нового пользователя, в базе поменяйте роль в таблице ss_user на "MODERATOR", добавьте его в файл rbac/assignments.php