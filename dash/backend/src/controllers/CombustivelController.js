const axios = require('axios')

class Item {
    constructor(nome, preco, fornecedor, dataPesquisa) {
        this.nome = nome;
        this.preco = preco;
        this.fornecedor = fornecedor;
        this.data = dataPesquisa;
    }
}

module.exports = {
    async index(req, res) {
        const response = await axios.get('http://itajuba.myscriptcase.com/scriptcase/devel/conf/grp/Procon/libraries/php/pesquisa_total.php?id=3&qtde=5');

        const vetorDeItems = [];
        const pesquisa_total = response.data.pesquisa_total[0];
        const ids = [13,16,17,7,129,15,8,130,14];
        
        pesquisa_total.pesquisas.forEach(pesquisa => {
            let dataPesquisa = pesquisa.data_publicacao;
            pesquisa.items.forEach(item => {
                let itemLocal = new Item();
                if (item.produto_id == 13 || item.produto_id == 16 || item.produto_id == 17 || item.produto_id == 7 || item.produto_id == 129 || item.produto_id == 15 || item.produto_id == 8 || item.produto_id == 130 || item.produto_id == 14) {
                    itemLocal.nome = item.nome_produto;
                    itemLocal.fornecedor = item.indices['fornecedor_menor'];
                    itemLocal.preco = item.indices['menor_preco'];
                    itemLocal.data = dataPesquisa;
                    itemLocal.diferenca_menor_maior = item.indices['diferenca_menor_maior'];
                    itemLocal.idp = item.produto_id;
                    vetorDeItems.push(itemLocal);
                }
                console.log( itemLocal );
            });
        });

        return (res.json(vetorDeItems))
    }

}