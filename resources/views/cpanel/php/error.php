<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensajes de Error</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link href="..css/estilos.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</head>
<body>
    <div class="centrado">
        <div class="card text-bg-dark mb-3" style="max-width: 18rem;">
            <div class="card-header">Presentamos un error</div>
            <div class="card-body">
                <?php
                    if(isset($_GET["mensaje"]))
                    {
                        $mensaje = $_GET["mensaje"];
                        echo "<p class='alert alert-info'>$mensjae</p>";
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>