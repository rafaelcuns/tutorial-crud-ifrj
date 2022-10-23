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
        if (isset($_GET['oper']) and isset($_GET['entrada'])) {
            $oper = $_GET['oper'];
            $entrada = $_GET['entrada'];
        } else {
            echo "
                <h2>campeonato_rafael141 Brasileiro de Valorant 2022</h2>
                <p>Selecione uma das opções para criação, consulta, atualização e exclusão de qualquer dado de qualquer jogador!</p>
            ";
            die();
        }
        switch ($oper) {
            case 1:
                if ($entrada == 1) {
                    echo "
                        <label for='codigo'>Código:</label>
                        <input type='text' name='codigo'>
                        <br>
                        <label for='nome'>Nome:</label>
                        <input type='text' name='nome'>
                        <br>
                        <label for='cpf'>CPF:</label>
                        <input type='text' name='cpf'>
                        <br>
                        <label for='nascimento'>Nascimento:</label>
                        <input type='date' name='nascimento'>
                        <br>
                        <label for='time'>Time atrelado:</label>
                        <input type='text' name='time'>
                        <br>
                        <label for='funcao'>Função exercida:</label>
                        <select name='funcao'>
                            <option value='Duelista'>Duelista</option>
                            <option value='Controlador'>Controlador</option>
                            <option value='Iniciador'>Iniciador</option>
                            <option value='Sentinela'>Sentinela</option>
                        </select>
                        <br>
                        <label for='vitorias'>Vitórias:</label>
                        <input type='number' name='vitorias'>
                        <br>
                        
                        <input type='hidden' name='oper' value='$oper'>
                        <input type='hidden' name='entrada' value='2'>
                        <button class='enviar' type='submit'>Enviar</button>
                        <button class='limpar' type='reset'>Limpar</button>
                    ";
                } else {
                    $cod = $_GET['codigo'];
                    $sql = "select * from jogadores where codigo = '$cod'";
                    $conn = mysqli_connect("localhost" , "root" , "" , "campeonato_rafael141");
                    $dados = mysqli_query($conn, $sql);
                    $quantidade = mysqli_num_rows($dados);
                    if ($quantidade > 0) {
                        echo "<p>Já existe um jogador com esse código</p>";
                    } else {
                        $nome = $_GET['nome'];
                        $cpf = $_GET['cpf'];
                        $nascimento = $_GET['nascimento'];
                        $time = $_GET['time'];
                        $func = $_GET['funcao'];
                        $vitorias = $_GET['vitorias'];
                        
                        
                        $sql = "insert into jogadores (codigo, nome, cpf, nascimento, time, funcao, vitorias) values ('$cod' , '$nome' , '$cpf' , '$nascimento' , '$time', '$func', '$vitorias')";
                        $con = mysqli_connect("localhost" , "root" , "" , "campeonato_rafael141");
                        $stat = mysqli_query($con, $sql);
                        if($stat = true) {
                            echo "<p>Dados inseridos!</p>";
                        } else {
                            echo "<p>Não foi possível inserir os dados do jogador!</p>";
                        }
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
                    $conn = mysqli_connect("localhost" , "root" , "" , "campeonato_rafael141");
                    $dados = mysqli_query($conn, $sql);
                    $quantidade = mysqli_num_rows($dados);
                    if ($quantidade > 0) {
                        $linha = mysqli_fetch_array($dados);
                        $cod = $linha['codigo'];
                        $nom = $linha['nome'];
                        $cpf = $linha['cpf'];
                        $nas = $linha['nascimento'];
                        $time = $linha['time'];
                        $func = $linha['funcao'];
                        $vitorias = $linha['vitorias'];
                        

                        echo "
                            <p>Código: $cod</p>
                            <p>Nome: $nom</p>
                            <p>CPF: $cpf</p>
                            <p>Data de nascimento: $nas</p>
                            <p>Time atrelado: $time</p>
                            <p>Função exercida como jogador: $func</p>
                            <p>Número de vitórias: $vitorias</p>
                        ";
                    } else {
                        echo "<p>Nada encontrado</p>";
                    }
                }
                break;
            case 3:
                $sql = "select * from jogadores";
                $conn = mysqli_connect("localhost" , "root" , "" , "campeonato_rafael141");
                $dados = mysqli_query($conn, $sql);
                $quantidade = mysqli_num_rows($dados);
                if ($quantidade > 0) {
                    for ($i=0; $i<$quantidade; $i++) {
                        $linha = mysqli_fetch_array($dados);
                        $cod = $linha['codigo'];
                        $nom = $linha['nome'];
                        $cpf = $linha['cpf'];
                        $nas = $linha['nascimento'];
                        $time = $linha['time'];
                        $func = $linha['funcao'];
                        $vitorias = $linha['vitorias'];

                        echo "
                            <br>
                            <p>Código: $cod</p>
                            <p>Nome: $nom</p>
                            <p>CPF: $cpf</p>
                            <p>Data de nascimento: $nas</p>
                            <p>Time atrelado: $time</p>
                            <p>Função exercida como jogador: $func</p>
                            <p>Número de vitórias: $vitorias</p>
                            <br>
                            <hr>
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
                    $conn = mysqli_connect("localhost" , "root" , "" , "campeonato_rafael141");
                    $dados = mysqli_query($conn, $sql);
                    $quantidade = mysqli_num_rows($dados);

                    if ($quantidade > 0) {
                        $linha = mysqli_fetch_array($dados);
                        $cod = $linha['codigo'];
                        $nom = $linha['nome'];
                        $cpf = $linha['cpf'];
                        $nas = $linha['nascimento'];
                        $time = $linha['time'];
                        $func = $linha['funcao'];
                        $vitorias = $linha['vitorias'];
                        
                        echo "
                            <p>Código: $cod</p>
                            <p>Nome: $nom</p>
                            <p>CPF: $cpf</p>
                            <p>Data de nascimento: $nas</p>
                            <p>Time atrelado: $time</p>
                            <p>Função exercida como jogador: $func</p>
                            <p>Número de vitórias: $vitorias</p>
                            <p>Tem certeza que deseja excluir?!</p>

                            <input type='hidden' name='codigo' value='$cod'> 
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
                    $conn = mysqli_connect("localhost" , "root" , "" , "campeonato_rafael141");
                    $stat = mysqli_query($conn, $sql);

                    if($stat = true) {
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
                    $codo = $_GET['codigo'];
                    $sql = "select * from jogadores where codigo = $codo";
                    $conn = mysqli_connect("localhost" , "root" , "" , "campeonato_rafael141");
                    $dados = mysqli_query($conn, $sql);
                    $quantidade = mysqli_num_rows($dados);
                    
                    if($quantidade > 0) {
                        $linha = mysqli_fetch_array($dados);
                        $cod = $linha['codigo'];
                        $nom = $linha['nome'];
                        $cpf = $linha['cpf'];
                        $nas = $linha['nascimento'];
                        $time = $linha['time'];
                        $func = $linha['funcao'];
                        $vitorias = $linha['vitorias'];

                        echo "
                            <label for='codigo'>Codigo:</label>
                            <input type='text' name='codigo_original' value='$cod'>
                            <br>
                            <label for='nome'>Nome:</label>
                            <input type='text' name='nome' value='$nom'>
                            <br>
                            <label for='cpf'>CPF:</label>
                            <input type='text' name='cpf' value='$cpf'>
                            <br>
                            <label for='nascimento'>Nascimento:</label>
                            <input type='date' name='nascimento' value='$nas'>
                            <br>
                            <br>
                            <label for='time'>Time atrelado:</label>
                            <input type='text' name='time' value='$time'>
                            <br>
                            <label for='funcao'>Função exercida:</label>
                            <select name='funcao' value='$func'>
                        ";
                        if ($func == "Duelista") {
                            echo "
                                <option value='Duelista' selected>Duelista</option>
                                <option value='Controlador'>Controlador</option>
                                <option value='Iniciador'>Iniciador</option>
                                <option value='Sentinela'>Sentinela</option>
                            ";
                        } elseif ($func == "Controlador") {
                            echo "
                                <option value='Duelista'>Duelista</option>
                                <option value='Controlador' selected>Controlador</option>
                                <option value='Iniciador'>Iniciador</option>
                                <option value='Sentinela'>Sentinela</option>
                            ";
                        } elseif ($func == "Iniciador") {
                            echo "
                                <option value='Duelista'>Duelista</option>
                                <option value='Controlador'>Controlador</option>
                                <option value='Iniciador' selected>Iniciador</option>
                                <option value='Sentinela'>Sentinela</option>
                            ";
                        } else {
                            echo "
                                <option value='Duelista'>Duelista</option>
                                <option value='Controlador'>Controlador</option>
                                <option value='Iniciador'>Iniciador</option>
                                <option value='Sentinela' selected>Sentinela</option>
                            ";
                        }
                        echo "
                            </select>
                            <br>
                            <label for='vitorias'>Vitórias:</label>
                            <input type='number' name='vitorias' value='$vitorias'>
                            <br>
                            
                            <input type='hidden' name='codigo' value='$cod'> 
                            <input type='hidden' name='oper' value='$oper'>
                            <input type='hidden' name='entrada' value='3'>
                            <button class='enviar' type='submit'>Enviar</button>
                            <button class='limpar' type='reset'>Limpar</button>
                        ";
                    } else {
                        echo "<p>Jogador não encontrado!</p>";
                    }
                } elseif ($entrada == 3) {
                    $codo = $_GET['codigo_original'];
                    $cod = $_GET['codigo'];
                    $nome = $_GET['nome'];
                    $cpf = $_GET['cpf'];
                    $nascimento = $_GET['nascimento'];
                    $time = $_GET['time'];
                    $func = $_GET['funcao'];
                    $vitorias = $_GET['vitorias'];

                    $sql = "update jogadores set codigo='$cod', nome='$nome', cpf='$cpf', nascimento='$nascimento', time='$time', funcao='$func', vitorias='$vitorias' where codigo='$codo'";
                    $con = mysqli_connect("localhost" , "root" , "" , "campeonato_rafael141");
                    $stat = mysqli_query($con, $sql);
                    if($stat = true) {
                        echo "<p>Dados alterados</p>";
                    } else {
                        echo "<p>Não foi possível alterar os dados do jogador!</p>";
                    }
                    
                }
                break;
            case 6:
                $sql = "SELECT codigo from jogadores ORDER BY RAND() LIMIT 1;";
                $conn = mysqli_connect("localhost" , "root" , "" , "campeonato_rafael141");
                $stat = mysqli_query($conn, $sql);

                $linha = mysqli_fetch_array($stat);

                $cod = $linha[0];

                $sql = "select * from jogadores where codigo = $cod";
                $conn = mysqli_connect("localhost" , "root" , "" , "campeonato_rafael141");
                $stat = mysqli_query($conn, $sql);
                $linha = mysqli_fetch_array($stat);

                $cod = $linha['codigo'];
                $nom = $linha['nome'];
                $cpf = $linha['cpf'];
                $nas = $linha['nascimento'];
                $time = $linha['time'];
                $func = $linha['funcao'];
                $vitorias = $linha['vitorias'];

                echo "
                    <p>Código: $cod</p>
                    <p>Nome: $nom</p>
                    <p>CPF: $cpf</p>
                    <p>Data de nascimento: $nas</p>
                    <p>Time atrelado: $time</p>
                    <p>Função exercida como jogador: $func</p>
                    <p>Número de vitórias: $vitorias</p>
                ";
                break;
        }
    ?>
    </div>
    </form>
</body>
</html>