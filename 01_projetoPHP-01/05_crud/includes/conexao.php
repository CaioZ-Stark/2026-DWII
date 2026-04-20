<?php
/**
 * Disciplina   : Desenvolvimento Web II 
 * Aula         : 07 - CRUD: Create e Read
 * Arquivo      : 05_crud/includes/conexao.php
 * Descrição    : Cria e retona a conexão PDO com o banco portifolio
*/
/**
 * conectar()
 * Retorna uma instâcia PDO pronta para uso.
 * Em caso de erro, mostra mensagem de erro
 */
function conectar(): PDO
{
    $dsn = 'mysql:host=127.0.0.1;dbname=portfolio;charset=utf8mb4';
    $usuario = 'root';
    $senha = 'dwii2026';


    try{
        $pdo = new PDO($dsn, $usuario, $senha,[
            PDO::ATTR_ERRMODE =>
            PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);
        return $pdo;
    }catch(PDOException $e){
        die('Erro ao conectar no Banco de Dados ');
    }
}








?>