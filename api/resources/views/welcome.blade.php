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

        <script>
    
            function limpa_formulário_cep() {
                    //Limpa valores do formulário de cep.
                    document.getElementById('rua').value=("");
                    document.getElementById('bairro').value=("");
                    document.getElementById('cidade').value=("");
                    document.getElementById('uf').value=("");
            }

            function meu_callback(conteudo) {
                if (!("erro" in conteudo)) {
                    //Atualiza os campos com os valores.
                    document.getElementById('rua').value=(conteudo.logradouro);
                    document.getElementById('bairro').value=(conteudo.bairro);
                    document.getElementById('cidade').value=(conteudo.localidade);
                    document.getElementById('uf').value=(conteudo.uf);
                    document.getElementById('ibge').value=(conteudo.ibge);
                } //end if.
                else {
                    //CEP não Encontrado.
                    limpa_formulário_cep();
                    alert("CEP não encontrado.");
                }
            }
                
            function pesquisacep(valor) {

                //Nova variável "cep" somente com dígitos.
                var cep = valor.replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        document.getElementById('rua').value="...";
                        document.getElementById('bairro').value="...";
                        document.getElementById('cidade').value="...";
                        document.getElementById('uf').value="...";

                        //Cria um elemento javascript.
                        var script = document.createElement('script');

                        //Sincroniza com o callback.
                        script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                        //Insere script no documento e carrega o conteúdo.
                        document.body.appendChild(script);

                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        alert("Formato de CEP inválido.");
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            };

            </script>
        
    </head>
    <body>
        <div class="container">
            <div class="form-group">
            
                <form method="POST" action="users" class="form">
                    @csrf
                    <h1>Cadastro de Usuários</h1>
                    <p>Preencha o formulário para criar um novo usuário.</p>
                    <hr>

                    @if(Session::has('success'))

                        <div class="alert alert-success" id="alert">
                            <strong>Success:</strong> {{Session::get('success')}}
                        </div>
                    @endif
                    
                    <label for=”name”>Nome:</label>
                    <input name="name" type="text" class=”form-control” placeholder="Nome completo"required>

                    <label for=”email”>Email:</label>
                    <input name="email" type="text" class=”form-control” placeholder="usuario@dominio.com"required>
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <label for=”telefone”>Telefone:</label>
                    <input name="telefone" type="text" class=”form-control” placeholder="(99) 99999-9999" required>
                    
                    <label for=”cep”>Cep:</label>
                    <input name="cep" type="text" class=”form-control” placeholder="99999-999"  size="10" maxlength="9"
               onblur="pesquisacep(this.value);" required>

                    <label for=”rua”>Rua:</label>
                    <input name="rua" id="rua" type="text" class=”form-control” placeholder=""required>

                    <label for=”numero”>Número:</label>
                    <input name="numero" id="numero" type="text" class=”form-control” placeholder=""required>

                    <label for=”bairro”>Bairro:</label>
                    <input name="bairro" id="bairro" type="text" class=”form-control” placeholder=""required>

                    <label for=”cidade”>Cidade:</label>
                    <input name="cidade" id="cidade" type="text" class=”form-control” placeholder=""required>

                    <label for=”uf”>Estado:</label>
                    <input name="uf" id="uf" type="text" class=”form-control” placeholder=""required>

                    <label for="password"><b>Senha (Mínimo 6 Caracteres)</b></label>
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
