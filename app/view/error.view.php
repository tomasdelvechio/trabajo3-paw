<!doctype html>
<html lang="s">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Resumen del turno</title>
</head>
<body>
<header>
    <?php include 'view/nav.view.php'; ?>
</header>
<main>
    <h1>No se registró el turno</h1>
    <ul>
        <?php foreach ($respuesta as $valor) :?>
            <li><?= $valor ?></li>
        <?php endforeach ?>
    </ul>
</main>
</body>
</html>