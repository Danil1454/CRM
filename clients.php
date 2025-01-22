<?php session_start();

// Проверить переменную $_SECCION
    // на наличие token , нет- редирект на
    // errorPath
    // http://localhost/CRM
require_once 'api/auth/AuthCheck.php';

AuthCheck('','login.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>CRM | Товары</title>
    <link rel="stylesheet" href="styles/modules/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles/settings.css">
    <link rel="stylesheet" href="styles/pages/clients.css">
    <link rel="stylesheet" href="styles/modules/micromodal.css">
</head>
<body>
<header class="header">
<div class="container">
    <p>Фамилия Имя Отчество</p>
     <ul> 
        <li><a href="">Клиенты</a></li>
        <li><a href="">Товары</a></li>
        <li><a href="">Заказы</a></li>
     </ul>
     <a class="header_logout" href="">Выйти</a> 
</div>
</header>
<main>
    <section class="filters">
        <div class="container">
            <form action="">
                <label for="search">Поиск по имени</label>
                <input type="text" id="search" name="search" placeholder="Введите имя" required>
                <label for="search">Сортировка по имени</label>
                <select name="sort" id="sort">
                    <option value="0">По возрастанию</option>
                    <option value="1">По убыванию</option>
                </select>
            </form>
        </div>
    </section>
    <section class="clients">
        <div class="container">
            <h2 class="clients_title">Список клиентов</h2>
            <button onclick="MicroModal.show('add-modal')" class="clients_add">
                <i class="fa fa-plus-circle" aria-hidden="true"></i>
            </button>
            <table>
                <thead>
                    <th>ID</th>
                    <th>ФИО</th>
                    <th>Почта</th>
                    <th>Телефон</th>
                    <th>День рождения</th>
                    <th>День создания</th>
                    <th>История заказов</th>
                    <th>Редактировать</th>
                    <th>Удалить</th>
                </thead>
                <tbody>
                   <tr> <td>0</td>
                    <td>Карпенко Татьяна Сергеевна</td>
                    <td>teenkan3123@gmail.com</td>
                    <td>+79831309910</td>
                    <td>16.11.2003</td>
                    <td>02.02.2003</td>
                    <td><i class="fa fa-bars" aria-hidden="true" onclick="MicroModal.show('history-modal')"></i></td>
                    <td><i class="fa fa-pencil-square-o" aria-hidden="true" onclick="MicroModal.show('edit-modal')"></i></td>
                    <td><i class="fa fa-trash-o" aria-hidden="true" onclick="MicroModal.show('delete-modal')"></i></td>
                  </tr>
                  <tr> <td>1</td>
                    <td>Карпенко Татьяна Сергеевна</td>
                    <td>teenkan3123@gmail.com</td>
                    <td>+79831309910</td>
                    <td>16.11.2003</td>
                    <td>02.02.2003</td>
                    <td><i class="fa fa-bars" aria-hidden="true" onclick="MicroModal.show('history-modal')" ></i></td>
                    <td><i class="fa fa-pencil-square-o" aria-hidden="true" onclick="MicroModal.show('edit-modal')"></i></td>
                    <td ><i class="fa fa-trash-o" aria-hidden="true" onclick="MicroModal.show('delete-modal')"></i></td>
                  </tr>
                  <tr> <td>2</td>
                    <td>Карпенко Татьяна Сергеевна</td>
                    <td>teenkan3123@gmail.com</td>
                    <td>+79831309910</td>
                    <td>16.11.2003</td>
                    <td>02.02.2003</td>
                    <td><i class="fa fa-bars" aria-hidden="true" onclick="MicroModal.show('history-modal')"></i></td>
                    <td><i class="fa fa-pencil-square-o" aria-hidden="true" onclick="MicroModal.show('edit-modal')"></i></td>
                    <td><i class="fa fa-trash-o" aria-hidden="true" onclick="MicroModal.show('delete-modal')"></i></td>
                  </tr>
                  <tr> <td>3</td>
                    <td>Карпенко Татьяна Сергеевна</td>
                    <td>teenkan3123@gmail.com</td>
                    <td>+79831309910</td>
                    <td>16.11.2003</td>
                    <td>02.02.2003</td>
                    <td><i class="fa fa-bars" aria-hidden="true" onclick="MicroModal.show('history-modal')"></i></td>
                    <td><i class="fa fa-pencil-square-o" aria-hidden="true" onclick="MicroModal.show('edit-modal')"></i></td>
                    <td><i class="fa fa-trash-o" aria-hidden="true" onclick="MicroModal.show('delete-modal')"></i></td>
                  </tr>
                  <tr> <td>4</td>
                    <td>Карпенко Татьяна Сергеевна</td>
                    <td>teenkan3123@gmail.com</td>
                    <td>+79831309910</td>
                    <td>16.11.2003</td>
                    <td>02.02.2003</td>
                    <td><i class="fa fa-bars" aria-hidden="true" onclick="MicroModal.show('history-modal')"></i></td>
                    <td><i class="fa fa-pencil-square-o" aria-hidden="true" onclick="MicroModal.show('edit-modal')"></i></td>
                    <td><i class="fa fa-trash-o" aria-hidden="true" onclick="MicroModal.show('delete-modal')"></i></td>
                  </tr>
                  <tr> <td>5</td>
                    <td>Карпенко Татьяна Сергеевна</td>
                    <td>teenkan3123@gmail.com</td>
                    <td>+79831309910</td>
                    <td>16.11.2003</td>
                    <td>02.02.2003</td>
                    <td><i class="fa fa-bars" aria-hidden="true" onclick="MicroModal.show('history-modal')"></i></td>
                    <td><i class="fa fa-pencil-square-o" aria-hidden="true" onclick="MicroModal.show('edit-modal')"></i></td>
                    <td><i class="fa fa-trash-o" aria-hidden="true" onclick="MicroModal.show('delete-modal')"></i></td>
                  </tr>
                  <tr> <td>6</td>
                    <td>Карпенко Татьяна Сергеевна</td>
                    <td>teenkan3123@gmail.com</td>
                    <td>+79831309910</td>
                    <td>16.11.2003</td>
                    <td>02.02.2003</td>
                    <td><i class="fa fa-bars" aria-hidden="true" onclick="MicroModal.show('history-modal')"></i></td>
                    <td><i class="fa fa-pencil-square-o" aria-hidden="true" onclick="MicroModal.show('edit-modal')"></i></td>
                    <td><i class="fa fa-trash-o" aria-hidden="true" onclick="MicroModal.show('delete-modal')"></i></td>
                  </tr>
                  <tr> <td>7</td>
                    <td>Карпенко Татьяна Сергеевна</td>
                    <td>teenkan3123@gmail.com</td>
                    <td>+79831309910</td>
                    <td>16.11.2003</td>
                    <td>02.02.2003</td>
                    <td><i class="fa fa-bars" aria-hidden="true" onclick="MicroModal.show('history-modal')"></i></td>
                    <td><i class="fa fa-pencil-square-o" aria-hidden="true" onclick="MicroModal.show('edit-modal')"></i></td>
                    <td><i class="fa fa-trash-o" aria-hidden="true" onclick="MicroModal.show('delete-modal')"></i></td>
                  </tr>
                  <tr> <td>8</td>
                    <td>Карпенко Татьяна Сергеевна</td>
                    <td>teenkan3123@gmail.com</td>
                    <td>+79831309910</td>
                    <td>16.11.2003</td>
                    <td>02.02.2003</td>
                    <td><i class="fa fa-bars" aria-hidden="true" onclick="MicroModal.show('history-modal')"></i></td>
                    <td><i class="fa fa-pencil-square-o" aria-hidden="true" onclick="MicroModal.show('edit-modal')"></i></td>
                    <td><i class="fa fa-trash-o" aria-hidden="true" onclick="MicroModal.show('delete-modal')"></i></td>
                  </tr>
                  <tr> <td>9</td>
                    <td>Карпенко Татьяна Сергеевна</td>
                    <td>teenkan3123@gmail.com</td>
                    <td>+79831309910</td>
                    <td>16.11.2003</td>
                    <td>02.02.2003</td>
                    <td><i class="fa fa-bars" aria-hidden="true" onclick="MicroModal.show('history-modal')"></i></td>
                    <td><i class="fa fa-pencil-square-o" aria-hidden="true" onclick="MicroModal.show('edit-modal')"></i></td>
                    <td><i class="fa fa-trash-o" aria-hidden="true" onclick="MicroModal.show('delete-modal')"></i></td>
                  </tr>
                  <tr> <td>10</td>
                    <td>Карпенко Татьяна Сергеевна</td>
                    <td>teenkan3123@gmail.com</td>
                    <td>+79831309910</td>
                    <td>16.11.2003</td>
                    <td>02.02.2003</td>
                    <td><i class="fa fa-bars" aria-hidden="true" onclick="MicroModal.show('history-modal')"></i></td>
                    <td><i class="fa fa-pencil-square-o" aria-hidden="true" onclick="MicroModal.show('edit-modal')"></i></td>
                    <td><i class="fa fa-trash-o" aria-hidden="true" onclick="MicroModal.show('delete-modal')"></i></td>
                  </tr>
                </tbody>
            </table>
        </div>
    </section>
</main>

<div class="modal micromodal-slide" id="add-modal" aria-hidden="true">
  <div class="modal__overlay" tabindex="-1" data-micromodal-close>
    <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
      <header class="modal__header">
        <h2 class="modal__title" id="modal-1-title">
          Добавить клиента
        </h2>
        <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
      </header>
      <main class="modal__content" id="modal-1-content">
        <form id="client-form">
          <div class="form-group">
            <label for="full-name">ФИО</label>
            <input type="text" id="full-name" name="full-name" required placeholder="Введите ваше ФИО">
          </div>
          <div class="form-group">
            <label for="email">Почта</label>
            <input type="email" id="email" name="email" required placeholder="Введите вашу почту">
          </div>
          <div class="form-group">
            <label for="phone">Телефон</label>
            <input type="tel" id="phone" name="phone" required placeholder="Введите ваш телефон">
          </div>
          <div class="form-actions">
            <button type="submit" class="btn-create">Создать</button>
            <button type="button" class="btn-cancel" data-micromodal-close>Отменить</button>
          </div>
        </form>
      </main>
    </div>
  </div>
</div>

<div class="modal micromodal-slide" id="delete-modal" aria-hidden="true">
  <div class="modal__overlay" tabindex="-1" data-micromodal-close>
    <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
      <header class="modal__header">
        <h2 class="modal__title" id="modal-1-title">
          Удалить клиента
        </h2>
        <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
      </header>
      <main class="modal__content" id="modal-1-content">
        <button>Удалить</button>
        <button onclick="MicroModal.close('delete-modal');" > Отменить</button>
      </main>
    </div>
  </div>
</div>

<div class="modal micromodal-slide" id="edit-modal" aria-hidden="true">
  <div class="modal__overlay" tabindex="-1" data-micromodal-close>
    <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
      <header class="modal__header">
        <h2 class="modal__title" id="modal-1-title">
          Редактировать клиента
        </h2>
        <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
      </header>
      <main class="modal__content" id="modal-1-content">
        <form id="client-form">
          <div class="form-group">
            <label for="full-name">ФИО</label>
            <input type="text" id="full-name" name="full-name" required placeholder="Введите ваше ФИО">
          </div>
          <div class="form-group">
            <label for="email">Почта</label>
            <input type="email" id="email" name="email" required placeholder="Введите вашу почту">
          </div>
          <div class="form-group">
            <label for="phone">Телефон</label>
            <input type="tel" id="phone" name="phone" required placeholder="Введите ваш телефон">
          </div>
          <div class="form-actions">
            <button type="submit" class="btn-create">Создать</button>
            <button type="button" class="btn-cancel" data-micromodal-close>Отменить</button>
          </div>
        </form>
      </main>
    </div>
  </div>
</div>

<div class="modal micromodal-slide" id="history-modal" aria-hidden="true">
  <div class="modal__overlay" tabindex="-1" data-micromodal-close>
    <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
      <header class="modal__header">
        <!-- Change -->
        <h2 class="modal__title" id="modal-1-title">
        История заказов
        </h2>
        <!-- Change -->
        <small>Фамилия Имя Отчество</small>
        <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
      </header>
      <main class="modal__content" id="modal-1-content">
        <div class="order">
          <div class="order_info">
              <h3 class="order_number">Заказ №1</h3>
              <time class="order_date">Дата оформления : 2025-01-13  09:25:37</time>
              <p class="order_total"> Общая сумма : 300.00</p>
          </div>
          <table class="order_items">
            <tr>
              <th>ID</th>
              <th>Название товара</th>
              <th>Количество</th>
              <th>Цена</th>
            </tr>
            <tr>
              <td>9s13</td>
              <td>Футболка</td>
              <td>10</td>
              <td>10000</td>
            </tr>
          </table>
        </div>
        </div>
      </main>
    </div>
  </div>
</div>

<script defer 
   src="https://unpkg.com/micromodal/dist/micromodal.min.js">
  </script>

  <script defer src="scripts/initClientsModal.js"> </script>
</body>
</html>