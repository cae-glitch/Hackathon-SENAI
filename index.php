<?php
$host   = "localhost";
$dbname = "edutech_db";
$user   = "root";
$pass   = "";           

header('Content-Type: text/html; charset=UTF-8');

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $user,
        $pass
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $nome_curso            = htmlspecialchars(trim($_POST['nome_curso'] ?? ''));
        $area_tecnologica      = htmlspecialchars(trim($_POST['area_tecnologica'] ?? ''));
        $empresa_patrocinadora = htmlspecialchars(trim($_POST['empresa_patrocinadora'] ?? ''));

        $quantidade_alunos = filter_input(INPUT_POST, 'quantidade_alunos', FILTER_VALIDATE_INT);

        if ($nome_curso === '' || $area_tecnologica === '' || $empresa_patrocinadora === ''
            || $quantidade_alunos === false || $quantidade_alunos === null || $quantidade_alunos < 1) {

            echo "<script>
                    alert('Dados inválidos! Preencha todos os campos corretamente.');
                    window.location.href = 'index.html';
                  </script>";
            exit;
        }

        $sql = "INSERT INTO cursos (nome_curso, area_tecnologica, quantidade_alunos, empresa_patrocinadora)
                VALUES (:nome_curso, :area_tecnologica, :quantidade_alunos, :empresa_patrocinadora)";

        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':nome_curso',            $nome_curso,            PDO::PARAM_STR);
        $stmt->bindParam(':area_tecnologica',      $area_tecnologica,      PDO::PARAM_STR);
        $stmt->bindParam(':quantidade_alunos',     $quantidade_alunos,     PDO::PARAM_INT);
        $stmt->bindParam(':empresa_patrocinadora', $empresa_patrocinadora, PDO::PARAM_STR);

        $stmt->execute();

        echo "<script>
                alert('Curso cadastrado com sucesso!');
                window.location.href = 'index.html';
              </script>";

    } else {
        header('Location: index.html');
        exit;
    }

} catch (PDOException $e) {

    echo "<h3>Erro ao cadastrar o curso:</h3>";
    echo "<p>" . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<a href='index.html'>Voltar ao formulário</a>";
}
?>