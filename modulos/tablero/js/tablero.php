<?php
require_once('modulos/tablero/class/tablero.php');
$objTableroG = new Tablero();

//**************Primer Grafico******************
$ventames = $objTableroG->ventadiasMES(date("Y"),date("m"));
$label1="";
$datos1="";
/*
echo "<pre>";
print_r($ventames);
echo "</pre>";
*/
if ($ventames) {  
    for ($i=1; $i <= date("d"); $i++) {
        $encontrado = 0;
        for ($k=0; $k < count($ventames); $k++) { 
            if (isset($ventames[$k]['dia']) and $ventames[$k]['dia']==$i) {
                $label1.="'".$ventames[$k]['dia']."'".",";
                $datos1.=$ventames[$k]['total_dia'].",";
                $encontrado = 1;
                break;
            }
        }
        if ($encontrado==0) {
            $label1.="'".($i)."'".",";
            $datos1.="0,";
        }
    }
}
else {
    $label1="0,";
    $datos1="0,";
}

$label1 = substr($label1,0,-1);
$datos1 = substr($datos1,0,-1);

//**************Primer Grafico Soles******************
$ventamesS = $objTableroG->ventadiasMESSoles(date("Y"),date("m"));
$label1S="";
$datos1S="";
/*
echo "<pre>";
print_r($ventames);
echo "</pre>";
*/
if ($ventamesS) {  
    for ($i=1; $i <= date("d"); $i++) {
        $encontrado = 0;
        for ($k=0; $k < count($ventamesS); $k++) { 
            if (isset($ventamesS[$k]['dia']) and $ventamesS[$k]['dia']==$i) {
                $label1S.="'".$ventamesS[$k]['dia']."'".",";
                $datos1S.=$ventamesS[$k]['total_dia'].",";
                $encontrado = 1;
                break;
            }
        }
        if ($encontrado==0) {
            $label1S.="'".($i)."'".",";
            $datos1S.="0,";
        }
    }
}
else {
    $label1S="0,";
    $datos1S="0,";
}

$label1S = substr($label1S,0,-1);
$datos1S = substr($datos1S,0,-1);

//******************Grafico Grande****************
$ventaG = $objTableroG->ventas36m();
$labelG="";
$datosG="";

if ($ventaG) {
    for($in=35;$in>=0;$in--) {
        if (isset($ventaG[$in])) {
            $labelG.="'".$ventaG[$in]['Periodo']."'".",";
            $datosG.=$ventaG[$in]['total_mes'].",";
        }
        
    }
}
else {
    $labelG="0,";
    $datosG="0,";    
}
$labelG = substr($labelG,0,-1);
$datosG = substr($datosG,0,-1);

//******************Grafico Grande Soles****************
$ventaGS = $objTableroG->ventas36mS();
$labelGS="";
$datosGS="";

if ($ventaGS) {
    for($in=35;$in>=0;$in--) {
        if (isset($ventaGS[$in])) {
            $labelGS.="'".$ventaGS[$in]['Periodo']."'".",";
            $datosGS.=$ventaGS[$in]['total_mes'].",";
        }
        
    }
}
else {
    $labelGS="0,";
    $datosGS="0,";    
}
$labelGS = substr($labelGS,0,-1);
$datosGS = substr($datosGS,0,-1);

?>


<script>
//Grafico del mes
  const labelsMes = [<?=$label1?>];

  const dataMes = {
    labels: labelsMes,
    datasets: [
        {
            label: 'Venta Dolares',
            data: [<?=$datos1?>],
            //pointRadius: 0,
            backgroundColor: '#6EAEFA',//gradientBalanceHistory,
            borderColor: '#333',
            hoverBorderColor: '#000',
            borderWidth: 1,
            //pointBorderWidth: 0,
            //pointHoverBorderWidth: 0,
        },
        {
            label: 'Venta Soles',
            data: [<?=$datos1S?>],
            //pointRadius: 0,
            backgroundColor: '#F87171',//gradientBalanceHistory,
            borderColor: '#333',
            hoverBorderColor: '#000',
            borderWidth: 1,
            //pointBorderWidth: 0,
            //pointHoverBorderWidth: 0,
        }
    ]
  };


  const configMes = {
    type: 'bar',
    data: dataMes,
    options: {
        interaction:{
            mode: 'index'
        },
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
  };
  
  //Grafico 36 meses
  const labels36 = [<?=$labelG?>];

  const data36 = {
    labels: labels36,
    datasets: [
        {
            label: 'Venta Dolares',
            data: [<?=$datosG?>],
            //pointRadius: 0,
            backgroundColor: '#6EAEFA',//gradientBalanceHistory,
            borderColor: '#333',
            hoverBorderColor: '#000',
            borderWidth: 1,
            //pointBorderWidth: 0,
            //pointHoverBorderWidth: 0,
        },
        {
            label: 'Venta Soles',
            data: [<?=$datosGS?>],
            //pointRadius: 0,
            backgroundColor: '#F87171',//gradientBalanceHistory,
            borderColor: '#333',
            hoverBorderColor: '#000',
            borderWidth: 1,
            //pointBorderWidth: 0,
            //pointHoverBorderWidth: 0,
        }
    ]
  };

  const config36 = {
    type: 'bar',
    data: data36,
    options: {
        interaction:{
            mode: 'index'
        },
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
  };
</script>
<script>
  const ventasMes = new Chart(
    document.getElementById('ventasMes'),
    configMes
  );
</script>
<script>
  const venta36meses = new Chart(
    document.getElementById('ventas36meses'),
    config36
  );
</script>
