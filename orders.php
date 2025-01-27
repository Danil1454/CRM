<?php session_start();

if (isset($_GET['do']) && $_GET['do'] === 'logout') {
    require_once 'api/auth/LogoutUser.php';
    require_once 'api/DB.php';

    LogoutUser('login.php', $DB, $_SESSION['token']);

    exit;
}

require_once 'api/auth/AuthCheck.php';

AuthCheck('', 'login.php');

?>

<!-- 

2. Отображение клиентов
3. Удаление клиентов
4. Редактирование клиентов
5. История покупок клиента
6. Фильтрация / сортировка клиентов

-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/settings.css">
    <link rel="stylesheet" href="styles/pages/orders.css">
    <link rel="stylesheet" href="styles/modules/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles/modules/MicroModul.css">
    <title>CRM | Заказы</title>
</head>
<body>
    <header class="header">
        <div class="container">
            <p class="header__admin">
                <?php 
                    require 'api/DB.php';
                    require_once 'api/clients/AdminName.php';

                    echo AdminName($_SESSION['token'], $DB);
                ?>
            </p>
            <ul class="header__links">
                <li><a href="clients.html">Клиенты</a></li>
                <li><a href="product.html">Товары</a></li>
                <li><a href="#">Заказы</a></li>
            </ul>
            <a href="?do=logout" class="header__logout">Выйти</a>
        </div>
    </header>
    <main class="main">
        <section class="main__filters">
            <div class="container">
                <form action="" class="main__form">
                    <label class="main__label" for="search">Поиск по названию</label>
                    <input class="main__input" type="text" id="search" name="search" placeholder="Александр">
                    <select class="main__select" name="sort" id="sort">
                        <option value="0">По возрастанию</option>
                        <option value="1">По убыванию</option>
                    </select>
                </form>
            </div>
        </section>
        <section class="main__clients">
            <div class="container">
                <h2 class="main__clients__title">Список Заказов</h2>
                <button class="main__clients__add" onclick="MicroModal.show('add-modal')"><i class="fa fa-plus-circle"></i></button>
                <table>
                    <thead>
                        <th>ID</th>
                        <th>ФИО Клиента</th>
                        <th>Дата Заказа</th>
                        <th>Цена</th>
                        <th>Редактировать</th>
                        <th>Удалить</th>
                        <th>Генерация чека</th>
                        <th>Подробнее</th>
                    </thead>
                    <tbody>
                    <tr>
                <td>$id</td>
                <td>Александр Александр Александрович</td>
                <td>12.01.2000</td>
                <td>125</td>
                <td onclick="MicroModal.show('edit-modal')"><i class='fa fa-pencil'></i></td>
                <td onclick="MicroModal.show('delete-modal')"><i class='fa fa-trash'></i></td>
                <td onclick="MicroModal.show('receipt-modal')"><i class='fa fa-check-square'></i></td>
                <td onclick="MicroModal.show('product-info-modal')"><i class='fa fa-file-code-o'></i></td>
                
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
                <form class="modal__form">
                    <div class="modal__form-group">
                        <label for="fullname">ФИО</label>
                        <input type="text" id="fullname" name="fullname" required>
                    </div>
                    <div class="modal__form-group">
                        <label for="email">Почта</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="modal__form-group">
                        <label for="phone">Телефон</label>
                        <input type="tel" id="phone" name="phone" required>
                    </div>
                    <div class="modal__form-group">
                        <label for="birthday">День рождения</label>
                        <input type="date" id="birthday" name="birthday" required>
                    </div>
                    <div class="modal__form-actions">
                        <button type="submit" class="modal__btn modal__btn-primary">Создать</button>
                        <button type="button" class="modal__btn modal__btn-secondary" data-micromodal-close>Отменить</button>
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
                Вы уверены, что хотите удалить заказ?
              </h2>
              <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
            </header>
            <main class="modal__content" id="modal-1-content">
                <button>Удалить</button>
                <button onclick="MicroModal.close('delete-modal')">Отменить</button>
            </main>
          </div>
        </div>
      </div>
      <div class="modal micromodal-slide" id="edit-modal" aria-hidden="true">
        <div class="modal__overlay" tabindex="-1" data-micromodal-close>
          <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
            <header class="modal__header">
              <h2 class="modal__title" id="modal-1-title">
                Редактировать заказ
              </h2>
              <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
            </header>
            <main class="modal__content" id="modal-1-content">
                <form class="modal__form">
                    <div class="modal__form-group">
                        <label for="fullname">ФИО</label>
                        <input type="text" id="fullname" name="fullname" required>
                    </div>
                    <div class="modal__form-group">
                        <label for="email">Дата заказа</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="modal__form-group">
                        <label for="phone">Цена</label>
                        <input type="tel" id="phone" name="phone" required>
                    </div>
                    <div class="modal__form-actions">
                        <button type="submit" class="modal__btn modal__btn-primary">Редактировать</button>
                        <button type="button" class="modal__btn modal__btn-secondary" data-micromodal-close>Отменить</button>
                    </div>
                </form>
            </main>
          </div>
        </div>
      </div>


      <div class="modal micromodal-slide" id="product-info-modal" aria-hidden="true">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
        <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-product-title">
            <header class="modal__header">
                <h2 class="modal__title" id="modal-product-title">
                    Информация о товаре
                </h2>
                <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
            </header>
            <main class="modal__content" id="modal-product-content">
                <div class="product-info">
                    <img src="path/to/product-image.jpg" alt="Наименование товара" class="product-image">
                    <h3>Наименование товара</h3>
                    <p><strong>Описание:</strong> Краткое описание товара, включая его особенности и преимущества.</p>
                    <p><strong>Цена:</strong> 500₽</p>
                    <p><strong>Количество на складе:</strong> 20 шт.</p>
                </div>
            </main>
        </div>
    </div>
</div>


    <div class="modal micromodal-slide" id="receipt-modal" aria-hidden="true">
        <div class="modal__overlay" tabindex="-1" data-micromodal-close>
           <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-receipt-title">
            <header class="modal__header">
                <h2 class="modal__title" id="modal-receipt-title">
                    Чек
                </h2>
                <small>Фамилия Имя Отчество</small>
                <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
            </header>
            <main class="modal__content" id="modal-receipt-content">
                <table class="receipt-table">
                    <thead>
                        <tr>
                            <th>Наименование товара</th>
                            <th>Количество</th>
                            <th>Цена за единицу</th>
                            <th>Итого</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Товар 1</td>
                            <td>2</td>
                            <td>500₽</td>
                            <td>1000₽</td>
                        </tr>
                        <tr>
                            <td>Товар 2</td>
                            <td>1</td>
                            <td>500₽</td>
                            <td>500₽</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3">Общая сумма:</td>
                            <td>1500₽</td>
                        </tr>
                    </tfoot>
                </table>
            </main>
        </div>
    </div>
</div>

    </div>
    <script defer src="https://unpkg.com/micromodal/dist/micromodal.min.js"></script>
    <script defer src="scripts/initClientsModal.js"></script>
</body>
</html>