<!DOCTYPE html>
<html>
<head>
  <title>Gráfico de barras apiladas</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
</head>
<body>

<div id="myChart"></div>

<script>
// Datos
var datos = [
  {
    "nombre": "Serie 1",
    "datos": [10, 20, 30]
  },
  {
    "nombre": "Serie 2",
    "datos": [40, 50, 60]
  },
  {
    "nombre": "Serie 3",
    "datos": [70, 80, 90]
  }
];

// Opciones del gráfico
var opciones = {
  type: "bar",
  stacked: true,
  title: "Gráfico de barras apiladas",
  xAxis: {
    categories: ["Enero", "Febrero", "Marzo"]
  },
  yAxis: {
    title: "Valores"
  }
};

// Crear el gráfico
var chart = new Chart(document.getElementById("myChart"), {
  type: opciones.type,
  data: datos,
  options: opciones
});
</script>

</body>
</html>