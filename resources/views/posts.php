<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Urbancounters</title>

    <!-- CSS -->
    <link href="css\style.css" rel="stylesheet" type="text/css" />
</head>


<html lang="en">
    <body>

        <ul class="rolldown-list" id="myList">
                <?php
                    $response = (new App\Http\Controllers\MenusController())->getMenuByWebsiteId(3);

                    $menus = $response['content'];

                    foreach ($menus->menuItems as $post) {
                        echo '<li>'.$post['title'].'</li>';
                    }
                ?>
        </ul>
    </body>

    <!-- Javascript -->
    <script src="js\list.js"></script>
</html>
