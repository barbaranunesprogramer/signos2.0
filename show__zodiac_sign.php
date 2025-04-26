<?php
include('header.php');

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recebe a data de nascimento do formulário
    $data_nascimento = $_POST['data_nascimento'];

    // Carrega o arquivo XML contendo os signos
    $signos = simplexml_load_file("signos.xml");

    if ($signos === false) {
        die('Erro ao carregar o arquivo XML');
    }

    // Converte a data de nascimento para o formato d/m
    $data_nascimento_obj = DateTime::createFromFormat('Y-m-d', $data_nascimento);
    $data_nascimento_formatada = $data_nascimento_obj->format('d/m');

    // A data de nascimento será comparada com as datas dos signos
    foreach ($signos->signo as $signo) {
        // Converte as datas de início e fim para o formato d/m
        $data_inicio = DateTime::createFromFormat('d/m', (string) $signo->dataInicio);
        $data_fim = DateTime::createFromFormat('d/m', (string) $signo->dataFim);

        // Formata as datas de início e fim para comparação (apenas dia e mês)
        $data_inicio_formatada = $data_inicio->format('d/m');
        $data_fim_formatada = $data_fim->format('d/m');

        // Verifica se a data de nascimento está dentro do intervalo
        if (($data_nascimento_formatada >= $data_inicio_formatada) && ($data_nascimento_formatada <= $data_fim_formatada)) {
            echo "Seu signo é: " . $signo->signoNome;
            break;
        }
    }
} else {
    echo "Por favor, envie a data de nascimento.";
}
?>