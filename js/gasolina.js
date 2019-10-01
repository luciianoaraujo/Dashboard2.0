$(window).on('load', async () => {
    loadTableData('comb');
    btnArea();
})
$('#escolha').on('click', (e) => {
    $('#escolhaInfo').toggleClass('hide');
        
})

async function loadTableData(query) {
    var url = `http://localhost:3333/${query}`;
    let i = 0;
    let qtd_cards = 0;
    let gasolina = [];
    let diesel = [];
    let etanol = [];
    return await $.get(url, (data) => {
        $.each(data, function (key, value) {
            if (i == 0) {
                diesel.push(value);
                makeTable('#tabelaDiesel', value);
                i++;
                qtd_cards++;
            } else
                if (i == 1) {
                    etanol.push(value);
                    makeTable('#tabelaEtanol', value);
                    i++;
                    qtd_cards++;
                } else
                    if (i == 2) {
                        gasolina.push(value);
                        makeTable('#tabelaGasolina', value);
                        i = 0;
                        qtd_cards++;
                    }
            if (qtd_cards <= 3)
                makeCards('#cardsArea', value);
        });
        makeCharts(diesel, gasolina, etanol);
        selecionarCombustivel('#escolha',gasolina[0], etanol[0]);
    })
}
function makeTable(tableName, value) {
    let tag = `<tr><td>${value.fornecedor}</td><td>${value.data}</td><td>${value.preco}</td></tr>`;
    $(tableName).append(tag);
}

function makeCards(cardsArea, value) {
    let tag = `
<div class="col-lg-4">
<div class="card mb-4 cardcom" id='${value.nome}Card'>
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-top">
            <div class="card-name">
                <h4 class="card-title">${value.nome}</h4>
            </div>
            <div class="preco text-center">
                <h3 class="card-title text-center">R$${value.preco}</h3>
            </div>
        </div>
        <div>
            <h6 class="card-title">${value.fornecedor}</h6>
            <small>R$ ${value.diferenca_menor_maior} mais barato</small>
        </div>
    </div>
</div>
</div>
`
    $(cardsArea).append(tag);
}

async function makeCharts(diesel, gasolina, etanol) {
    let chartD = {}
    chartD.data = [];
    chartD.preco = [];
    let chartG = {}
    chartG.data = [];
    chartG.preco = [];
    let chartE = {}
    chartE.data = [];
    chartE.preco = [];

    diesel.forEach(e => {
        chartD.data.push(e.data);
        e.preco = e.preco.replace(",", ".");
        e.data = e.data.replace('\\d{4}','');
        chartD.preco.push(parseFloat(e.preco));
    });
    chartD.data.reverse()
    chartD.preco.reverse()
    gasolina.forEach(e => {
        chartG.data.push(e.data);
        e.preco = e.preco.replace(",", ".");
        chartG.preco.push(parseFloat(e.preco));
    });
    chartG.data.reverse()
    chartG.preco.reverse()
    etanol.forEach(e => {
        chartE.data.push(e.data);
        e.preco = e.preco.replace(",", ".");
        chartE.preco.push(parseFloat(e.preco));
    });
    chartE.data.reverse()
    chartE.preco.reverse()

    var gas = document.getElementById('chartGas').getContext('2d');
    var eta = document.getElementById('chartEta').getContext('2d');
    var die = document.getElementById('chartDie').getContext('2d');

    var myChart = new Chart(die, {
        type: 'line',
        data: {
            labels: chartD.data,
            datasets: [{
                label: 'Diesel',
                data: chartD.preco,
                backgroundColor: 'rgba(25, 64, 222, 0.65)',
            }
            ]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: false,
                        stepSize: 0.05
                    }
                }]
            }
        }
    });
    var myChart = new Chart(eta, {
        type: 'line',
        data: {
            labels: chartE.data,
            datasets: [{
                label: 'Etanol',
                data: chartE.preco,
                backgroundColor: 'rgba(25, 64, 222, 0.65)',
            }
            ]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: false,
                        stepSize: 0.05
                    }
                }]
            }
        }
    });
    var myChart = new Chart(gas, {
        type: 'line',
        data: {
            labels: chartG.data,
            datasets: [{
                label: 'Gasolina',
                data: chartG.preco,
                backgroundColor: 'rgba(25, 64, 222, 0.65)',
            }
            ]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: false,
                        stepSize: 0.01
                    }
                }]
            }
        }
    });
}

function selecionarCombustivel(escolha, gasolina, etanol) {
    let porcentagem = parseFloat(etanol.preco) / parseFloat(gasolina.preco);
    let tag;

    if (porcentagem < 0.7) {
        tag = `
        <i class="fas fa-chevron-down"></i> Qual vale mais a pena? <b style="
        color: rgb(255, 196, 0);
    ">ETANOL ${porcentagem.toFixed(2)*100}%</b>
        `;
        $(`#${etanol.nome}Card`).addClass('menor-preco');
    } else {
        tag = `
        <i class="fas fa-chevron-down"></i> Qual vale mais a pena? <b style="
        color: rgb(255, 196, 0);
    ">GASOLINA ${porcentagem.toFixed(2)*100}%</b>
        `;
        $(`#${gasolina.nome}Card`).addClass('menor-preco');
    }

    console.log(porcentagem);

    $(escolha).append(tag);

}