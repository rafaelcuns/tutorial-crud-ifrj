<html lang='pt-br'>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Supermercado X produtos</title>
</head>
<body>
    <form action='principal.php' method='get'>
    <?php 
        $oper = $_GET['oper'];
        $entrada = $_GET['entrada'];
        switch ($oper) {
            case 1:
                if ($entrada == 1) {
                  echo "
                    CODIGO: <input type='number' name='codigo'>
                    <br>
                    NOME: <input type='text' name='nome'>
                    <br>
                    FABRICANTE: <input type='text' name='fabricante'>
                    <br>
                    DATA DE ADIÇÃO: <input type='date' name='data_add'>
                    <br>
                    DATA DE EXPIRAÇÃO: <input type='date' name='data_exp'>
                    <br>
                    DESCRIÇÃO: <input type='text' name='descricao'>
                    <br>
                    <input type='hidden' name='entrada' value='2'>
                    <input type='hidden' name='oper' value='$oper'>
                    <input type='submit' value='Enviar'>
                    <input type='reset' value='Limpar'>
                ";  
                } else {
                    $cod = $_GET['codigo'];
                    $nom = $_GET['nome'];
                    $fab = $_GET['fabricante'];
                    $add = $_GET['data_add'];
                    $exp = $_GET['data_exp'];
                    $desc = $_GET['descricao'];
                    
                    $sql = "select * from produtos where codigo = '$cod'";
                    $conn = mysqli_connect("localhost" , "root" , "" , "supermercadox");
                    $dados = mysqli_query($conn, $sql);

                    $quantidade = mysqli_num_rows($dados);

                    if ($quantidade > 0) {
                        echo "JÁ EXISTE UM PRODUTO COM O MESMO CÓDIGO!";
                    } else {
                        $sql = "insert into produtos values ('$cod', '$nom', '$fab', '$add', '$exp', '$desc')";
                        $conn = mysqli_connect("localhost" , "root" , "" , "supermercadox");
                        $dados = mysqli_query($conn, $sql);
                        echo "PRODUTO CADASTRADO!";
                    }

                    
                }
                
                break;
            case 2:
                if ($entrada == 1) {
                    echo "
                        NOME: <input type='text' name='nome'>
                        <input type='hidden' name='entrada' value='2'>
                        <input type='hidden' name='oper' value='$oper'>
                        <br>
                        <input type='submit' value='Enviar'>
                        <input type='reset' value='Limpar'>
                    ";
                } else {
                    $nom = $_GET['nome'];

                    $sql = "select * from produtos where nome = '$nom'";
                    $conn = mysqli_connect("localhost" , "root" , "" , "supermercadox");
                    $dados = mysqli_query($conn, $sql);
                    $quantidade = mysqli_num_rows($dados);

                    if ($quantidade > 0) {
                        $linha = mysqli_fetch_array($dados);

                        $cod = $linha['codigo'];
                        $nom = $linha['nome'];
                        $fab = $linha['fabricante'];
                        $add = $linha['data_add'];
                        $exp = $linha['data_exp'];
                        $desc = $linha['descricao'];
                        echo "
                            CODIGO: $cod <br>
                            NOME: $nom <br>
                            FABRICANTE: $fab <br>
                            DATA DE ADIÇÂO: $add <br>
                            DATA DE EXPIRAÇÂO: $exp <br>
                            DESCRIÇÂO: $desc
                        ";
                    } else {
                        echo "Produto não existe!";
                    }

                }
                break;
            case 3:
                $sql = "select * from produtos";
                $conn = mysqli_connect("localhost" , "root" , "" , "supermercadox");
                $dados = mysqli_query($conn, $sql);
                $quantidade = mysqli_num_rows($dados);

                if ($quantidade > 0) {
                    for ($i = 0; $i < $quantidade; $i++) {
                        $linha = mysqli_fetch_array($dados);
                        $cod = $linha['codigo'];
                        $nom = $linha['nome'];
                        $fab = $linha['fabricante'];
                        $add = $linha['data_add'];
                        $exp = $linha['data_exp'];
                        $desc = $linha['descricao'];
                        echo "
                            CODIGO: $cod <br>
                            NOME: $nom <br>
                            FABRICANTE: $fab <br>
                            DATA DE ADIÇÂO: $add <br>
                            DATA DE EXPIRAÇÂO: $exp <br>
                            DESCRIÇÂO: $desc
                            <br>
                            <hr>
                            <br>
                        ";
                    }
                } else {
                    echo "NÃO EXISTEM PRODUTOS CADASTRADOS";
                }
                break;
            case 4:
                if ($entrada == 1) {
                    echo "
                        NOME: <input type='text' name='nome'>
                        <input type='hidden' name='entrada' value='2'>
                        <input type='hidden' name='oper' value='$oper'>
                        <br>
                        <input type='submit' value='Enviar'>
                        <input type='reset' value='Limpar'>
                    ";
                } elseif ($entrada == 2) {
                    $nom = $_GET['nome'];
                    $sql = "select * from produtos where nome = '$nom'";
                    $conn = mysqli_connect("localhost" , "root" , "" , "supermercadox");
                    $dados = mysqli_query($conn, $sql);
                    $quantidade = mysqli_num_rows($dados);

                    if ($quantidade > 0) {
                        $linha = mysqli_fetch_array($dados);

                        $cod = $linha['codigo'];
                        $nom = $linha['nome'];
                        $fab = $linha['fabricante'];
                        $add = $linha['data_add'];
                        $exp = $linha['data_exp'];
                        $desc = $linha['descricao'];
                        echo "
                            CODIGO: $cod <br>
                            NOME: $nom <br>
                            FABRICANTE: $fab <br>
                            DATA DE ADIÇÂO: $add <br>
                            DATA DE EXPIRAÇÂO: $exp <br>
                            DESCRIÇÂO: $desc
                        ";

                        echo "
                            <br>
                            VC REALMENTE DESEJA EXCLUIR ESTE PRODUTO?
                            <br>
                            <input type='hidden' name='nome' value='$nom'>
                            <input type='hidden' name='entrada' value='3'>
                            <input type='hidden' name='oper' value='$oper'>
                            <input type='submit' value='SIM'>
                        ";
                    } else {
                        echo "NÃO EXISTE UM PRODUTO COM ESTE NOME";
                    }
                } else {
                    $nom = $_GET['nome'];

                    $sql = "delete from produtos where nome = '$nom'";
                    $conn = mysqli_connect("localhost" , "root" , "" , "supermercadox");
                    $status = mysqli_query($conn, $sql);

                    if ($status == TRUE) {
                        echo "EXCLUIDO COM SUCESSO!";
                    } else {
                        echo "NÃO FOI POSSIVEL EXCLUIR O PRODUTO!";
                    }
                }
                break;
            case 5:
                if ($entrada == 1) {
                    echo "
                        CÓDIGO: <input type='number' name='codigo'>
                        <input type='hidden' name='entrada' value='2'>
                        <input type='hidden' name='oper' value='$oper'>
                        <br>
                        <input type='submit' value='Enviar'>
                        <input type='reset' value='Limpar'>
                    ";
                } elseif ($entrada == 2) {
                    $cod = $_GET['codigo'];

                    $sql = "select * from produtos where codigo = '$cod'";
                    $conn = mysqli_connect("localhost" , "root" , "" , "supermercadox");
                    $dados = mysqli_query($conn, $sql);
                    $quantidade = mysqli_num_rows($dados);

                    if ($quantidade > 0) {
                        $linha = mysqli_fetch_array($dados);

                        $cod = $linha['codigo'];
                        $nom = $linha['nome'];
                        $fab = $linha['fabricante'];
                        $add = $linha['data_add'];
                        $exp = $linha['data_exp'];
                        $desc = $linha['descricao'];
                        echo "
                            CODIGO: <input type='hidden' name='codigo' value='$cod'>$cod
                            <br>
                            NOME: <input type='text' name='nome' value='$nom'>
                            <br>
                            FABRICANTE: <input type='text' name='fabricante' value='$fab'>
                            <br>
                            DATA DE ADIÇÃO: <input type='date' name='data_add' value='$add'>
                            <br>
                            DATA DE EXPIRAÇÃO: <input type='date' name='data_exp' value='$exp'>
                            <br>
                            DESCRIÇÃO: <input type='text' name='descricao'value='$desc'> 
                            <br>
                            <input type='hidden' name='entrada' value='3'>
                            <input type='hidden' name='oper' value='$oper'>
                            <input type='submit' value='Enviar'>
                            <input type='reset' value='Limpar'>
                        ";
                    } else {
                        echo "Produto não existe!";
                    }
                } else {
                    $cod = $_GET['codigo'];
                    $nom = $_GET['nome'];
                    $fab = $_GET['fabricante'];
                    $add = $_GET['data_add'];
                    $exp = $_GET['data_exp'];
                    $desc = $_GET['descricao'];

                    $sql = "update produtos set nome='$nom', fabricante='$fab', data_add='$add', data_exp='$exp', descricao='$desc' where codigo='$cod'";
                    $conn = mysqli_connect("localhost" , "root" , "" , "supermercadox");
                    $dados = mysqli_query($conn, $sql);
                    echo "PRODUTO ATUALIZADO!";
                }
                break;
        }
    ?>
    </form>
</body>
</html>