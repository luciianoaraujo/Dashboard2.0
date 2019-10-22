$(window).on('load', async () => {
    loadTableData('comb');
    btnArea();
})
$('#escolha').on('click', (e) => {
    $('#escolhaInfo').toggleClass('hide');
        
})
let scriptString = `
    function drawMap() {    
        var mapOptions = {
          zoom: 13,
         }
     `;

async function loadMapData(id){
    var url = `http://itajuba.myscriptcase.com/scriptcase/devel/conf/grp/Procon/libraries/php/fornecedor_detalhe.php?id=${id}`
    console.log(url);
}

async function loadTableData(query) {
    var url = `http://localhost:3333/${query}`;
    let i = 0;
    let qtd_cards = 0;
    let gasolina = [];
    let diesel = [];
    let etanol = [];
    return await $.get(url, (data) => {
        $.each(data, function (key, value) {
            if (value.nome === 'Diesel') {
                diesel.push(value);
                makeTable('#tabelaDiesel', value);
                i = 3;
                qtd_cards++;
            } else
                if (value.nome == 'Etanol') {
                    etanol.push(value);
                    makeTable('#tabelaEtanol', value);
                    i = 6;
                    qtd_cards++;
                } else
                    if (value.nome == 'Gasolina') {
                        gasolina.push(value);
                        makeTable('#tabelaGasolina', value);
                        i = 0;
                        qtd_cards++;
                    }
            if (qtd_cards <= 9)
                makeCards('#cardsArea', value);
        });
        
        makeCharts(diesel, gasolina, etanol);
        selecionarCombustivel('#escolha',gasolina[0], etanol[0]);
    })
}
function makeTable(tableName, value) {
    let tag = `<tr><td>${value.nome}</td><td>${value.fornecedor}</td><td>${value.data}</td><td>${value.preco}</td></tr>`;
    $(tableName).append(tag);
}

function makeCards(cardsArea, value) {
    let fornecedorId = value.fornecedorId;
    let latitude = value.latitude;
    let longitude = value.longitude;
    let tag = `
<div class="card2">
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
        <div class="container">
            <div class="row">
                <div class="col-8">
                    <div>
                        <h6 class="card-title">${value.fornecedor}</h6>
                        <small style>R$ ${value.diferenca_menor_maior} mais barato</small>
                    </div>
                </div>
                <div class="col-4">
                    <button type="button" class="btn btn-outline-light" 
                    data-toggle="modal" data-target="#myModal${value.id}" data-lat='10.85' data-lng='106.62'>
                        <i class="fas fa-map-marked-alt"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="modal fade" id="myModal${value.id}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog  modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12 modal_body_content">
            <p>Latitude: ${value.id}</p>
            <p>Latitude: ${latitude}</p>
            <p>Longitude: ${longitude}</p>
          </div>
        </div>
        <div class="row">
          <div id="map${value.id}" style="height:500px; width:100%"></div>
        </div>
        <div class="row">
          <div class="col-md-12 modal_body_end">
            <p>Else...</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
`;
scriptString = scriptString+`
    mapOptions.center = new google.maps.LatLng(${value.latitude}, ${value.longitude});
    map${value.id} = new google.maps.Map(document.getElementById("map${value.id}"), mapOptions);
`;
if(value.id==24){
    scriptString = scriptString+`}
    `;

    console.log(scriptString);

    var googleMapsScript = document.createElement('script');
    scriptString = document.createTextNode(scriptString);
    googleMapsScript.appendChild(scriptString);
    document.body.appendChild(googleMapsScript);

    var my_awesome_script = document.createElement('script');
    my_awesome_script.setAttribute('src',`https://maps.googleapis.com/maps/api/js?key=AIzaSyDhSb...pjtpV6vtK8&callback=drawMap`);
    document.body.appendChild(my_awesome_script);

}

    $(cardsArea).append(tag)
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
        type: 'bar',
        data: {
            labels: chartD.data,
            datasets: [{
                label: 'Diesel',
                data: chartD.preco,
                backgroundColor: 'rgba(36, 124, 198, 0.85)',
            }
            ]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: false,
                        stepSize: 0.5
                    }
                }]
            }
        }
    });
    var myChart = new Chart(eta, {
        type: 'bar',
        data: {
            labels: chartE.data,
            datasets: [{
                label: 'Etanol',
                data: chartE.preco,
                backgroundColor: 'rgba(36, 124, 198, 0.85)',
            }
            ]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: false,
                        stepSize: 0.5
                    }
                }]
            }
        }
    });
    var myChart = new Chart(gas, {
        type: 'bar',
        data: {
            labels: chartG.data,
            datasets: [{
                label: 'Gasolina',
                data: chartG.preco,
                backgroundColor: 'rgba(36, 124, 198, 0.85)',
            }
            ]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: false,
                        stepSize: 0.5
                    }
                }]
            }
        }
    });
}

function selecionarCombustivel(escolha, gasolina, etanol) {
    console.log(gasolina.preco)
    let porcentagem = parseFloat(etanol.preco) / parseFloat(gasolina.preco);
    let tag;

    if (porcentagem < 0.7) {
        tag = `
        <i class="fas fa-chevron-down"></i> Qual vale mais a pena? <b style="
        color: rgb(255, 196, 0);
    ">ETANOL ${porcentagem.toFixed(2)*100}%</b> mais barato!
        `;
        $(`#${etanol.nome}Card`).addClass('menor-preco');
    } else {
        tag = `
        <i class="fas fa-chevron-down"></i> Qual vale mais a pena? <b style="
        color: rgb(255, 196, 0);
    ">GASOLINA ${porcentagem.toFixed(2)*100}%</b> mais barato!
        `;
        $(`#${gasolina.nome}Card`).addClass('menor-preco');
    }

    $(escolha).append(tag);
}