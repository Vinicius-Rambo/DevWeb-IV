# Operações

### Listar produtos

**GET**

> http://localhost/AVA1/index.php

Retorna todos os produtos ativos.

### Buscar produto
**GET**

> http://localhost/AVA1/index.php?id=1

Retorna o produto correspondente ao ID informado.

### Cadastrar produto

**POST**

> http://localhost/AVA1/index.php

Body JSON:

```json
{
    "nome": "Teclado Mecânico",
    "preco": 249.90,
    "estoque": 15
}
```

Cadastra um novo produto.

### Alterar produto

**PUT**

> http://localhost/AVA1/index.php?id=1

Body JSON:

```json
{
    "nome": "Teclado Mecânico RGB",
    "preco": 299.90,
    "estoque": 20
}
```

Altera os dados do produto informado.

### Excluir produto

**DELETE**

> http://localhost/AVA1/index.php?id=1

Realiza a exclusão lógica do produto, alterando seu campo `ativo` para `0`.

## Validação

Os dados enviados para criação e alteração são processados pelas respectivas DTOs antes de serem enviados ao Model.

Exemplo de dados inválidos:

```json
{
    "nome": "",
    "preco": -50,
    "estoque": -10
}
```

Nesse caso, a API retorna `400 Bad Request` com os erros de validação.

## Códigos HTTP

| Código | Descrição |
|---|---|
| `200` | Operação realizada com sucesso |
| `201` | Produto criado |
| `204` | Produto excluído |
| `400` | Dados inválidos |
| `404` | Produto não encontrado |
| `405` | Método HTTP não permitido |

## Fluxo

```text
Requisição
    ↓
index.php
    ↓
Controller
    ↓
DTO
    ↓
Model
    ↓
Banco de Dados
```

As respostas são formatadas pela `ProdutoResponseDTO`.