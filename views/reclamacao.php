<!-- Modelo Procon SP: -->
<!-- Área para cadastrar consumidor:
        PESSOA:
            'Deseja incluir Nome Social' (Decreto nº8.727/2016) - Se sim: Nome Social e Gênero (Masculinidade ou Feminilidade),

            'Pessoa com deficiência?' - Se sim: Tipo de Deficiência,
    -->
<!-- Registro de Atendimento - Reclamação:

            Sou titular da compra ou contratação (Checkbox)
            "Apenas o titular da compra ou contratação, poderá solicitar uma reclamação na internet. Se você não for o titular desta solicitação, deverá ir a um de nossos postos nos Poupatempos com uma procuração"

            Identificação:
            https://prnt.sc/pbv0b0
-->

<!-- https://gomoodie.com/reclamacao.php --> 

<!DOCTYPE html>
<html lang="en">
    
<head>
    <!-- Required Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="../img/favicon.ico">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Procon - Reclamação</title>
    <!-- fontawesome -->
    <script src="../vendor/fontawesome-free/js/all.js"></script>
    <script src="https://kit.fontawesome.com/4a9647b8f2.js" crossorigin="anonymous"></script>

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <!-- Javascript - Autocomplete CEP -->
    <script type="text/javascript" >
        //Endereço do Consumidor
        $(document).ready(function() {

            function limpa_formulário_cep() {
                // Limpa valores do formulário de CEP.
                $("#logradouro-consumidor").val("");
                $("#bairro-consumidor").val("");
                $("#cidade-consumidor").val("");
                $("#estado-consumidor").val("");
            }
            
            //Quando o campo CEP perde o foco.
            $("#cep-consumidor").blur(function() {

                //Nova variável "CEP" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo CEP possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#logradouro-consumidor").val("Preenchendo...");
                        $("#bairro-consumidor").val("Preenchendo...");
                        $("#cidade-consumidor").val("Preenchendo...");
                        $("#estado-consumidor").val("Preenchendo...");

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#cep-consumidor").removeClass("is-invalid");
                                $("#cep-consumidor").addClass("is-valid");
                                $("#logradouro-consumidor").removeClass("is-invalid");
                                $("#logradouro-consumidor").addClass("is-valid");
                                $("#logradouro-consumidor").val(dados.logradouro);
                                $("#bairro-consumidor").removeClass("is-invalid");
                                $("#bairro-consumidor").addClass("is-valid");
                                $("#bairro-consumidor").val(dados.bairro);
                                $("#cidade-consumidor").removeClass("is-invalid");
                                $("#cidade-consumidor").addClass("is-valid");
                                $("#cidade-consumidor").val(dados.localidade);
                                $("#estado-consumidor").removeClass("is-invalid");
                                $("#estado-consumidor").addClass("is-valid");
                                $("#estado-consumidor").val(dados.uf);
                            }
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                alert("Erro: CEP não encontrado.");
                                $("#cep-consumidor").removeClass("is-valid");
                                $("#cep-consumidor").addClass("is-invalid");
                                $("#logradouro-consumidor").removeClass("is-valid");
                                $("#logradouro-consumidor").addClass("is-invalid");
                                $("#bairro-consumidor").removeClass("is-valid");
                                $("#bairro-consumidor").addClass("is-invalid");
                                $("#cidade-consumidor").removeClass("is-valid");
                                $("#cidade-consumidor").addClass("is-invalid");
                                $("#estado-consumidor").removeClass("is-valid");
                                $("#estado-consumidor").addClass("is-invalid");
                            }
                        });
                    }
                    else {
                        //CEP é inválido.
                        limpa_formulário_cep();
                        alert("Erro: Formato de CEP inválido.");
                        $("#cep-consumidor").removeClass("is-valid");
                        $("#cep-consumidor").addClass("is-invalid");
                        $("#logradouro-consumidor").removeClass("is-valid");
                        $("#logradouro-consumidor").addClass("is-invalid");
                        $("#bairro-consumidor").removeClass("is-valid");
                        $("#bairro-consumidor").addClass("is-invalid");
                        $("#cidade-consumidor").removeClass("is-valid");
                        $("#cidade-consumidor").addClass("is-invalid");
                        $("#estado-consumidor").removeClass("is-valid");
                        $("#estado-consumidor").addClass("is-invalid");
                    }
                }
                else {
                    //CEP sem valor, limpa formulário.
                    $("#cep-consumidor").removeClass("is-valid");
                    $("#logradouro-consumidor").removeClass("is-valid");
                    $("#bairro-consumidor").removeClass("is-valid");
                    $("#cidade-consumidor").removeClass("is-valid");
                    $("#estado-consumidor").removeClass("is-valid");
                    $("#cep-consumidor").removeClass("is-invalid");
                    $("#logradouro-fornecedor").removeClass("is-invalid");
                    $("#bairro-consumidor").removeClass("is-invalid");
                    $("#cidade-consumidor").removeClass("is-invalid");
                    $("#estado-consumidor").removeClass("is-invalid");
                    limpa_formulário_cep();
                }
            });
        });
        
        //Endereço do Fornecedor
        $(document).ready(function() {

            // Limpa valores do formulário.
            function limpa_formulário_cep() {
                $("#logradouro-fornecedor").val("");
                $("#bairro-fornecedor").val("");
                $("#cidade-fornecedor").val("");
                $("#estado-fornecedor").val("");
            }

            //Quando o campo CEP perde o foco.
            $("#cep-fornecedor").blur(function() {

                //Nova variável "CEP" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo CEP possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#logradouro-fornecedor").val("Preenchendo...");
                        $("#bairro-fornecedor").val("Preenchendo...");
                        $("#cidade-fornecedor").val("Preenchendo...");
                        $("#estado-fornecedor").val("Preenchendo...");

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#cep-fornecedor").removeClass("is-invalid");
                                $("#cep-fornecedor").addClass("is-valid");
                                $("#logradouro-fornecedor").removeClass("is-invalid");
                                $("#logradouro-fornecedor").addClass("is-valid");
                                $("#logradouro-fornecedor").val(dados.logradouro);
                                $("#bairro-fornecedor").removeClass("is-invalid");
                                $("#bairro-fornecedor").addClass("is-valid");
                                $("#bairro-fornecedor").val(dados.bairro);
                                $("#cidade-fornecedor").removeClass("is-invalid");
                                $("#cidade-fornecedor").addClass("is-valid");
                                $("#cidade-fornecedor").val(dados.localidade);
                                $("#estado-fornecedor").removeClass("is-invalid");
                                $("#estado-fornecedor").addClass("is-valid");
                                $("#estado-fornecedor").val(dados.uf);
                            } else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                alert("Erro: CEP não encontrado.");
                                $("#cep-fornecedor").removeClass("is-valid");
                                $("#cep-fornecedor").addClass("is-invalid");
                                $("#logradouro-fornecedor").removeClass("is-valid");
                                $("#logradouro-fornecedor").addClass("is-invalid");
                                $("#bairro-fornecedor").removeClass("is-valid");
                                $("#bairro-fornecedor").addClass("is-invalid");
                                $("#cidade-fornecedor").removeClass("is-valid");
                                $("#cidade-fornecedor").addClass("is-invalid");
                                $("#estado-fornecedor").removeClass("is-valid");
                                $("#estado-fornecedor").addClass("is-invalid");
                            }
                        });
                    } else {
                        //CEP é inválido.
                        limpa_formulário_cep();
                        alert("Erro: Formato de CEP inválido.");
                        $("#cep-fornecedor").removeClass("is-valid");
                        $("#cep-fornecedor").addClass("is-invalid");
                        $("#logradouro-fornecedor").removeClass("is-valid");
                        $("#logradouro-fornecedor").addClass("is-invalid");
                        $("#bairro-fornecedor").removeClass("is-valid");
                        $("#bairro-fornecedor").addClass("is-invalid");
                        $("#cidade-fornecedor").removeClass("is-valid");
                        $("#cidade-fornecedor").addClass("is-invalid");
                        $("#estado-fornecedor").removeClass("is-valid");
                        $("#estado-fornecedor").addClass("is-invalid");
                    }
                } else {
                    //CEP sem valor, limpa formulário.
                    $("#cep-fornecedor").removeClass("is-valid");
                    $("#logradouro-fornecedor").removeClass("is-valid");
                    $("#bairro-fornecedor").removeClass("is-valid");
                    $("#cidade-fornecedor").removeClass("is-valid");
                    $("#estado-fornecedor").removeClass("is-valid");
                    $("#cep-fornecedor").removeClass("is-invalid");
                    $("#logradouro-fornecedor").removeClass("is-invalid");
                    $("#bairro-fornecedor").removeClass("is-invalid");
                    $("#cidade-fornecedor").removeClass("is-invalid");
                    $("#estado-fornecedor").removeClass("is-invalid");
                    limpa_formulário_cep();
                }
            });
        });
    </script>

    <!-- <script>
        // http://itajuba.myscriptcase.com/scriptcase/devel/conf/grp/Procon/libraries/php/fornecedor_detalhe.php?id=44
        $(document).ready(function() {
            function limpa_formulário() {
                $("#idEmpresa").val("");
                $("#nomeEmpresa").val("");
            }

            $("#idEmpresa").blur(function() {
                var id = $(this).val().replace(/\D/g, '');
                if (id != "") {
                
                    $("#nomeEmpresa").val("Preenchendo...");
                    

                    $.getJSON("http://itajuba.myscriptcase.com/scriptcase/devel/conf/grp/Procon/libraries/php/fornecedor_detalhe.php?id="+ id, function(data) {

                        if (!("erro" in data)) {

                            var dados = JSON.parse(data);

                            $("#nomeEmpresa").val(dados.fornecedor_detalhe);

                        } else {

                            limpa_formulário();

                            alert("Erro: ID não encontrado.");
                        }
                    });
                } else {
                    limpa_formulário();
                }
            });

        });
    </script> -->

    <!-- Abrir Modal -->
    <script type="text/javascript">
        $(function(){
            $('#modalExemplo').modal('show');
        });
    </script>

    <!-- CSS -->
    <style>
        .icon {
            float: right;
            font-size: 24px
        }

        .icon:hover{
            animation: shake 0.82s cubic-bezier(.36,.07,.19,.97) both;
            transform: translate3d(0, 0, 0);
            backface-visibility: hidden
        }

        @keyframes shake {
            10%, 90% {
                transform: translate3d(-0.5px, 0, 0);
            }
            
            20%, 80% {
                transform: translate3d(0.5px, 0, 0);
            }

            30%, 50%, 70% {
                transform: translate3d(-1px, 0, 0);
            }

            40%, 60% {
                transform: translate3d(1px, 0, 0);
            }
        }

        .form-control.is-valid, .was-validated .form-control:valid, .form-control.is-invalid, .was-validated .form-control:invalid{
            background-image:none!important
        }

        .nav-tabs .nav-link{
            border-color: #dee2e6 !important
        }

        .nav-tabs .nav-link.active{
            border-color: #dee2e6 #dee2e6 #fff !important;
            font-weight: bold;
        }

    </style>
</head>
    
<body>
      
    <!-- Modal -->
    <div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmação de Titular</h5>
                </div>
                <form>
                    <div class="modal-body">            
                        <!-- Titular da Compra? -->
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id='titular' required>
                            <label for="titular" class="form-check-label">Sou titular da compra ou contratação <span class='text-danger'><b>*</b></span></label>                                    
                        </div>
                        <small id='titular' class="form-text text-muted text-justify pb-2">Apenas o titular da compra ou contratação poderá solicitar uma reclamação na internet. Se você não for o titular desta solicitação, deverá ir a um de nossos postos nos Poupatempos com uma procuração.</small>    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Continuar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container justify-content-center p-0">
        <div class="card">
            <div class="card-header text-white text-center bg-dark font-weight-bold">
                FORMULÁRIO DE RECLAMAÇÃO
            </div>
            <div class="card-body">
                <!-- Nav Tabs -->
                <ul class="nav nav-tabs justify-content-center">
                    <li class="nav-item px-1">
                        <a class="nav-link active" data-toggle="tab" href="#consumidor"><i class="fas fa-user"></i></a>
                    </li>
                    <li class="nav-item px-1">
                        <a class="nav-link" data-toggle="tab" href="#fornecedor"><i class="fas fa-store"></i></a>
                    </li>
                    <li class="nav-item px-1">
                        <a class="nav-link" data-toggle="tab" href="#detalhes"><i class="far fa-edit"></i></a>
                    </li>
                </ul>

                <!-- Tab Panes -->
                <div class="tab-content">
                    <!-- Consumidor -->
                    <div class="tab-pane container active pt-3 px-0" id="consumidor">
                        <form>
                            <div class="row">
                                <form>
                                    <!-- Dados -->
                                    <div class="col-12 col-sm-12 col-lg-6">
                                        <div class="card mb-2">
                                            <div class="card-header bg-danger text-white font-weight-bold">Dados do Consumidor<i class="icon far fa-address-card"></i></div>
                                            <div class="card-body">
                                                <!-- Email -->
                                                <div class="form-group">
                                                    <label for="email">Endereço de Email</label>
                                                    <input type="email" class="form-control" id='email' aria-describedby="emailHelp" value="exemplo@gmail.com" readonly>
                                                </div>
                                                <!-- Nome Completo -->
                                                <div class="form-group">
                                                    <label for="nomeCompleto">Nome Completo <span class='text-danger'><b>*</b></span></label>
                                                    <input type="text" class="form-control" id='nomeCompleto' required>
                                                </div>
                                                <!-- Sexo -->
                                                <div class="form-group">
                                                    <label for="sexo">Sexo <span class='text-danger'><b>*</b></span></label>
                                                    <select id="sexo" class="form-control" required>
                                                        <option selected disabled></option>
                                                        <option>Feminino</option>
                                                        <option>Masculino</option>
                                                    </select>
                                                </div>
                                                <!-- Nome Social -->
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id='nomeSocial'>
                                                    <label for="nomeSocial" class="form-check-label mb-3">Deseja incluir nome social? <a href="http://www.planalto.gov.br/ccivil_03/_ato2015-2018/2016/decreto/D8727.htm">(Decreto nº 8.727/2016)</a></label>
                                                </div>
                                                <!-- Nome Completo Social -->
                                                <!-- <div class="form-group">
                                                    <label for="nomeCompletoSocial">Nome Completo <span class='text-danger'><b>*</b></span></label>
                                                    <input type="text" class="form-control" id='nomeCompletoSocial' placeholder='Digite seu nome social completo' required>
                                                </div> -->
                                                <!-- Gênero Social -->
                                                <!-- <div class="form-group">
                                                    <label for="genero">Gênero <span class='text-danger'><b>*</b></span></label>
                                                    <select id="genero" class="form-control" required>
                                                        <option selected disabled>Selecione uma opção</option>
                                                        <option>Feminilidade</option>
                                                        <option>Masculinidade</option>
                                                    </select>
                                                </div> -->
                                                <!-- CPF (Falta validação) -->
                                                <div class="form-group">
                                                    <label for="cpf">CPF <span class='text-danger'><b>*</b></span></label>
                                                    <input type="text" class='form-control' id="cpf" placeholder="###.###.###-##" required>
                                                </div>
                                                <!-- Informações RG (Falta validação) -->
                                                <div class="row">
                                                    <div class="col-12">
                                                        <!-- Número do RG -->
                                                        <div class="form-group">
                                                            <label for="rg">RG</label>
                                                            <input type="text" class='form-control' id='rg'>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <!-- UF Emissão -->
                                                        <div class="form-group">
                                                            <label for="ufEmissao">UF Emissão</label>
                                                            <select id="ufEmissao" class="form-control"
                                                                aria-describedby="ufEmissao">
                                                                <option selected disabled></option>
                                                                <option value="AC">Acre</option>
                                                                <option value="AL">Alagoas</option>
                                                                <option value="AP">Amapá</option>
                                                                <option value="AM">Amazonas</option>
                                                                <option value="BA">Bahia</option>
                                                                <option value="CE">Ceará</option>
                                                                <option value="DF">Distrito Federal</option>
                                                                <option value="ES">Espirito Santo</option>
                                                                <option value="GO">Goiás</option>
                                                                <option value="MA">Maranhão</option>
                                                                <option value="MS">Mato Grosso do Sul</option>
                                                                <option value="MT">Mato Grosso</option>
                                                                <option value="MG">Minas Gerais</option>
                                                                <option value="PA">Pará</option>
                                                                <option value="PB">Paraíba</option>
                                                                <option value="PR">Paraná</option>
                                                                <option value="PE">Pernambuco</option>
                                                                <option value="PI">Piauí</option>
                                                                <option value="RJ">Rio de Janeiro</option>
                                                                <option value="RN">Rio Grande do Norte</option>
                                                                <option value="RS">Rio Grande do Sul</option>
                                                                <option value="RO">Rondônia</option>
                                                                <option value="RR">Roraima</option>
                                                                <option value="SC">Santa Catarina</option>
                                                                <option value="SP">São Paulo</option>
                                                                <option value="SE">Sergipe</option>
                                                                <option value="TO">Tocantins</option>
                                                            </select>
                                                            <small id='ufEmissao' class="form-text text-muted">Digite o estado brasileiro que seu RG foi emitido.</small>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <!-- Orgão Emissor -->
                                                        <div class="form-group">
                                                            <label for="orgaoEmissor">Orgão Emissor</label>
                                                            <input type="text" class="form-control" id='orgaoEmissor'>
                                                            <small id='orgaoEmissor' class="form-text text-muted">Digite o orgão responsável pela emissão do RG.</small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Data de Nascimento -->
                                                <div class="form-group">
                                                    <label for="dataNascimento">Data de Nascimento <span
                                                            class='text-danger'><b>*</b></span></label>
                                                    <input type="date" class='form-control' id='dataNascimento' required>
                                                </div>                                           
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Endereço e Resposta-->
                                    <div class="col-12 col-sm-12 col-lg-6">
                                        <div class="card mb-2">
                                            <div class="card-header bg-primary text-white font-weight-bold">Endereço do Consumidor<i class="icon fas fa-map-marker-alt"></i></div>
                                            <div class="card-body">
                                                <!-- CEP -->
                                                <div class="form-group">
                                                    <label for="cep-consumidor">CEP <span class='text-danger'><b>*</b></span></label>
                                                    <input name='cep-consumidor' type="text" aria-describedby="cep-consumidor" class='form-control' id='cep-consumidor' required>
                                                    <small id='cep-consumidor' class="form-text text-muted">Insira o seu CEP para completar os demais campos.</small>
                                                </div>
                                                <!-- Estado -->
                                                <div class="form-group">
                                                    <label for="estado-consumidor">Estado <span class='text-danger'><b>*</b></span></label>
                                                    <input type="text" class='form-control' id='estado-consumidor' placeholder="Estado" required readonly>
                                                </div>
                                                <!-- Cidade -->
                                                <div class="form-group">
                                                    <label for="cidade-consumidor">Cidade <span class='text-danger'><b>*</b></span></label>
                                                    <input name='cidade-consumidor' type="text" class='form-control' id='cidade-consumidor' placeholder="Cidade" required readonly>
                                                </div>
                                                <!-- Bairro -->
                                                <div class="form-group">
                                                    <label for="bairro-consumidor">Bairro <span class='text-danger'><b>*</b></span></label>
                                                    <input name='bairro-consumidor' type="text" class='form-control' id='bairro-consumidor' placeholder="Bairro" required readonly>
                                                </div>
                                                <!-- Logradouro e Número -->
                                                <div class="row">
                                                    <div class="col-8">
                                                        <!-- Logradouro -->
                                                        <div class="form-group">
                                                            <label for="logradouro-consumidor">Logradouro <span class='text-danger'><b>*</b></span></label>
                                                            <input name='logradouro-consumidor' type="text" class='form-control' id='logradouro-consumidor' placeholder="Logradouro" required readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <!-- Número da Casa -->
                                                        <div class="form-group">
                                                            <label for="numero">Número <span class='text-danger'><b>*</b></span></label>
                                                            <input type="number" class='form-control' id='numero' required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Complemento -->
                                                <div class="form-group">
                                                    <label for="complemento">Complemento</label>
                                                    <input type="text" class='form-control' id='complemento'>
                                                </div>
                                                <!-- Telefones -->
                                                <div class="row">
                                                    <div class="col-6">
                                                        <!-- Telefone Fixo -->
                                                        <div class="form-group">
                                                            <label for="telefoneFixo">Telefone Fixo</label>
                                                            <input type="text" class='form-control' id='telefoneFixo'>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <!-- Telefone Celular -->
                                                        <div class="form-group">
                                                            <label for="telefoneCelular">Telefone Celular</label>
                                                            <input type="text" class='form-control' id='telefoneCelular'>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </form>
                    </div>
                    <!-- Fornecedor -->
                    <div class="tab-pane container fade pt-3 px-0" id="fornecedor">
                        <div class="row">
                            <!-- Dados -->
                            <div class="col-12 col-sm-12 col-lg-6">
                                <div class="card">
                                    <div class="card-header bg-danger text-white font-weight-bold">
                                        Dados do Fornecedor<i class="icon far fa-address-card"></i>
                                    </div>
                                    <div class="card-body">
                                        <!-- Classificação -->
                                        <div class="form-group">
                                            <label for="classificacao">Classificação <span class='text-danger'><b>*</b></span></label>
                                            <select id="classificacao" class="form-control" required>
                                                <option selected disabled>Selecione</option>
                                                <option>Água, Energia e Gás</option>
                                                <option>Alimentos</option>
                                                <option>Demais Produtos</option>
                                                <option>Demais Serviços</option>
                                                <option>Educação</option>
                                                <option>Habitação</option>
                                                <option>Produtos Automotivos</option>
                                                <option>Produtos de Telefonia e Informática</option>
                                                <option>Produtos Eletrodomésticos e Eletrônicos</option>
                                                <option>Saúde</option>
                                                <option>Serviços Financeiros</option>
                                                <option>Telecomunicações</option>
                                                <option>Transportes</option>
                                                <option>Turismo/Viagens</option>
                                            </select>
                                        </div>
                                        <!-- ID da Empresa -->
                                        <div class="form-group">
                                            <label for="idEmpresa">ID da Empresa</label>
                                            <input type='text' name='idEmpresa' class='form-control' id='idEmpresa'>
                                        </div>
                                        <?php
                                            $idEmpresa = $_GET['idEmpresa'];

                                            $url = file_get_contents("http://itajuba.myscriptcase.com/scriptcase/devel/conf/grp/Procon/libraries/php/fornecedor_detalhe.php?id=44");

                                            $json = json_decode($url, true);

                                            $fornecedor_detalhe = $json['fornecedor_detalhe'];
                                            $nome_fornecedor = $fornecedor_detalhe['nome_fornecedor'];
                                            $tipo = $fornecedor_detalhe['tipo'];
                                            $rua = $fornecedor_detalhe['rua'];
                                            $bairro = $fornecedor_detalhe['bairro'];
                                            $email = $fornecedor_detalhe['email'];
                                            $telefone = $fornecedor_detalhe['telefone'];
                                        ?>
                                        <!-- Nome da Empresa -->
                                        <div class="form-group">
                                            <label for="nomeEmpresa">Nome da Empresa  <span class='text-danger'><b>*</b></span></label>
                                            <?php echo "<input type='text' class='form-control' id='nomeEmpresa' required>";?>
                                        </div>                                        
                                        <!-- Nome Fantasia -->
                                        <div class="form-group">
                                            <label for="nomeFantasia">Nome Fantasia</label>
                                            <?php echo "<input type='text' value='$nome_fornecedor' class='form-control' id='nomeFantasia'>"; ?>
                                        </div>                                        
                                        <div class="row">
                                            <div class="col-8">
                                                <!-- Email -->
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <?php echo "<input type='text' value='$email' class='form-control' id='email'>"; ?>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <!-- Telefone -->
                                                <div class="form-group">
                                                    <label for="telefone">Telefone</label>
                                                    <input type="text" class="form-control" id='telefone'>                                        
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Site -->
                                        <div class="form-group">
                                            <label for="site">Site</label>
                                            <input type="text" class="form-control" id='site'>                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Endereço-->
                            <div class="col-12 col-sm-12 col-lg-6">
                                <div class="card mb-2">
                                    <div class="card-header bg-primary text-white font-weight-bold">
                                        Endereço do Fornecedor<i class="icon fas fa-map-marker-alt"></i>
                                    </div>
                                    <div class="card-body">
                                        <form>
                                            <!-- CEP -->
                                            <div class="form-group">
                                                <label for="cep-fornecedor">CEP <span class='text-danger'><b>*</b></span></label>
                                                <input name='cep-fornecedor' type="text" aria-describedby="cep-fornecedor" class='form-control' id='cep-fornecedor' required>
                                                <small id='cep-fornecedor' class="form-text text-muted">Insira o seu CEP para completar os demais campos.</small>
                                            </div>
                                            <!-- Estado -->
                                            <div class="form-group">
                                                <label for="estado-fornecedor">Estado <span class='text-danger'><b>*</b></span></label>
                                                <input type="text" class='form-control' id='estado-fornecedor' placeholder="Estado" required readonly>
                                            </div>
                                            <!-- Cidade -->
                                            <div class="form-group">
                                                <label for="cidade-fornecedor">Cidade <span class='text-danger'><b>*</b></span></label>
                                                <input name='cidade-fornecedor' type="text" class='form-control' id='cidade-fornecedor' placeholder="Cidade" required readonly>
                                            </div>
                                            <!-- Bairro -->
                                            <div class="form-group">
                                                <label for="bairro-fornecedor">Bairro <span class='text-danger'><b>*</b></span></label>
                                                <?php echo "<input name='bairro-fornecedor' value='$bairro' type='text' class='form-control' id='bairro-fornecedor' placeholder='Bairro' required readonly>"; ?>
                                            </div>
                                            <!-- Logradouro e Número -->
                                            <div class="row">
                                                <div class="col-8">
                                                    <!-- Logradouro -->
                                                    <div class="form-group">
                                                        <label for="logradouro-fornecedor">Logradouro <span class='text-danger'><b>*</b></span></label>
                                                        <?php echo "<input name='logradouro-fornecedor' value='$rua' type='text' class='form-control' id='logradouro-fornecedor' placeholder='Logradouro' required readonly>"; ?>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <!-- Número da Casa -->
                                                    <div class="form-group">
                                                        <label for="numero">Número <span class='text-danger'><b>*</b></span></label>
                                                        <input type="number" class='form-control' id='numero' required>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Complemento -->
                                            <div class="form-group">
                                                <label for="complemento">Complemento</label>
                                                <input type="text" class='form-control' id='complemento' required>
                                            </div>
                                            <!-- Telefones -->
                                            <div class="form-group">
                                                <label for="telefoneCelular">Telefone Celular</label>
                                                <?php echo "<input type='text' value='$telefone' class='form-control' id='telefoneCelular'>"; ?>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>                                
                    </div>
                    <!-- Detalhes -->
                    <div class="tab-pane container fade pt-3 px-0" id="detalhes">
                        <div class="row justify-content-center">
                            <!-- Dados -->
                            <div class="col-12 col-sm-12 col-lg-6">
                                <div class="card mb-2">
                                    <div class="card-header bg-danger text-white font-weight-bold">Detalhes da Reclamação<i class="icon fas fa-info-circle"></i></div>
                                    <div class="card-body">
                                        <!-- Data da Ocorrência -->
                                        <div class="form-group">
                                            <label for="dataOcorrencia">Data da Ocorrência <span class='text-danger'><b>*</b></span></label>
                                            <input type="date" class='form-control' id='dataOcorrencia' required>
                                        </div>
                                        <!-- Detalhes -->
                                        <div class="form-group">
                                            <label for="detalhes">Descreva em detalhes sua reclamação <span class='text-danger'><b>*</b></span></label>
                                            <textarea name='detalhes' class="form-control" id="detalhes" rows="7" maxlength="2000" required></textarea>
                                            <small class="caracteres"></small>
                                        </div>
                                        <!-- Pedido -->
                                        <div class="form-group">
                                            <label for="pedido">Pedido <span class='text-danger'><b>*</b></span></label>
                                            <select id="pedido" class="form-control" required>
                                                <option selected disabled></option>
                                                <option>Abatimento/Reembolso de valores cobrados indevidamente (serviços, taxas, etc.)</option>
                                                <option>Cancelamento/Revisão (contrato/multa) e devolução do valor pago indevidamente</option>
                                                <option>Disponibilização/restabelecimento imediato do serviço</option>
                                                <option>Indenização por danos decorrentes da má prestação do serviço (queima de aparelho, perda de alimentos, vazamento da rede de água/gás, etc.)</option>
                                                <option>Revisão das faturas e devolução dos valores pagos pelo período em que o serviço esteve indisponível</option>
                                                <option>Outros (exceto indenização por danos morais, que só podem ser solicitados por meio de ação judicial)</option>
                                            </select>
                                        </div>
                                        <!-- Anexos -->
                                        <div class="form-group">
                                            <label for="anexos">Anexos</label><br>
                                            <input id='anexos' type="file">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="menu"></div>

    <script>
        $(document).ready(function() {
            $('.menu').load('menu.html');
        });
    </script>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../vendor/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- Contador de Caracteres -->
    <script>
        $(document).on("input", "#detalhes", function() {
        var limite = 2000;
        var informativo = "caracteres restantes.";
        var caracteresDigitados = $(this).val().length;
        var caracteresRestantes = limite - caracteresDigitados;

        if (caracteresRestantes <= 0) {
            var detalhes = $("textarea[name=detalhes]").val();
            $("textarea[name=detalhes]").val(detalhes.substr(0, limite));
            $(".caracteres").text("0 " + informativo);
        } else {
            $(".caracteres").text(caracteresRestantes + " " + informativo);
        }
    });
    </script>
</body>

</html>