<?php
// pag-menu/processa_login.php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

// ajuste o include conforme sua estrutura — pelo que você mostrou antes:
require_once __DIR__ . '/../conexaoBD/conexao.php'; // $conn é mysqli

function limpar($v){
    return htmlspecialchars(trim((string)$v), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Acesso inválido.");
}

// Recebe e valida
$email = limpar($_POST['email'] ?? '');
$senha = $_POST['senha'] ?? '';
$cargoForm = limpar($_POST['cargo'] ?? ''); // valor vindo do select

if (!$email || !$senha || !$cargoForm) {
    // você pode trocar por um redirect com mensagem ou JSON conforme a sua UX
    die("Preencha todos os campos.");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Email inválido.");
}

// Busca profissional
$sql = "SELECT idPro, nomeComple, email, senha, cargo FROM profissional WHERE email = ?";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Erro prepare: " . $conn->error);
}
$stmt->bind_param("s", $email);
$stmt->execute();

// obter resultado de forma segura
$result = $stmt->get_result();
if (!$result || $result->num_rows === 0) {
    // email não encontrado
    $stmt->close();
    die("Email não encontrado.");
}

$prof = $result->fetch_assoc();
$stmt->close();

// protege caso algum campo venha nulo
$dbCargo = isset($prof['cargo']) ? (string)$prof['cargo'] : '';

// compara cargos (case-insensitive) de forma segura
if (strcasecmp($cargoForm, $dbCargo) !== 0) {
    // cargo selecionado não bate com o cargo do cadastro
    die("O tipo selecionado não corresponde ao seu perfil.");
}

// verifica senha
if (!isset($prof['senha']) || !password_verify($senha, $prof['senha'])) {
    die("Senha incorreta.");
}

// login OK -> iniciar sessão com dados
$_SESSION['idPro'] = (int)$prof['idPro'];
$_SESSION['nome']  = $prof['nomeComple'] ?? '';
$_SESSION['email'] = $prof['email'] ?? '';
$_SESSION['cargo'] = $dbCargo;

// opcional: buscar dados da empresa e guardar na sessão
$sql2 = "SELECT * FROM empresa WHERE idPro = ?";
$stmt2 = $conn->prepare($sql2);
if ($stmt2) {
    $stmt2->bind_param("i", $_SESSION['idPro']);
    $stmt2->execute();
    $resEmp = $stmt2->get_result();
    if ($resEmp && $resEmp->num_rows > 0) {
        $_SESSION['empresa'] = $resEmp->fetch_assoc();
    }
    $stmt2->close();
}

$conn->close();

// redireciona conforme cargo
if (strcasecmp($dbCargo, "Nutricionista") === 0) {
    header("Location: ../pag-nutricionista/nutricionista.html");
    exit;
}
if (strcasecmp($dbCargo, "Personal") === 0 || strcasecmp($dbCargo, "Personal Trainer") === 0) {
    header("Location: ../pag-personal/personal.html");
    exit;
}

// fallback
header("Location: ../pag-menu/home.html");
exit;
