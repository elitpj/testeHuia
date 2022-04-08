<h1>Teste Backend para empresa Huia</h1>

<h2>Rotas API</h2>

<h3>Registro</h3>

<h4>POST /api/register</h4>

<h5>Parametros:</h5>
<p>name - obrigatório</p>
<p>email - obrigatório</p>
<p>password - obrigatório - mínimo 8 caracteres</p>

<p>ex: /api/register?name=Teste&email=teste@teste.com&password=12345678</p>

<h3>Login</h3>

<h4>POST /api/login</h4>

<h5>Parametros:</h5>
<p>email - obrigatório</p>
<p>password - obrigatório</p>

<p>ex: /api/login?email=teste@teste.com&password=12345678</p>

<h2>CLIENTE</h2>

<h3>Salvar</h3>

<h4>POST /api/cliente</h4>
<h5>Parametros:</h5>
<p>nome - obrigatório</p>
<p>cpf - obrigatório</p>
<p>data_nascimento - obrigatório</p>

<p>ex: /api/cliente?nome=Teste&cpf=123456780&data_nascimento=1990-01-01</p>

<h3>Consultar com ID</h3>

<h4>GET /api/cliente</h4>
<h5>Parametros:</h5>
<p>cliente_id - obrigatório</p>

<p>ex: /api/cliente?cliente_id=1</p>

<h3>Consultar todos</h3>

<h4>GET /api/clientes</h4>

<p>ex: /api/clientes</p>

<h3>Atualizar</h3>

<h4>PATCH /api/cliente</h4>
<h5>Parametros:</h5>
<p>nome - obrigatório</p>
<p>cpf - obrigatório</p>
<p>data_nascimento - obrigatório</p>
<p>cliente_id - obrigatório</p>

<p>ex: /api/cliente?nome=Teste&cpf=123456780&data_nascimento=1990-01-01&cliente_id=1</p>

<h3>Deletar</h3>

<h4>DELETE /api/cliente</h4>
<h5>Parametros:</h5>
<p>cliente_id - obrigatório</p>

<p>ex: /api/cliente?cliente_id=1</p>

<h2>LOTE</h2>

<h3>Salvar</h3>

<h4>POST /api/lote</h4>
<h5>Parametros:</h5>
<p>data_fabricacao - obrigatório</p>
<p>quantidade - obrigatório - mínimo 0</p>
<p>qualidade - obrigatório - mínimo 0 máximo 10</p>

<p>ex: /api/lote?data_fabricacao=2020-01-01&quantidade=10&qualidade=9</p>

<h3>Consultar com ID</h3>

<h4>GET /api/lote</h4>
<h5>Parametros:</h5>
<p>lote_id - obrigatório</p>

<p>ex: /api/lote?lote_id=1</p>

<h3>Consultar todos</h3>

<h4>GET /api/lotes</h4>

<p>ex: /api/lotes</p>

<h3>Atualizar</h3>

<h4>PATCH /api/lote</h4>
<h5>Parametros:</h5>
<p>data_fabricacao - obrigatório</p>
<p>quantidade - obrigatório - mínimo 0</p>
<p>qualidade - obrigatório - mínimo 0 máximo 10</p>
<p>lote_id - obrigatório</p>

<p>ex: /api/lote?data_fabricacao=2000-01-01&quantidade=50&qualidade=3&lote_id=1</p>

<h3>Deletar</h3>

<h4>DELETE /api/lote</h4>
<h5>Parametros:</h5>
<p>lote_id - obrigatório</p>

<p>ex: /api/lote?lote_id=1</p>

<h2>PRODUTO</h2>

<h3>Salvar</h3>

<h4>POST /api/produto</h4>
<h5>Parametros:</h5>
<p>nome - obrigatório</p>
<p>lote_id - obrigatório</p>
<p>cor - obrigatório</p>
<p>descricao - obrigatório</p>
<p>valor - obrigatório</p>

<p>ex: /api/produto?nome=Produto 2&lote_id=1&cor=Preto&descricao=Produto 2 desc&valor=20</p>

<h3>Consultar com ID</h3>

<h4>GET /api/produto</h4>
<h5>Parametros:</h5>
<p>produto_id - obrigatório</p>

<p>ex: /api/produto?produto_id=1</p>

<h3>Consultar todos</h3>

<h4>GET /api/produtos</h4>

<p>ex: /api/produtos</p>

<h3>Atualizar</h3>

<h4>PATCH /api/produto</h4>
<h5>Parametros:</h5>
<p>nome - obrigatório</p>
<p>cor - obrigatório</p>
<p>descricao - obrigatório</p>
<p>valor - obrigatório</p>
<p>produto_id - obrigatório</p>

<p>ex: /api/produto?nome=Produto 2&cor=Roxo&descricao=Produto 2 description&valor=90&produto_id=4</p>

<h3>Deletar</h3>

<h4>DELETE /api/produto</h4>
<h5>Parametros:</h5>
<p>produto_id - obrigatório</p>

<p>ex: /api/produto?produto_id=4</p>

<h2>PEDIDO</h2>

<h3>Salvar</h3>

<h4>POST /api/pedido</h4>
<h5>Parametros:</h5>
<p>client_id - obrigatório</p>
<p>produtos - obrigatório</p>

<p>ex: /api/pedido?client_id=1&produtos={"1":{"id": 1,"name": "Chocolate","quantidade": 2},"2":{"id": 3,"name": "Chocolate","quantidade": 2}}</p>

<h3>Consultar com ID</h3>

<h4>GET /api/pedido</h4>
<h5>Parametros:</h5>
<p>pedido_id - obrigatório</p>

<p>ex: /api/pedido?pedido_id=1</p>

<h3>Consultar todos</h3>

<h4>GET /api/pedidos</h4>

<p>ex: /api/pedidos</p>

<h3>Atualizar</h3>

<h4>PATCH /api/pedido</h4>
<h5>Parametros:</h5>
<p>produtos - obrigatório</p>
<p>pedido_id - obrigatório</p>

<p>ex: /api/pedido?pedido_id=2&produtos={"1":{"id": 1,"name": "Chocolate","quantidade": 20},"2":{"id": 3,"name": "Chocolate","quantidade": 2}}</p>

<h3>Deletar</h3>

<h4>DELETE /api/pedido</h4>
<h5>Parametros:</h5>
<p>pedido_id - obrigatório</p>

<p>ex: /api/pedido?pedido_id=1</p>
