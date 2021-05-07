<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Desafio BEMOL Digital</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        

        <!-- Styles -->
        <link rel="stylesheet" href="/css/app.css" />
        
    </head>
    <body>
        <div class="container">
            <div class="form-group">
            
                <form method="POST" action="users" class="form">
                    @csrf
                    <h1>Cadastro de Usuários</h1>
                    <p>Preencha o formulário para criar um novo usuário.</p>
                    <hr>
                    <label for=”name”>Nome:</label>
                    <input name="name" type="text" class=”form-control” placeholder="Nome completo"required>

                    <label for=”email”>Email:</label>
                    <input name="email" type="text" class=”form-control” placeholder="usuario@dominio.com"required>
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <label for=”telefone”>Telefone:</label>
                    <input name="telefone" type="text" class=”form-control” placeholder="(92) 99999-9999"required>
                    
                    <label for=”cep”>Cep:</label>
                    <input name="cep" type="text" class=”form-control” placeholder="99999-999"required>

                    <label for="password"><b>Senha</b></label>
                    <input type="password" name="password" placeholder="Insira a Senha"required>
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <label for="psw-repeat"><b>Repetir Senha</b></label>
                    <input type="password" placeholder="Repita a Senha" name="senha-repetida" required>
                    @error('senha-repetida')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror


                    <div class="clearfix">
                    <button type="button" class="btn-danger">Cancelar</button>
                    <button type="submit" class="btn-primary">Criar</button>
                    </div>

                    
                </form>
            </div>
                
        </div>
    </body>
</html>
