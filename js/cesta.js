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
    })
}
function makeDisplay(displayName, value) {
    let tag = `
    <div class=''>
        <h4 class='mt-4'>R$${value.preco}</h4>
        <span>${value.nome_fornecedor}</span>
    </div>
`
    $(displayName).append(tag);
}
function makeTable(tableName, value) {
    let tag = `<tr><td>${value.nome_fornecedor}</td><td>${value.produto}</td><td>${value.preco}</td></tr>`;
    $(tableName).append(tag);
}

function makeCards(cardsArea, value) {
    let tag = `<div>
    <div class="card cardces mb-1 shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div class="card-name">
                    <h5 class="card-title">${value.nome_fornecedor}</h5>
                    <h5 class="card-title">${value.produto}</h5>
                    </div>
                <div class="preco">
                    <h3 class="card-title">R$${value.preco}</h3>
                </div>
            </div>
        </div>
    </div>
</div>`

    $(cardsArea).append(tag);
}
