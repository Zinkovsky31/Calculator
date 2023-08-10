Приложение расчета стоимости доставки
=========================================

# Запуск приложения через Docker Compose

1. скопировать .env.dist в .env
2. настроить переменные окружения
3. выполнить команду make install, дождаться завершения установки
4. открыть приложение в браузере по адресу http://localhost:{APP_WEB_PORT}

## Команды Make

- `make install` - выполнить установку приложения
- `make up` - запуск контейнеров приложения
- `make down` - остановка контейнеров приложения
- `make ps` - статус контейнеров приложения
- `make docker-logs` - логи контейнеров приложения
- `make app-php-cli-exec` - запуск команды внутри контейнера php-cli
- `composer-install` - установка пакетов-зависимостей php приложения
- `make run-yii` - просмотра доступных команд приложения на Yii2