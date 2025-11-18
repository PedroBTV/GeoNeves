<?php
// faz o erro aparecer independente da tela q estiver
ini_set('display_errors', 1);
error_reporting(E_ALL);


// ****************************************************************************
//  UNICO LUGAR PARA MEXER!!!!!!!!!!!
//  ADICIONAR MAIS ESCOLAS AQUI, NAO MEXER EM NENHUM OUTRO LUGAR
// *********************************************************
$escolas = [
    [
        "nome" => "Instituto Federal de Educação, Ciência e Tecnologia de Minas Gerais - Campus Ribeirão Das Neves",
        "regiao" => "Central",
        "imagem" => "IFMG-2.jpg",
        "link_texto" => "Clique para saber mais sobre o IF-Neves",
        "link_url" => "IFMG-RN.html" 
    ],
    [
        "nome" => "Escola Estadual Romualdo José da Costa <br> <br> <br> ",
        "regiao" => "Areias", 
        "imagem" => "RJCC.jpeg", 
        "link_texto" => "Clique para saber mais sobre o ROJOCO",
        "link_url" => "RJC.html"
    ],

];
// !!!!!!!!!!!!!1FIM DA ÁREA DE EDIÇÃO, nao mexer aqui

// BLOCO 3: A LÓGICA DO FILTRO (O CÉREBRO)
// (Não mexa aqui)


$regiao_filtrada = "todas"; // vai começar mostrando tudo

// Se o usuário filtrou algo (ex: ?regiao=Central)
if (isset($_GET['regiao']) && $_GET['regiao'] != '') {
    $regiao_filtrada = $_GET['regiao']; // Pega a região da URL
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - GeoNeves</title>
    <link rel="stylesheet" href="estilo.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>

    <nav class="navbar navbar-dark fixed-top minha-navbar">
        <div class="container-fluid">
            <br>
            <a class="navbar-brand" href="index.html">GeoNeves</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar"
                aria-labelledby="offcanvasDarkNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">GeoNeves</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.html">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="sobrenos.html">Sobre Nos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="escolasmapeadas.html">Escolas Mapeadas</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Mapeamento
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li><a class="dropdown-item" href="#"></a></li>
                                <li><a class="dropdown-item" href="mapeamento.html">Mapa Interativo</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item"
                                        href="https://docs.google.com/forms/d/e/1FAIpQLSdYl613Mg56Tpz-lGUt1SWmPzPKPmuBd-krqKEESM5OdWkZZA/viewform?usp=dialog">Colaborar
                                        Com O Mapa</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>


    <div class="container my-5">

        <div class="card-custom mb-5">
            <div class="card-custom h-100 mapa-container">
                <h2 class="titulo, fontetitulo">Escolas Mapeadas Pela Nossa Equipe</h2>
                <p class="descricao">
                    Clique nos pontos do mapa e conheça as escolas de Neves mapeadas por nossa equipe.
                </p>
                <iframe
                    src="https://www.google.com/maps/d/embed?mid=17BetEDqTkRN2_if5u1fG7-JGhV6rups&ehbc=2E312F"
                    allowfullscreen></iframe>
            </div>
        </div>

        <div class="card-custom mb-4">
            <form action="escolasmapeadas.php" method="GET" style="background: #f4f4f4; padding: 20px; border-radius: 5px;">
                <label for="regiao" style="font-weight: bold; margin-right: 15px;">Filtrar por Região:</label>

                <select name="regiao" id="regiao" style="padding: 5px;">
                    <option value="todas">Mostrar Todas</option>

                    <option value="Central" <?php if ($regiao_filtrada == 'Central') echo 'selected'; ?>>Central</option>
                    <option value="Veneza" <?php if ($regiao_filtrada == 'Veneza') echo 'selected'; ?>>Veneza</option>
                    <option value="Justinopolis" <?php if ($regiao_filtrada == 'Justinopolis') echo 'selected'; ?>>Justinópolis</option>
                    <option value="Areias" <?php if ($regiao_filtrada == 'Areias') echo 'selected'; ?>>Areias</option>
                </select>

                <button type="submit" style="margin-left: 10px; padding: 5px 10px;">Filtrar</button>
            </form>
        </div>


        <div class="row g-4">

            <?php
            $nenhuma_encontrada = true; // checa se encontramos alguma escola na regiao

            // meio q procura de escola a escola na lista para ver se encontra algo
            foreach ($escolas as $escola) {

                // se for filtrado a opçao todas ou se a escola q foi procurada for achada
                if ($regiao_filtrada == "todas" || $escola['regiao'] == $regiao_filtrada) {

                    $nenhuma_encontrada = false; // foi achado uma

                    // basicamente monta a estrutura do html padrao do geoneves, porem com a filtragem do php

                    echo '<div class="col-md-6">';
                    echo '    <div class="card-custom h-100">';
                    // Puxa o NOME da escola do BLOCO 2
                    echo '        <h2 class="titulo, ">' . ($escola['nome']) . '</h2>';
                    echo '        <div class="card-custom mb-5">';
                    echo '            <div class="col-md">';
                    // Puxa a IMAGEM da escola do BLOCO 2
                    echo '                <img src="' . ($escola['imagem']) . '" class="img-fluid rounded-start" alt="Foto da escola">';
                    // Puxa o LINK e o TEXTO da escola do BLOCO 2
                    echo '                <a href="' . ($escola['link_url']) . '"><p class="descricao">' . ($escola['link_texto']) . '</p></a>';
                    echo '            </div>';
                    echo '        </div>';
                    echo '    </div>';
                    echo '</div>';
                } // Fim do if (filtro)
            } // Fim do loop 'foreach'

            // Se, depois do loop, a "bandeira" não mudou...
            if ($nenhuma_encontrada) {
                echo '<div class="col-12">';
                echo '  <div class="card-custom h-100" style="padding: 20px; text-align: center; background-color: #fff8e1;">';
                echo '    <p>Nenhuma escola encontrada para a região: <strong>' . ($regiao_filtrada) . '</strong></p>';
                echo '  </div>';
                echo '</div>';
            }
            ?>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

</body>

</html>