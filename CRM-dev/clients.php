<?php session_start();

if (isset($_GET['do']) && $_GET['do'] === 'logout') {
    require_once 'api/auth/LogoutUser.php';
    require_once 'api/DB.php';

    LogoutUser('login.php', $DB, $_SESSION['token']);

    exit;
}

require_once 'api/auth/AuthCheck.php';

AuthCheck('', 'login.php');

require_once 'api/helpers/InputDefaultValue.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/settings.css">
    <link rel="stylesheet" href="styles/pages/clients.css">
    <link rel="stylesheet" href="styles/modules/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles/modules/micromodal.css">
    <title>CRM | Клиенты</title>
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
                <li><a href="clients.php">Клиенты</a></li>
                <li><a href="product.php">Товары</a></li>
                <li><a href="orders.php">Заказы</a></li>
            </ul>
            <a href="?do=logout" class="header__logout">Выйти</a>
        </div>
    </header>
    <main class="main">
        <section class="main__filters">
            <div class="container">
                <form action="" method="GET" class="main__form">
                    <select class="main__select" name="search_name" id="search_name">
                        <option value="name" <?php echo ($_GET['search_name'] ?? '') === 'name' ? 'selected' : ''; ?>>Поиск по имени</option>
                        <option value="email" <?php echo ($_GET['search_name'] ?? '') === 'email' ? 'selected' : ''; ?>>Поиск по почте</option>
                    </select>
                    <input <?php InputDefaultValue('search', ''); ?> class="main__input" type="text" id="search" name="search" placeholder="Александр">
                    <select class="main__select" name="sort" id="sort">
                        <option value="0" <?php echo ($_GET['sort'] ?? '') === '0' ? 'selected' : ''; ?>>По умолчанию</option>
                        <option value="1" <?php echo ($_GET['sort'] ?? '') === '1' ? 'selected' : ''; ?>>По возрастанию</option>
                        <option value="2" <?php echo ($_GET['sort'] ?? '') === '2' ? 'selected' : ''; ?>>По убыванию</option>
                    </select>
                    <button type="submit">Поиск</button>
                    <a href="?" class="main__reset">Сбросить</a>
                </form>
            </div>
        </section>
        <section class="main__clients">
            <div class="container">
                <h2 class="main__clients__title">Список клиентов</h2>
                <button class="main__clients__add" onclick="MicroModal.show('add-modal')"><i class="fa fa-plus-circle"></i></button>
                <?php
                    $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                    $maxClients = 5;

                    $countClients = $DB->query("
                    SELECT COUNT(*) as count FROM clients")
                    ->fetchAll()[0]['count'];

                    $maxPage = ceil($countClients / $maxClients);
                    $minPage = 1;

                    //2. попровать баг с перезаписью параметров поиска при перелистывании страниц

                    // нормализация currentPage
                    if ($currentPage < $minPage || !is_numeric($currentPage)) {
                        $currentPage = $minPage;
                        header("Location: ?page=$currentPage");
                        exit;
                    }
                    if ($currentPage > $maxPage) {
                        $currentPage = $maxPage;
                        header("Location: ?page=$currentPage");
                        exit;
                    }

                    echo "<div class='pagination'>";
                    // echo "<p class='pagination__info'>$currentPage / $maxPage</p>";

                    // Сохраняем параметры поиска и сортировки
                    $searchParams = [];
                    if (isset($_GET['search_name'])) $searchParams[] = "search_name=" . urlencode($_GET['search_name']);
                    if (isset($_GET['search'])) $searchParams[] = "search=" . urlencode($_GET['search']);
                    if (isset($_GET['sort'])) $searchParams[] = "sort=" . urlencode($_GET['sort']);
                    $queryString = implode('&', $searchParams);
                    $queryString = $queryString ? '&' . $queryString : '';

                    // Кнопка назад
                    $prev = max(1, $currentPage - 1);
                    $prevDisabled = $currentPage <= 1 ? 'disabled' : '';
                    echo "<a href='?page=$prev$queryString' class='pagination__btn $prevDisabled'><i class='fa fa-arrow-left' aria-hidden='true'></i></a>";

                    echo "<div class='pagination__numbers'>";
                    for ($i = 1; $i <= $maxPage; $i++) {
                        $activeClass = $i === $currentPage ? 'active' : '';
                        echo "<a href='?page=$i$queryString' class='pagination__number $activeClass'>$i</a>";
                    }
                    echo "</div>";

                    // Кнопка вперед
                    $next = min($maxPage, $currentPage + 1);
                    $nextDisabled = $currentPage >= $maxPage ? 'disabled' : '';
                    echo "<a href='?page=$next$queryString' class='pagination__btn $nextDisabled'><i class='fa fa-arrow-right' aria-hidden='true'></i></a>";
                    echo "</div>";
                ?>
                <table>
                    <thead>
                        <th>ИД</th>
                        <th>ФИО</th>
                        <th>Почта</th>
                        <th>Телефон</th>
                        <th>День рождения</th>
                        <th>Дата создания</th>
                        <th>История заказов</th>
                        <th>Редактировать</th>
                        <th>Удалить</th>
                    </thead>
                    <tbody>
                        <?php
                            require 'api/DB.php';
                            require_once('api/clients/OutputClients.php');
                            require_once('api/clients/ClientsSearch.php');

                            $clients = ClientsSearch($_GET, $DB);
                        
                            OutputClients($clients);

                        ?>
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
                <form action="api/clients/AddClients.php" method="POST" class="modal__form">
                    <div class="modal__form-group">
                        <label for="fullname">ФИО</label>
                        <input type="text" id="fullname" name="fullname">
                    </div>
                    <div class="modal__form-group">
                        <label for="email">Почта</label>
                        <input type="email" id="email" name="email">
                    </div>
                    <div class="modal__form-group">
                        <label for="phone">Телефон</label>
                        <input type="tel" id="phone" name="phone">
                    </div>
                    <div class="modal__form-group">
                        <label for="birthday">День рождения</label>
                        <input type="date" id="birthday" name="birthday">
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
                Вы уверены, что хотите удалить клиента?
              </h2>
              <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
            </header>
            <main class="modal__content" id="modal-1-content">
                <button class="modal__btn danger">Удалить</button>
                <button class="modal__btn" data-micromodal-close>Отменить</button>
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
                <form class="modal__form">
                    <div class="modal__form-group">
                        <label for="fullname">ФИО</label>
                        <input type="text" id="fullname" name="fullname">
                    </div>
                    <div class="modal__form-group">
                        <label for="email">Почта</label>
                        <input type="email" id="email" name="email">
                    </div>
                    <div class="modal__form-group">
                        <label for="phone">Телефон</label>
                        <input type="tel" id="phone" name="phone">
                    </div>
                    <div class="modal__form-actions">
                        <button type="submit" class="modal__btn">Сохранить</button>
                        <button type="button" class="modal__btn" data-micromodal-close>Отменить</button>
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
                    <h2 class="modal__title" id="modal-1-title">
                        История покупок
                    </h2>
                    <small>Фамилия Имя Отчество</small>
                    <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
                </header>
                <main class="modal__content" id="modal-1-content">
                    <table class="history-table">
                        <thead>
                            <tr>
                                <th>ID заказа</th>
                                <th>Товар</th>
                                <th>Количество</th>
                                <th>Цена</th>
                                <th>Дата</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Товар 1</td>
                                <td>2</td>
                                <td>1000₽</td>
                                <td>12.01.2024</td>
                            </tr>
                        </tbody>
                    </table>
                </main>
            </div>
        </div>
    </div>

<!-- 
    1. Продублируйте модальное окно с ошибкой
    2. Поменяйте $_SESSION -> $_GET (в данном случае, $_GET уже используется)
    3. Поменяйте clients-errors -> send-email
    4. id на send-email-modal
    5. В main добавьте только вывод почты
-->

<!-- Первое модальное окно -->
<div class="modal micromodal-slide
    <?php
    if (isset($_GET['send-email']) && !empty($_GET['send-email'])) {
        echo 'open';
    }
    ?>
" id="send-email-modal" aria-hidden="true">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
        <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
            <header class="modal__header">
                <h2 class="modal__title" id="modal-1-title">
                    Ошибка!
                </h2>   
                <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
            </header>
            <main class="modal__content" id="modal-1-content">
            <?php
            if (isset($_GET['send-email']) && !empty($_GET['send-email'])) {
                echo $_GET['send-email'];
            }
            ?>
            </main>
        </div>
    </div>
</div>

<!-- Второе модальное окно (дубликат) -->
<div class="modal micromodal-slide
    <?php
    if (isset($_GET['send-email']) && !empty($_GET['send-email'])) {
        echo 'open';
    }
    ?>
" id="send-email-modal-2" aria-hidden="true">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
        <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-2-title">
            <header class="modal__header">
                <h2 class="modal__title" id="modal-2-title">
                    Ошибка!
                </h2>   
                <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
            </header>
            <main class="modal__content" id="modal-2-content">
            <?php
            if (isset($_GET['send-email']) && !empty($_GET['send-email'])) {
                echo $_GET['send-email'];
            }
            ?>
            </main>
        </div>
    </div>
</div>

<!-- Основной контент для вывода почты -->
<main>
    <?php
    if (isset($_GET['send-email']) && !empty($_GET['send-email'])) {
        echo "Почта: " . $_GET['send-email'];
    }
    ?>
</main>

<!-- JavaScript для автоматического закрытия модальных окон -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modals = document.querySelectorAll('.modal');
        
        modals.forEach(modal => {
            if (modal.classList.contains('open')) {
                setTimeout(() => {
                    modal.classList.remove('open');
                }, 3000); // Закрывает окно через 3 секунды
            }
        });
    });
</script>


<!-- Основной контент для вывода почты -->
<main>
    <?php
    if (isset($_GET['send-email']) && !empty($_GET['send-email'])) {
        echo "
        <form method='POST' action='api/clients/SendEmail.php?email=$email' id='registration-form>
           <label for='header'> Обращение: </label>
           <input type='text' id='header' name='header'>
           
           <label for='header'> Тело сообщения: </label>
           <textarea name='main' id='main'></textarea>
           
           <label for='header'> Футер: </label>
           <input type='text' id='footer' name='footer'>

           <button class='create' type='submit'> Отправить </button>
           <button data-micromodal-close onclick='Micromodal.close('send-email-modal')' class='cancel' type= 'button'>
               Отмена
           </button>
           </form>
           ";

        /** 
        *  
        *  Форма с полями:
        *  Текстовое поле для ввода обращения(input, name - header)
        *  Текстовое поле для ввода основного контента(textarea name - main)
        *  Текстовое поле для ввода  футера (textarea name - footer)
        *  Кнопка отправки формы
        *
        */
    }
    ?>
</main>


    <script defer src="https://unpkg.com/micromodal/dist/micromodal.min.js"></script>
    <script defer src="scripts/initClientsModal.js"></script>
</body>
</html>