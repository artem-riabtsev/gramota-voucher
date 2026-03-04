Запуск контейнеров
```bash
# Скопировать переменные окружения
cp .env.example .env
```
```bash
# Собрать и запустить контейнеры
docker compose up -d
```
Установка зависимостей
```bash
# Установить все пакеты через Composer
docker compose exec php composer install
```
Выполнение миграций
```bash
# Выполнить миграции
docker compose exec php bin/console doctrine:migrations:migrate
```

Доступ к приложению
```bash
http://localhost:8080/ped
http://localhost:8080/phil
http://localhost:8080/pan
http://localhost:8080/mns

http://localhost/admin
```