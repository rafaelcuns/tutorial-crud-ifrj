<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>CRUD Player</title>
</head>
<body>
    <div id="topbar">
        <form action="principal.php" method="get">
            <button type="submit" name="oper" value="1">Adicionar</button>
            <button type="submit" name="oper" value="2">Pesquisar</button>
            <button type="submit" name="oper" value="3">Listar</button>
            <h1><a href="https://playvalorant.com/pt-br/">JOGAR</a></h1>
            <button type="submit" name="oper" value="4">Excluir</button>
            <button type="submit" name="oper" value="5">Alterar</button>
            <button type="submit" name="oper" value="6">Sortear</button>
            <input type="hidden" name="entrada" value="1">
        </form>
        <hr>
    </div>
    <form action="principal.php" method="get">
    <div id="oper">
    <?php
        $oper = $_GET['oper'];
        $entrada = $_GET['entrada'];
        switch ($oper) {
            case 1:
                if ($entrada == 1) {
                    echo "
                        <label for='codigo'>Codigo:</label>
                        <input type='text' name='codigo'>
                        <br>
                        <label for='nome'>Nome:</label>
                        <input type='text' name='nome'>
                        <br>
                        <label for='cpf'>CPF:</label>
                        <input type='text' name='cpf'>
                        <br>
                        <label for='endereco'>Endereço:</label>
                        <input type='text' name='endereco'>
                        <br>
                        <label for='nascimento'>Nascimento:</label>
                        <input type='date' name='nascimento'>
                        <br>
                        <label for='vitorias'>Vitórias:</label>
                        <input type='number' name='vitorias'>
                        <br>
                        <label for='time'>Time atrelado:</label>
                        <input type='text' name='time'>
                        <br>
                        <input type='hidden' name='oper' value='$oper'>
                        <input type='hidden' name='entrada' value='2'>
                        <button class='enviar' type='submit'>Enviar</button>
                        <button class='limpar' type='reset'>Limpar</button>
                    ";
                } else {
                    $cod = $_GET['codigo'];
                    $sql = "select * from jogadores where codigo = '$cod'";
                    $conn = mysqli_connect("localhost" , "root" , "" , "campeonato");
                    $dados = mysqli_query($conn, $sql);
                    $quantidade = mysqli_num_rows($dados);
                    if ($quantidade > 0) {
                        echo "<p>Já existe um jogador com esse código</p>";
                    } else {
                        $nome = $_GET['nome'];
                        $cpf = $_GET['cpf'];
                        $endereco = $_GET['endereco'];
                        $nascimento = $_GET['nascimento'];
                        $vitorias = $_GET['vitorias'];
                        $time = $_GET['time'];
                        
                        $sql = "insert into jogadores values ('$cod' , '$nome' , '$cpf' , '$endereco' , '$nascimento', $vitorias, $time)";
                        $con = mysqli_connect("localhost" , "root" , "" , "campeonato");
                        $stat = mysqli_query($con, $sql);
                        echo "<p>Dados inseridos!</p>";
                    }
                }
                break;
            case 2:
                if ($entrada == 1) {
                    echo "
                        <label for='nome'>Nome:</label>
                        <input type='text' name='nome'>
                        <input type='hidden' name='oper' value='$oper'>
                        <input type='hidden' name='entrada' value='2'>
                        <br>
                        <button class='enviar' type='submit'>Enviar</button>
                        <button class='limpar' type='reset'>Limpar</button>
                    ";
                } else {
                    $nome = $_GET['nome'];
                    $sql = "select * from jogadores where nome = '$nome'";
                    $conn = mysqli_connect("localhost" , "root" , "" , "campeonato");
                    $dados = mysqli_query($conn, $sql);
                    $quantidade = mysqli_num_rows($dados);
                    if ($quantidade > 0) {
                        $linha = mysqli_fetch_array($dados);
                        $cod = $linha['codigo'];
                        $nom = $linha['nome'];
                        $cpf = $linha['cpf'];
                        $endereco = $linha['endereco'];
                        $nas = $linha['nascimento'];
                        $vitorias = $linha['vitorias'];
                        $time = $linha['time'];

                        echo "
                            <p>Código: $cod</p>
                            <p>Nome: $nom</p>
                            <p>CPF: $cpf</p>
                            <p>Endereço: $endereco</p>
                            <p>Nascimento: $nas</p>
                            <p>Vitórias: $vitorias</p>
                            <p>Time atrelado: $time</p>
                        ";
                    } else {
                        echo "Nada encontrado";
                    }
                }
                break;
            case 3:
                $sql = "select * from jogadores";
                $conn = mysqli_connect("localhost" , "root" , "" , "campeonato");
                $dados = mysqli_query($conn, $sql);
                $quantidade = mysqli_num_rows($dados);
                if ($quantidade > 0) {
                    for ($i=0; $i<$quantidade; $i++) {
                        $linha = mysqli_fetch_array($dados);
                        $cod = $linha['codigo'];
                        $nom = $linha['nome'];
                        $cpf = $linha['cpf'];
                        $endereco = $linha['endereco'];
                        $nas = $linha['nascimento'];
                        $vitorias = $linha['vitorias'];
                        $time = $linha['time'];

                        echo "
                            <p>Código: $cod</p>
                            <p>Nome: $nom</p>
                            <p>CPF: $cpf</p>
                            <p>Endereço: $endereco</p>
                            <p>Nascimento: $nas</p>
                            <p>Vitórias: $vitorias</p>
                            <p>Time atrelado: $time</p>
                            <br>
                            <hr>
                            <br>
                        ";
                    }
                }
                break;
            case 4:
                if ($entrada == 1) {
                    echo "
                        <label for='codigo'>Código:</label>
                        <input type='number' name='codigo'>
                        <input type='hidden' name='oper' value='$oper'> 
                        <input type='hidden' name='entrada' value='2'> 
                        <br>
                        <button class='enviar' type='submit'>Enviar</button>
                        <button class='limpar' type='reset'>Limpar</button>
                    ";
                } elseif ($entrada == 2) {
                    $cod = $_GET['codigo'];
                    $sql = "select * from jogadores where codigo = $cod";
                    $conn = mysqli_connect("localhost" , "root" , "" , "campeonato");
                    $dados = mysqli_query($conn, $sql);
                    $quantidade = mysqli_num_rows($dados);

                    if ($quantidade > 0) {
                        $linha = mysqli_fetch_array($dados);
                        $cod = $linha['codigo'];
                        $nom = $linha['nome'];
                        $cpf = $linha['cpf'];
                        $endereco = $linha['endereco'];
                        $nas = $linha['nascimento'];
                        $vitorias = $linha['vitorias'];
                        $time = $linha['time'];

                        echo "
                            <p>Jogador encontrado!</p>
                            <p>Código: $cod</p>
                            <p>Nome: $nom</p>
                            <p>CPF: $cpf</p>
                            <p>Endereço: $endereco</p>
                            <p>Nascimento: $nas</p>
                            <p>Vitórias: $vitorias</p>
                            <p>Time atrelado: $time</p>
                            <p>Tem certeza que deseja excluir?!</p>

                            <input type='hidden' name='oper' value='$oper'> 
                            <input type='hidden' name='entrada' value='3'> 
                            <button class='enviar' type='submit'>Sim</button>
                            <button class='excluir'><a href='principal.php?oper=4&entrada=1'>Não</a></button>
                        ";
                    } else {
                        echo "<p>jogador não encontrado!</p>";
                    }
                } elseif ($entrada == 3) {
                    $cod = $_GET['codigo'];
                    $sql = "delete from jogadores where codigo = $cod";
                    $conn = mysqli_connect("localhost" , "root" , "" , "campeonato");
                    $status = mysqli_query($conn, $sql);

                    if($status = true) {
                        echo "<p>Jogador excluido com sucesso!</p>";
                    } else {
                        echo "<p>Não foi possível excluir o jogador</p>";
                    }
                }
                break;
            case 5:
                if ($entrada == 1) {
                    echo "
                        <label for='codigo'>Código:</label>
                        <input type='number' name='codigo'>
                        <input type='hidden' name='oper' value='$oper'>
                        <br>
                        <input type='hidden' name='entrada' value='2'>
                        <button class='enviar' type='submit'>Enviar</button>
                        <button class='limpar' type='reset'>Limpar</button>
                    ";
                } elseif ($entrada == 2) {
                    $cod = $_GET['codigo'];
                    $sql = "select * from jogadores where codigo = $cod";
                    $conn = mysqli_connect("localhost" , "root" , "" , "campeonato");
                    $dados = mysqli_query($conn, $sql);
                    $quantidade = mysqli_num_rows($dados);
                    
                    if($quantidade > 0) {
                        $linha = mysqli_fetch_array($dados);
                        $cod = $linha['codigo'];
                        $nom = $linha['nome'];
                        $cpf = $linha['cpf'];
                        $endereco = $linha['endereco'];
                        $nas = $linha['nascimento'];
                        $vitorias = $linha['vitorias'];
                        $time = $linha['time'];

                        echo "
                        <label for='codigo'>Codigo:</label>
                        <input type='text' name='codigo' value='$cod'>
                        <br>
                        <label for='nome'>Nome:</label>
                        <input type='text' name='nome' value='$nom'>
                        <br>
                        <label for='cpf'>CPF:</label>
                        <input type='text' name='cpf' value='$cpf'>
                        <br>
                        <label for='endereco'>Endereço:</label>
                        <input type='text' name='endereco' value='$endereco'>
                        <br>
                        <label for='nascimento'>Nascimento:</label>
                        <input type='date' name='nascimento' value='$nas'>
                        <br>
                        <label for='vitorias'>Vitórias:</label>
                        <input type='number' name='vitorias' value='$vitorias'>
                        <br>
                        <label for='time'>Time atrelado:</label>
                        <input type='text' name='time' value='$time'>
                        <br>
                        <input type='hidden' name='oper' value='$oper'>
                        <input type='hidden' name='entrada' value='3'>
                        <button class='enviar' type='submit'>Enviar</button>
                        <button class='limpar' type='reset'>Limpar</button>
                        ";
                    } else {
                        echo "<p>jogador não encontrado!</p>";
                    }
                } elseif ($entrada == 3) {
                    $cod = $_GET['codigo'];
                    $nome = $_GET['nome'];
                    $cpf = $_GET['cpf'];
                    $endereco = $_GET['endereco'];
                    $nascimento = $_GET['nascimento'];
                    $vitorias = $_GET['vitorias'];
                    $time = $_GET['time'];

                    $sql = "update jogadores set nome='$nome', cpf='$cpf', endereco='$endereco', nascimento='$nascimento', vitorias='$vitorias', time='$time' where codigo='$cod'";
                    $con = mysqli_connect("localhost" , "root" , "" , "campeonato");
                    $stat = mysqli_query($con, $sql);
                    echo "<p>Dados alterados</p>";
                }
                break;
            case 6:
                $sql = "SELECT codigo from jogadores ORDER BY RAND() LIMIT 1;";
                $conn = mysqli_connect("localhost" , "root" , "" , "campeonato");
                $stat = mysqli_query($conn, $sql);

                $linha = mysqli_fetch_array($stat);

                $cod = $linha[0];

                $sql = "select * from jogadores where codigo = $cod";
                $conn = mysqli_connect("localhost" , "root" , "" , "campeonato");
                $stat = mysqli_query($conn, $sql);
                $linha = mysqli_fetch_array($stat);

                $nom = $linha['nome'];
                $cpf = $linha['cpf'];
                $endereco = $linha['endereco'];
                $nas = $linha['nascimento'];
                $vitorias = $linha['vitorias'];
                $time = $linha['time'];

                echo "
                    <p>Jogador sorteado!</p>
                    <p>Código: $cod</p>
                    <p>Nome: $nom</p>
                    <p>CPF: $cpf</p>
                    <p>Endereço: $endereco</p>
                    <p>Nascimento: $nas</p>
                    <p>Vitórias: $vitorias</p>
                    <p>Time atrelado: $time</p>
                ";
                break;
        }
    ?>
    </div>
    </form>
</body>
</html>