<?php
include('header.php');

$data_nascimento = DateTime::createFromFormat('Y-m-d', $_POST['data_nascimento']);
if (!$data_nascimento) {
    echo ("<p> Data inválida</p> <a href='index.php'>Voltar</a>");
    exit;
}

$signos = simplexml_load_file('signos.xml');

function verificar_signo($data, $inicio, $fim)
{
    $ano = $data->format('Y');
    $data_inicio = DateTime::createFromFormat('d/m/Y', "$inicio/$ano");
    $data_fim = DateTime::createFromFormat('d/m/Y', "$fim/$ano");

    if (!$data_inicio || !$data_fim) {
        return false;
    }

    if ($data_inicio > $data_fim) {
        if ($data->format('m') == '01') {
            $data_inicio->modify('-1 year');
        } else {
            $data_fim->modify('+1 year');
        }
    }

    return ($data >= $data_inicio && $data <= $data_fim);
}

$signo_encontrado = null;
foreach ($signos as $signo) {
    if (verificar_signo($data_nascimento, $signo->dataInicio, $signo->dataFim)) {
        $signo_encontrado = $signo;
        break;
    }
}
?>

<body>
    <div class="container-fluid main-container mt-4 d-flex align-items-center justify-content-center"
        style="min-height: 80vh;">
        <div class="content-wrapper text-center p-5"
            style="background-color: white; border-radius: 15px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); max-width: 500px; color: black;">

            <?php if ($signo_encontrado): ?>
                <h1 class="mb-4" style="color: #C8A2C8;">Seu signo é: <?= $signo_encontrado->signoNome ?></h1>
                <p class="mb-5"><?= $signo_encontrado->descricao ?></p>
            <?php else: ?>
                <p class="mb-5" style="color: red;">Data inválida! Não foi possível encontrar um signo correspondente.</p>
            <?php endif; ?>

            <a href='index.php' class="btn btn-secondary">Voltar</a>
        </div>
    </div>
</body>