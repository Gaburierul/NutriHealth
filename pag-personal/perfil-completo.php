<?php
session_start();
$idPro = $_SESSION['idPro'] ?? null;
require_once __DIR__ . '/../conexaoBD/conexao.php';

header('Content-Type: application/json; charset=utf-8');

if (!$idPro) {
    echo json_encode(['erro' => 'Usuário não logado']);
    exit;
}

/* ==========================================================
   1) SE FOR POST → ATUALIZAR DADOS
   ========================================================== */
   if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $input = json_decode(file_get_contents("php://input"), true);

    if (!$input) {
        echo json_encode(['erro' => 'Nenhum dado enviado']);
        exit;
    }

    /* ---------- UPDATE PROFISSIONAL ---------- */
    $sqlP = "UPDATE profissional SET 
                nomeComple = ?, 
                email = ?, 
                telefone = ?, 
                CPF = ?, 
                CRN = ?
             WHERE idPro = ?";

    $stmtP = $conn->prepare($sqlP);
    $stmtP->bind_param(
        "sssssi",
        $input['nome'],
        $input['email'],
        $input['telefone'],
        $input['cpf'],
        $input['crn'],
        $idPro
    );
    $stmtP->execute();
    $stmtP->close();


    /* ---------- UPDATE OU INSERT EMPRESA ---------- */

    $check = $conn->prepare("SELECT idPro FROM empresa WHERE idPro = ?");
    $check->bind_param("i", $idPro);
    $check->execute();
    $existeEmpresa = $check->get_result()->num_rows > 0;
    $check->close();

    if ($existeEmpresa) {

        $sqlEmp = "UPDATE empresa SET
            TipoAtendimento = ?,
            NomeLocal = ?,
            Endereco = ?,
            TelefoneLocal = ?,
            Cidade = ?,
            Estado = ?,
            CEP = ?,
            CNPJ = ?
        WHERE idPro = ?";

        $stmt2 = $conn->prepare($sqlEmp);
        $stmt2->bind_param(
            "ssssssssi",
            $input['tipoAtendimento'],
            $input['nomeLocal'],
            $input['endereco'],
            $input['telefoneLocal'],
            $input['cidade'],
            $input['estado'],
            $input['cep'],
            $input['cnpj'],
            $idPro
        );
        $stmt2->execute();
        $stmt2->close();

    } else {

        $sqlInsert = "INSERT INTO empresa 
            (idPro, TipoAtendimento, NomeLocal, Endereco, TelefoneLocal, Cidade, Estado, CEP, CNPJ)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt3 = $conn->prepare($sqlInsert);
        $stmt3->bind_param(
            "issssssss",
            $idPro,
            $input['tipoAtendimento'],
            $input['nomeLocal'],
            $input['endereco'],
            $input['telefoneLocal'],
            $input['cidade'],
            $input['estado'],
            $input['cep'],
            $input['cnpj']
        );
        $stmt3->execute();
        $stmt3->close();
    }

    echo json_encode(['sucesso' => true]);
    exit;
}


/* ==========================================================
   2) SE FOR GET → RETORNAR DADOS DO PERFIL
   ========================================================== */

$sql = "SELECT 
            p.nomeComple,
            p.email,
            p.telefone,
            p.CPF,
            p.CRN,
            p.cargo,
            p.imagem,
            e.TipoAtendimento,
            e.NomeLocal,
            e.Endereco,
            e.TelefoneLocal,
            e.Cidade,
            e.Estado,
            e.CEP,
            e.CNPJ
        FROM profissional p
        LEFT JOIN empresa e ON p.idPro = e.idPro
        WHERE p.idPro = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idPro);
$stmt->execute();
$result = $stmt->get_result();
$dados = $result->fetch_assoc();
$stmt->close();

if (!$dados) {
    echo json_encode(['erro' => 'Profissional não encontrado']);
    exit;
}

/* Foto */
$imagem = null;
if (!empty($dados['imagem'])) {
    $imagem = 'data:image/jpeg;base64,' . base64_encode($dados['imagem']);
}

/* Retorno final */
echo json_encode([
    'perfil' => [
        'nome'      => $dados['nomeComple'],
        'email'     => $dados['email'],
        'telefone'  => $dados['telefone'],
        'cpf'       => $dados['CPF'],
        'crn'       => $dados['CRN'],
        'cargo'     => $dados['cargo'],
        'imagem'    => $imagem,
    ],
    'empresa' => [
        'tipoAtendimento' => $dados['TipoAtendimento'],
        'nomeLocal'       => $dados['NomeLocal'],
        'endereco'        => $dados['Endereco'],
        'telefoneLocal'   => $dados['TelefoneLocal'],
        'cidade'          => $dados['Cidade'],
        'estado'          => $dados['Estado'],
        'cep'             => $dados['CEP'],
        'cnpj'            => $dados['CNPJ']
    ]
]);
