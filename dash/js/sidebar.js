function sidebar(){
  const tag = `
  <ul class="nav justify-content-center mt-1 mb-4">
  <li class="nav-item">
    <a class="nav-link" href="./gasolina.html">Combustivel</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="./gas.html">Gás de cozinha</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="./cesta.html">Cesta básica</a>
  </li>
  <li class="nav-item"> 
    <a class="nav-link" href="./reclamacao.html">Reclamações</a>
  </li>
</ul>
`

  $("#navigationBar").append(tag);
}


sidebar();