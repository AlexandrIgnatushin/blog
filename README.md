# blog
1. Склонируйте проект в вашу директорию
2. Перейдите в директорию проекта (cd /проект), создайте докер образ (docker build -t blog-image .)
3. Запустите контейнер (docker run -p "ваш порт:80" -v ${PWD}/директория проекта:/app blog-image)
4. При запуске контейнера в консоли появится сообщение:

<p>============================================ <br>
You can now connect to this MySQL Server with ARb4fRxWS1sA

    mysql -uadmin -pARb4fRxWS1sA -h<host> -P<port>

Please remember to change the above password as soon as possible!
MySQL user 'root' has no password but only allows local connections

enjoy!<br>
================================================</p>
скопируйте сгенерированный пароль в строке "Server with пароль" и в файле проекта config.php в переменную $bdpass вставьте пароль

5. Откройте phpmyadmin по пути в url http://127.0.0.1:порт/phpmyadmin,
      авторизация: логин - 'admin', пароль - сгенерированный пароль (см выше)
7. Создайте базу с названием "test", импортируйте приложенные дампы
