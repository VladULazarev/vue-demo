<template>
  <div class="home content">
    <h1 class="mb-4">{{ $store.state.appTitle }}</h1>

    <p>
      The purpose of the app is to show the understanding of the basic functionality
      of the VUE framework: assets, components, store, router, directives, views and so on...
    </p>

    <p>
      Also, in the app was set connection to the MySql data base.
    </p>

    <p>
      A user can <a href="/posts">get all existing posts</a> and search posts by title.
      A user can send a message using <a href="/contact">Contact Form</a> (all fields
      are checked for 'bad' characters and 'email' is checked for matching the email pattern).
    </p>

    <p>
      As an example of the CRUD basic operations: a user can <a href="/contact">create a message</a>,
      and then read, edit and delete all existing messages on <a href="/show-messages">Show Messages</a> page.
    </p>

    <p>
      The code of the app and the file vue-actions.php can be viewed on GitHub
      <a href="https://github.com/VladULazarev/vue-demo">Vue App</a>.
    </p>

  </div>

  <div class="home content">
    <p>
      Цель приложения - показать понимание основного функционала фреймворка VUE:
      активы, компоненты, глобальное хранилище, маршрутизатор, директивы, представления и т. д...
    </p>

    <p>
      Также в приложении реализовано подключение к базе данных MySql.
    </p>

    <p>
      Пользователь может <a href="/posts">получить все существующие публикации</a>
      и выполнить поиск публикаций по заголовку. Можно отправить сообщение,
      используя <a href="/contact">контактную форму</a> (все поля проверяются на
      наличие «плохих» символов, а email проверяется на соответствие шаблону электронной почты).
    </p>

    <p>
      Так же в приложении реализованы CRUD операции: пользователь может <a href="/contact">создать сообщение</a>,
      и потом читать, редактировать и удалять все существующие сообщения на странице
      <a href="/show-messages">Показать сообщения</a>.
    </p>

    <p>
      Код приложения и файл vue-actions.php, небходимый для работы с базой данных,
      можно посмотреть на GitHub <a href="https://github.com/VladULazarev/vue-demo">Vue App</a>.
    </p>

  </div>
</template>

<script>

export default {
  mounted() {
    $(".content").fadeTo(500, 1);
  }
}

</script>

<style scoped>
.home {
  margin-bottom: 7rem;
}
a {
  color: #54b881;
  transition: all .3s;
}
</style>


