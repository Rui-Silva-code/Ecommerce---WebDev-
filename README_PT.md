# E-commerce - Webdev (Demo)

## Visão geral
Projeto académico simulando um e-commerce básico com catálogo, carrinho e fluxo de checkout (simulado). Demonstra integração **front-end e back-end** e operações **CRUD**.

**Estado:** Demo / Não pronto para produção

---

## Tecnologias utilizadas
- PHP 7.4+ (back-end)  
- MySQL 
- HTML5, CSS3, Bootstrap  
- JavaScript (carrinho e validações)

---

## Funcionalidades principais
- Listagem de produtos e detalhe do produto  
- Carrinho de compras em sessão  
- Processo de checkout simulado (sem gateway de pagamento real)  
- CRUD de produtos (área administrativa simples)

---

## Limitações e segurança
- Não integrar pagamentos reais (somente simulação)  
- Uso de `password_hash()` para segurança de passwords e `prepared statements` para queries  
- Não comitar credenciais ou dumps com dados sensíveis

---

## Estrutura do projeto
```
/imagens/                 -> Todas as imagens usadas no site (produtos, banners, ícones, etc.)

/sql/
lojaonline.sql            -> Esquema da base de dados e dados de exemplo

/* Páginas públicas / front-end */
paginaprincipal.php       -> Página principal da loja
formulario_compra.php     -> Formulário de compra do cliente
finalizar_compra.php      -> Finalização do pedido
salvar_compra.php         -> Processamento do pedido

/* Área administrativa */
paginaadmin.php           -> Dashboard do administrador
loginadmin.php            -> Login do administrador
logout.php                -> Logout do administrador
inserir_produto.php       -> Adicionar novo produto
alterar_produto.php       -> Editar produto existente
excluir_produto.php       -> Apagar produto

/* Back-end / conexões */
basedados.php             -> Conexão com a base de dados

```

---

## Próximos passos
- Autenticação robusta com roles (admin / user)  
- Implementação de testes e integração contínua (CI)  
- Adição de paginação e filtros no catálogo

---

## Autor
Rui Silva  
GitHub: https://github.com/Rui-Silva-code
