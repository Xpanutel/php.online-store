Добро пожаловать в проект Guardians of Dreams Shop! 

### Стек технологий

![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-323330?style=for-the-badge&logo=javascript&logoColor=F7DF1E)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)

### Требования к проекту
Проект включает в себя следующие компоненты:

- Страница для отображения всех товаров из базы данных.
- Система регистрации пользователей.
- Система авторизации пользователей.
- Профиль пользователя, доступный после регистрации.
- Возможность добавления и удаления товаров.

### Структура проекта

Проект организован следующим образом:
```
| -- /components
|  -- header.php
|  -- footer.php
```
Здесь находятся общие компоненты интерфейса сайта, такие как шапка и подвал. 
```Header.php``` содержит код для верхней части страницы, включая навигационное меню и логотип. 
```Footer.php``` содержит код для нижней части страницы.

```
|-- /css
|   -- style.css
|   -- footer.css
|   -- header.css
```
Здесь хранятся каскадные таблицы стилей (CSS), которые определяют внешний вид элементов на странице. 
```Style.css``` обычно содержит общие стили для всего сайта. 
```Footer.css и Header.css``` используются для стилизации соответствующих компонентов.

```
|-- /img
|   -- logo.png
```
Здесь хранятся изображения, используемые на сайте. 
```Logo.png``` - это логотип интернет - магазина.

```
|-- /js
|   -- scripts.js
```
Здесь хранится JavaScript-код, который взаимодействует с пользователем или выполняет другие динамические задачи на странице. 
```Scripts.js``` может включать в себя различные скрипты, такие как обработка форм, слайдеры изображений и т.д.

```
|-- /sql
|  -- users.sql
|  -- products.sql
|  -- -- store.sql
```
Здесь находятся SQL-скрипты, которые используются для создания и управления базой данных. 
```Users.sql``` - содержит определения таблицы пользователей. 
```Products.sql``` - содержит таблицу продуктов
```Store.sql``` - содержит таблицу магазина.

```
|-- index.php
```
Это главная страница сайта, которая обычно является точкой входа для посетителей. Здесь представлена информация продуктах.

```
|-- cart.php
```
Это страница корзины покупок, где пользователь может просматривать выбранные товары и оформлять заказ.

```
|-- login.php
```
Это страница входа, где пользователь может ввести свои учетные данные для доступа к защищенным разделам сайта.

```
|-- register.php
```
Это страница регистрации, где новые пользователи могут создать аккаунт на сайте.

```
|-- profile.php
```
Это страница профиля пользователя, где он может управлять своими данными, настройками и заказами.

```
|-- db_config.php
```
Это конфигурационный файл базы данных, который содержит информацию, необходимую для подключения к базе данных, такую как имя хоста, имя базы данных, имя пользователя и пароль.

```
|-- .htaccess
```
Это файл конфигурации Apache, который используется для настройки сервера и управления URL-адресами.


### Как начать работу с проектом

Чтобы начать работу с проектом, вам потребуется следующее:

1. Установите OpenServer или другой инструмент для запуска локального сервера.
1. Создайте базу данных и импортируйте SQL-скрипты из папки /sql для создания таблиц.
2. Замените содержимое файла db_config.php на актуальные данные вашей базы данных.
3. Откройте файл .htaccess и настройте правила перезаписи URL в соответствии с вашими потребностями.
4. Запустите проект на локальном сервере.

### Поддержка и обратная связь

Если у вас возникнут вопросы или предложения по улучшению проекта, пожалуйста, свяжитесь со мной через GitHub. Я буду рад услышать ваше мнение и помочь вам в освоении проекта.

Спасибо за интерес к проекту Guardians of Dreams Shop!