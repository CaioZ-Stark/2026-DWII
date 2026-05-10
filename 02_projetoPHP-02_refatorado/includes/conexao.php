<?php 
/**
 * Discisplina : Desenvolvimento Web II (DWII)
 * Projeto     : Portfólio Pessoal - versão refatorada
 * Arquivo     : includes/conexao.php
 * Autor       : Caio Mario Zachesky Junior
 * Data        : 06/05/2026 
 * Descrição   : Conexão PDO única do projeto.
 * Resolver P5 (dois Bancos) e P6 (dois conexao.php). 
 */


function conectar(): PDO
{
    $dsn = 'mysql:host=127.0.0.1;dbname=portfolio;charset=utf8mb4';
    $usuario = 'root';
    $senha = 'dwii2026';


    try{
        return new PDO($dsn, $usuario, $senha,[
            PDO::ATTR_ERRMODE =>
            PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);
       
    }catch(PDOException $e){
        die('Erro ao conectar no Banco de Dados ');
    }
}

?>