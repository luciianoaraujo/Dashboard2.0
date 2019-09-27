$(window).on('load', async () => {
    loadTableData('gas');
    btnArea();
})

async function loadTableData(query) {
    var url = `http://localhost:3333/${query}`;
    let i = 0;
    return await $.get(url, (data) => {
        $.each(data, (key, value) => {
            if(key < 6)makeCards('#cardsArea', value)
            makeTable('#tableArea', value);
        });
    })
}
function makeTable(tableName, value) {
    let tag = `<tr><td>${value.fornecedor}</td><td>${value.nome}</td><td>${value.preco}</td><td>${value.data}</td></tr>`;
    $(tableName).append(tag);
}

function makeCards(cardsArea, value) {
    let tag = `<div class="col-md-4">
    <div class="card mb-1 shadow-sm cardgas" id='${value.nome}Card'>
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div class="card-name">
                    <h4 class="card-title">${value.nome}</h4>
                    <h6 class="card-title">${value.fornecedor}</h6>
                </div>
                <div class="preco">
                    <h3 class="card-title">R$${value.preco}</h3>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <div></div>
                <small >R$ ${value.diferenca_menor_maior} mais barato</small>
            </div>
        </div>
    </div>
</div>`

    $(cardsArea).append(tag);
}