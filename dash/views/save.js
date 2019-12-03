function save() {
    var empresa_id;
    var solucao;
    var descricao;
    var termo;
    var preferencia;
    var nome;
    var nome_social;
    var sexo_id;
    var email;
    var cpf;
    var rg;
    var orgao_emissor;
    var logradouro;
    var numero;
    var complemento;
    var bairro;
    var cep;
    var cidade;
    var estado;
    var procon_id;
    var cpf_frente;
    var cpf_verso;
    var rg_frente;
    var rg_verso;
    var comprovante_endereco;
    var documento1;
    var documento2;
    var documento3;

    empresa_id = document.getElementById('empresa_id').value;
    solucao = document.getElementById('solucao').value;
    descricao = document.getElementById('descricao').value;
    termo = document.getElementById('termo').value;
    preferencia = document.getElementById('preferencia').value;
    nome = document.getElementById('nome').value;
    nome_social = document.getElementById('nome_social').value;
    sexo_id = document.getElementById('sexo_id').value;
    email = document.getElementById('email').value;
    cpf = document.getElementById('cpf').value;
    rg = document.getElementById('rg').value;
    orgao_emissor = document.getElementById('orgao_emissor').value;
    logradouro = document.getElementById('logradouro').value;
    numero = document.getElementById('numero').value;
    complemento = document.getElementById('complemento').value;
    bairro = document.getElementById('bairro').value;
    cep = document.getElementById('cep').value;
    cidade = document.getElementById('cidade').value;
    estado = document.getElementById('estado').value;
    procon_id = document.getElementById('procon_id').value;
    cpf_frente = document.getElementById('cpf_frente').value;
    cpf_verso = document.getElementById('cpf_verso').value;
    rg_frente = document.getElementById('rg_frente').value;
    rg_verso = document.getElementById('rg_verso').value;
    comprovante_endereco = document.getElementById('comprovante_endereco').value;
    documento1 = document.getElementById('documento1').value;
    documento2 = document.getElementById('documento2').value;
    documento3 = document.getElementById('documento3').value;

    $.post("api.proconvoce.com.br/api/reclamacao_individual.php",
        {
            empresa_id: empresa_id,
            solucao: solucao,
            descricao: descricao,
            preferencia: preferencia,
            nome: nome,
            nome_social: nome_social,
            sexo_id: sexo_id,
            email: email,
            cpf: cpf,
            rg: rg,
            orgao_emissor: orgao_emissor,
            logradouro: logradouro,
            numero: numero,
            complemento: complemento,
            bairro: bairro,
            cep: cep,
            cidade: cidade,
            estado: estado,
            procon_id: procon_id,
            cpf_frente: cpf_frente,
            cpf_verso: cpf_verso,
            rg_frente: rg_frente,
            rg_verso: rg_verso,
            comprovante_endereco: comprovante_endereco,
            documento1: documento1,
            documento2: documento2,
            documento3: documento3
        },
        function (data) {
            console.log(data.empresa_id);
            console.log(data.solucao);
            console.log(data.descricao);
            console.log(data.termo);
            console.log(data.preferencia);
            console.log(data.nome);
            console.log(data.nome_social);
            console.log(data.sexo_id);
            console.log(data.email);
            console.log(data.cpf);
            console.log(data.rg);
            console.log(data.orgao_emissor);
            console.log(data.logradouro);
            console.log(data.numero);
            console.log(data.complemento);
            console.log(data.bairro);
            console.log(data.cep);
            console.log(data.procon_id);
            console.log(data.cpf_frente);
            console.log(data.cpf_verso);
            console.log(data.rg_frente);
            console.log(data.rg_verso);
            console.log(data.comprovante_endereco);
            console.log(data.documento1);
            console.log(data.documento2);
            console.log(data.documento3);
        },
        "json"
    );
}