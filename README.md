Скопировать переменные окружения
```bash
cp .env.example .env
```
Создать каталог для временных файлов
```bash
mkdir -p var/voucher_pdf
chmod -R 777 var/voucher_pdf
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