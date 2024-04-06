# Student List

Простое приложение на базе собственного фреймворка. Проект был начат с целью ознакомления с внутренним устройством современных веб-приложений, но был заморожен из-за недостатка знаний.

- [Требования](#требования)
- [Установка и запуск](#установка-и-запуск)
- [Особенности](#особенности)

## Требования

- PHP >=8.2
- Composer
- PostgreSQL >=16.2
- Веб-сервер Nginx

## Установка и запуск

Для установки и запуска приложения можно использовать собственную среду, либо воспользоваться [моей докер-средой](https://github.com/bcchicr/docker-php-env)

Клонировать репозиторий на локальную машину:

```bash
  git clone https://github.com/bcchicr/student-list.git
```

Зайти в папку проекта и установить зависимости:

```bash
  composer install
```

Настроить конфиг `./config/config.ini`

Запустить php-скрипт, создающий таблицы базы данных:

```bash
  php ./database/dump.php
```

## Особенности

- Не используются сторонние библиотеки (кроме контейнера зависимостей)
- Используется собственный [контейнер зависимостей](https://github.com/bcchicr/di-container), соответствующий стандарту [PSR-11](https://www.php-fig.org/psr/psr-11/)
- HTTP-обертки написаны с оглядкой на стандарт [PSR-7](https://www.php-fig.org/psr/psr-7/), но с упрощениями
- HTTP-фабрики написаны в соответствии со стандартом [PSR-17](https://www.php-fig.org/psr/psr-17/), но реализованы не все фабрики. Кроме того фабрики используют в объявлении типов конкретные реализации HTTP-оберток, а не PSR-7 интерфейсы
- Реализованный Event Loop соответствует стандарту [PSR-15](https://www.php-fig.org/psr/psr-15/), но использует собственные интерфейсы и HTTP-обертки
- Система маршрутизации реализована через middleware'ы
- Слой ORM реализован в соответствии с паттерном Data Mapper. Файлы с классами не генерируются автоматически.
- Слой ORM использует паттерны:
  - Identity Map для исключения дублирования объектов
  - Domain Object Factory для генерации моделей предметной области
  - Data Transfer Object для инкапсуляции критериев запроса
  - Query Factory для генерации запросов Select и Upsert
  - Abstract Factory для организации различных компонентов
- Для генерации отображений используется шаблонизатор PHP

Что **НЕ** реализовано:

- Полноценный слой валидации данных, приходящих от клиента
- Авторизация и работа с сессиями
- Вынесение бизнес-логики из контроллеров в отдельный слой
