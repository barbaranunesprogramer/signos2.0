<?php include('header.php'); ?>

<body>
    <h1>Signos do Zodiaco</h1>
    <p>Aqui descobriremos seu signo apartir da sua data de nascimento </p>
    <div class="container mt-5">
        <h2 class="mb-4">Informe sua data de nascimento</h2>

        <form action="show__zodiac_sign.php" method="POST">
            <div class="mb-3">
                <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" required>
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>
</body>

</html>