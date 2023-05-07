# Приложение TourTravel

Проект для кейса Ростелекома, предназначенный для популяции среди жителей и гостей Республики необычных мест, где можно с пользой и весело провести время во время тура

> Данный проект разрабатывался в рамках хакатона Республиканского этапа "Моя профессия - IT" 2023  

## Команда "Шашлычки"

> Дизайнер: Кузнецов Данил

> Разработчик: Христофоров Илья

> Менеджер: Неробов Максим


## Стек-технологии



В качестве бекенда же выступает PHP(v7.4.29-cli) и [Laravel](https://laravel.com/) (v10.0) для получения данных через API, а также обработки различной информации.
Сервер развернут на серверах [ЭджЦентра](https://hosting.edgecenter.ru/billmgr) с установленной системой Ubuntu 20.04 и сервером Nginx. SSL сертификат подписан CertBot

## Установка и запуск

~~Для установки проекта требуется иметь [Git](https://git-scm.com), [NodeJs](https://nodejs.org/ru/) (v16.16.0). Открыть консоль и прописать:~~

`git clone https://github.com/Animila/mpit_2023_backend.git`

`cd mpit_2023_backend`

Теперь мы используем Docker для развертывания на сервере. ВНИМАНИЕ! Возможны некоторые проблемы при установке - обратитесь к разработчику за помощью

`docker-compose up -d --build`


~~После этого следует установить все зависимости:
`docker-compose exec app composer install`; После чего уже установить ключ шифрования: `docker-compose exec app php artisan key:generate`.~~

Провел полную автоматизацию. Теперь есть отслеживание изменений внутри контейнеров, при запуске устаналиваются все зависимости и проводятся миграции.  

## Использование

Необходимо настроить внешний nginx на работу с портом 80.
При измении документации необходимо запускать переустановку swagger: `php artisan l5-swagger:generate`

## ОПИСАНИЕ МЕТОДОВ API ЛЕЖИТ В ФАЙЛЕ `Tour Trip.postman_collection.json`



## Лицензия

Данный проект разрабатывается в рамках хакатона. Все материалы, за исключением лицензированных изображений и материалов компаний, распространяются по GNU лицензии
