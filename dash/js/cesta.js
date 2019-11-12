$(window).on('load', async () => {
    loadTableData('cesta');
    btnArea();
})
$('#escolha').on('click', (e) => {
    $('#escolhaInfo').toggleClass('hide');

})

async function loadTableData(query) {
    var url = `http://localhost:3333/${query}`;
    let i = 0;
    return await $.get(url, (data) => {
        $.each(data.ranking_cesta, function (key, value) {
            if(key < 3){
                makeDisplay('#displayRanking', value);
            }
        });
        $.each(data.cesta_barata.items, function (aux_key, aux_value) {
            $.each(data.cesta_barata.items[aux_key], function (key, value) {
                makeCards('#cardsArea', value);
            });
        });
        $('#preloader').fadeOut(500, function() { $(this).remove(); });
    })
}
function makeDisplay(displayName, value) {
    value.nome_fornecedor = value.nome_fornecedor.replace('SUPERMERCADO', '');
    let tag = `
    <div class='rank-item'>
        <h4 class='mt-4'>${value.nome_fornecedor}</h4>
        <h5>R$${value.preco}</h5>
    </div>
`
    $(displayName).append(tag);
}
function makeTable(tableName, value) {
    let tag = `<tr><td>${value.nome_fornecedor}</td><td>${value.produto}</td><td>${value.preco}</td></tr>`;
    $(tableName).append(tag);
}

function makeCards(cardsArea, value) {
    let tag = `
<div class="col-lg-4">
<div class="card mb-4 cardces" id='${value.produto}Card'>
    <div class="card-body">
        <div class="text-center">
                <h4 class="card-title">${value.produto}</h4>
                <h3 class="card-title text-center">R$${value.preco}</h3>
                <h6 class="card-title">${value.nome_fornecedor}</h6>
        </div>
    </div>
</div>
</div>
`

    $(cardsArea).append(tag);
}
