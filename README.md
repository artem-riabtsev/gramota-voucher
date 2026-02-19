Скопировать переменные окружения
```bash
cp .env.example .env
```
Запуск контейнеров
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
http://localhost:8080
```