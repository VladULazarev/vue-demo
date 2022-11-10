Vue App
-------------------

The purpose of the app is to show the understanding of the basic functionality
of the VUE framework: assets, components, store, router, directives, views and so on...

Also, in the app was set connection to the MySql data base.

A user can <a href="/posts">get all existing posts</a> and search posts by title.
A user can send a message using <a href="/contact">Contact Form</a> (all fields
are checked for 'bad' characters and 'email' is checked for matching the email pattern).

As an example of the `CRUD basic operations`: a user can <a href="/contact">create a message</a>,
and then read, edit and delete all existing messages on <a href="/show-messages">Show Messages</a> page.

The file `vue-actions.php` can be found in the root folder.

-------------------------


Цель приложения - показать понимание основного функционала фреймворка VUE:
активы, компоненты, глобальное хранилище, маршрутизатор, директивы, представления и т. д...

Также в приложении реализовано подключение к базе данных MySql.

Пользователь может <a href="/posts">получить все существующие публикации</a>
и выполнить поиск публикаций по заголовку.

Можно отправить сообщение, используя <a href="/contact">контактную форму</a> (все поля проверяются на
наличие «плохих» символов, а email проверяется на соответствие шаблону электронной почты).

Так же в приложении реализованы `CRUD операции`: пользователь может <a href="/contact">создать сообщение</a>,
и потом читать, редактировать и удалять все существующие сообщения на странице
<a href="/show-messages">Показать сообщения</a>.

Файл `vue-actions.php`, небходимый для работы с базой данных,
находиться в корневой папке приложения.

