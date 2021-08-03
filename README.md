# Sobre

<p>CRUD para realizar cadastramento de médicos, onde também é possível cadastrar novas especialidades e em seguida vincular ao médico.</p>

## Como utilizar:

<p>1-Criar um banco de dados com o nome "dblaravel8" em um SGBD de sua preferência</p>
<p>2-Alterar o arquivo <b>.env</b> em caso de o seu banco nao possuir o usuário root sem senha</p>
<p>3-Dentro da pasta do projeto, digitar o seguinte comando para executar as migrations (criação) das tabelas no banco de dados:</p>
<p><code>php artisan migrate --seed</code></p>
<p><strong>OBS:</strong> O comando acima irá criar automaticamente as cidades, estados e algumas especialidades médicas.</p>

<p>4-Executar os seguintes comandos:</p>
<p><code>npm install</code></p>
<p><code>npm run dev</code></p>
<p><code>php artisan serve</code></p>

<p>5-Abrir o navegador e começar a utilizar o CRUD</p>

## Recursos Utilizados:

<ul>
    <li>Laravel 8</li>
    <li>VueJs 3</li>
</ul>
