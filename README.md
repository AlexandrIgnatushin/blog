# blog
1. Склонируйте проект в вашу директорию
2. Создайте докер образ (docker build -t image-blog .)
3. Запустите контейнер (docker run -p "ваш порт:80" -v ${PWD}/директория проекта:/app image-blog)
4. При запуске контейнера в консоли появится сообщение:
========================================================================
You can now connect to this MySQL Server with 6wNLKia4695C

    mysql -uadmin -p6wNLKia4695C -h<host> -P<port>

Please remember to change the above password as soon as possible!
MySQL user 'root' has no password but only allows local connections

enjoy!
========================================================================

скопируйте сгенерированный пароль 6wNLKia4695C и вставьте в /app/config.php в переменную $bdpass = '6wNLKia4695C'

5. Откройте phpmyadmin по пути в url http://127.0.0.1:порт/phpmyadmin
6. Создайте базу с названием "test", импортируйте приложенные дампы
