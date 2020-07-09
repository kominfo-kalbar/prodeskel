<?php
// original dev: dev.abimanyu.net

$dari_baris_ke = 0; //0
$jumlah = 1000;     //200

include ("../Sql_Class/db.php");
$list_desa = $sql->query('SELECT * FROM produksi_budidaya_ikanairtawar LIMIT '.$dari_baris_ke.','.$jumlah.'')->fetchAll();
$i=1;
echo "
<p><a href='../' class='text-bold'>home</a></p>
<p></p>
<table>";
foreach ($list_desa as $DS) {
  $kabupaten = empty($DS['kab']) ? desa_get_before($DS['no'], "kab") : $DS['kab'] ;
  $kecamatan = empty($DS['kec']) ? desa_get_before($DS['no'], "kec") : $DS['kec'] ;
  $kode_desa = empty($DS['kode']) ? desa_get_before($DS['no'], "kode") : $DS['kode'] ;
  $nama_desa = empty($DS['desa']) ? desa_get_before($DS['no'], "desa") : $DS['desa'] ;
  
  echo "
    <tr>
      <td>".$i++."</td> 
      <td>".$DS['no']."</td>
      <td>".$kode_desa."</td>
      <td><a href='#' class='text-bold'>".$nama_desa."</a></td>
      <td>".$kabupaten."</td>
      <td>".$kecamatan."</td>
  </tr>
    ";
}
echo "</table>
<p><a href='../' class='text-bold'>home</a></p>";
$sql->close();

function desa_get_before($on, $type='kab'){
  global $sql2;
  $gol = $sql2->query('SELECT '.$type.' FROM produksi_budidaya_ikanairtawar WHERE `no` = ?', $on-1)->fetchArray();
  //return $gol[$type];
  
  $sql2->query('UPDATE produksi_budidaya_ikanairtawar SET `'.$type.'` = \''.$gol[$type].'\' WHERE `no` = \''.$on.'\'');
  return $sql2->affectedRows();

  $sql2->close();
}
?>