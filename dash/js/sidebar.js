
const tag = `
<nav class="navbar justify-content-center navbar-expand-md navbar-light bg-white">
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="gasolina.html">Combustiveis <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="gas.html">Gás de cozinha</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="cesta.html">Cesta básica</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="reclamacao.html">Reclamações</a>
      </li>
    </ul>
  </div>
</nav>
`
$("#navigationBar").append(tag);
