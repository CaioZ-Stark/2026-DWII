# Portfólio Dinâmico — Aula 03 DWII

Mini-site de portfólio pessoal desenvolvido em PHP usando o php para melhorar.
Usando o php para deixar o site dinamicamente com variáveis e includes. 

## Como executar

```
cd ~/workspaces/2026-DWII
php -S localhost:8001 -t 01_php-intro/
```

Acesse: http://localhost:8001

## Estrutura de arquivos

- index.php        — página inicial com apresentação
- sobre.php        — página de biografia
- projetos.php     — lista de projetos
- includes/
  - cabecalho.php  — cabeçalho HTML compartilhado
  - rodape.php     — rodapé HTML compartilhado
  - nav.php        — menu dinâmico com destaque na página ativa