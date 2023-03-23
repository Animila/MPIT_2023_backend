# Приложение TourTravel

Проект для кейса Ростелекома, предназначенный для популяции среди жителей и гостей Республики необычных мест, где можно с пользой и весело провести время во время тура

> Данный проект разрабатывался в рамках хакатона Республиканского этапа "Моя профессия - IT" 2023  

## Команда "Шашлычки"

> Дизайнер: Кузнецов Данил

> Разработчик: Христофоров Илья

> Менеджер: Неробов Максим


## Стек-технологии

Фронтенд построен на [React Native](https://reactnative.dev/) (v8.11.0) и с использованием [Expo](https://expo.dev/). Для стилизации используется [TailwindCss](https://tailwindcss.ru/). 

Библиотеки для React:

| Библиотека                                  | Версия       |
|---------------------------------------------|--------------|
| "@react-native-async-storage/async-storage" | "^1.17.12"   |
|"@react-navigation/bottom-tabs"             |  "^6.5.7",   |
|"@react-navigation/native"                  |  "^6.1.6",   |
|"@react-navigation/native-stack"            |  "^6.9.12",  |
|"axios"                                     |  "^1.3.4",   |
|"expo"                                      |  "~48.0.6",  |
|"expo-location"                             |  "^15.1.1",  |
|"expo-status-bar"                           |  "~1.4.4",   |
|"react"                                     |  "18.2.0",   |
|"react-dom"                                 |  "^18.2.0",  |
|"react-icons"                               |  "^4.8.0",   |
|"react-native"                              |  "0.71.3",   |
|"react-native-loading-spinner-overlay"      |  "^3.0.1",   |
|"react-native-maps"                         |  "1.4.0",    |
|"react-native-masked-text"                  |  "^1.13.0",  |
|"react-native-safe-area-context"            |  "^4.5.0",   |
|"react-native-screens"                      | "^3.20.0",   |
|"react-native-svg"                          |  "^13.8.0",  |
|"react-native-swipe-cards"                  |  "^0.1.1",   |
|"react-native-web"                          |  "~0.18.11", |
|"react-native-yamap"                        |  "^4.1.18",  |
 |    "tailwindcss-react-native"               |  "^1.7.10"   |  


В качестве бекенда же выступает PHP(v7.4.29-cli) и [Laravel](https://laravel.com/) (v10.0) для получения данных через API, а также обработки различной информации.
Сервер развернут на серверах [ЭджЦентра](https://hosting.edgecenter.ru/billmgr) с установленной системой Ubuntu 20.04 и сервером Nginx.

## Установка и запуск

~~Для установки проекта требуется иметь [Git](https://git-scm.com), [NodeJs](https://nodejs.org/ru/) (v16.16.0). Открыть консоль и прописать:~~

`git clone https://github.com/Animila/mpit_2023_backend.git`

`cd mpit_2023_backend`

Теперь мы используем Docker для развертывания на сервере. ВНИМАНИЕ! Возможны некоторые проблемы при установке - обратитесь к разработчику за помощью

`docker-compose up -d`

Если же надо установить уже на сервер, то активируем докер продакшена:

`docker-compose -f docker-compose.prod.yml up -d`

После этого следует установить все зависимости:
`docker-compose exec app composer install`; После чего уже установить ключ шифрования: `docker-compose exec app php artisan key:generate`.

## Использование

Необходимо настроить внешний nginx на работу с портом 80.



## Лицензия

Данный проект разрабатывается в рамках хакатона. Все материалы, за исключением лицензированных изображений и материалов компаний, распространяются по GNU лицензии
