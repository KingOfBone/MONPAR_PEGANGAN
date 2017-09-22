<?php
include "../../config/koneksi.php";
include "../../config/utility.php";
session_start();

$detail     = $_POST['id'];

$sqldetail  = mysql_query("SELECT
trafo.kodetrafo,
trafo.kodeapp,
trafo.kodegi,
trafo.namabay,
trafo.serialid,
trafo.typeid,
trafo.idbay,
trafo.kodepst,
trafo.kodestatus,
trafo.tegoprs,
trafo.tgloprs,
trafo.impdns,
trafo.phasa,
trafo.kodemerk,
trafo.thnbuat,
trafo.kodebuatan,
trafo.jenis,
trafo.penempatan,
trafo.keterangan,
trafo.flag,
trafo.jeniskonsv,
trafo.tglhistory,
trafo.tmsaktif,
trafo.tegoperasi,
trafo.idfireprotection,
trafo.idproteksimekanik,
trafo.idonlinemonitoring,
trafo.constype,
trafo.description,
trafo.asset,
trafo.techidentno,
trafo.eqnumber,
trafo.daya,
trafo.vectorx,
trafo.equipmentnumber,
trafo.idfunctloc,
trafo.tipe,
trafo.tegprimrated,
trafo.tegsecrated,
trafo.tegprimmax,
trafo.tegsecmax,
trafo.tegtermax,
trafo.arusprim,
trafo.arussec,
trafo.aruster,
trafo.vector,
trafo.bil,
trafo.sil,
trafo.pfwv,
trafo.suhu,
trafo.suhunaikw,
trafo.suhunaiko,
trafo.cooling,
trafo.jmlkips,
trafo.jnsisokertas,
trafo.klsiso,
trafo.panjang,
trafo.lebar,
trafo.tinggi,
trafo.brtminyak,
trafo.brtintibltn,
trafo.brttot,
trafo.jnsminyak,
trafo.jrkroda,
trafo.jrkas,
trafo.standard,
trafo.pasangan,
trafo.bilsec,
trafo.bilter,
trafo.pfwsec,
trafo.pfwter,
trafo.brtmainfitting,
trafo.dayater,
trafo.deltategtap,
trafo.jmlcoolingpump,
trafo.jmlgroupkipas,
trafo.jmltap,
trafo.tegtapbawah,
trafo.tegtapatas,
trafo.tegtapnormal,
trafo.tipeminyak,
trafo.waktusc,
trafo.image,
gi.namagi,
app.namaapp,
merk.merk,
buatan.buatan
FROM
trafo
INNER JOIN gi ON gi.kodegi = trafo.kodegi
INNER JOIN app ON app.kodeapp = gi.kodeapp
INNER JOIN merk ON merk.kodemerk = trafo.kodemerk
INNER JOIN buatan ON buatan.kodebuatan = merk.kodebuatan
 WHERE trafo.kodetrafo = '$detail'") or die (mysql_error());
$rowDetail     = mysql_fetch_array($sqldetail);


?>
<div class="row">

    <div class="col-md-3">
        <img src="<?php echo $rowDetail["image"] == "" ? "images/foto/no-images.png" : "foto/".$rowDetail["image"] ?>" width="188" height="272" class="img-responsive img-rounded center-block" />
        <p class="text-center"><?php echo $rowDetail["image"]; ?></p>
    </div>
    <div class="col-md-8">
        <div class="row">
          <div class="col-md-5"><label>Nama APP</label></div>
          <div class="col-md-1"> : </div>
          <div class="col-md-6"><?php echo $rowDetail["namaapp"]; ?></div>
        </div>
      <div class="row">
        <div class="col-md-5"><label>Nama Gardu Induk</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["namagi"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Nama Bay</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["namabay"]; ?></div>
      </div>
       <div class="row">
        <div class="col-md-5"><label>Serial ID</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["serialid"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Tipe ID</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["typeid"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>ID Bay</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["idbay"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Kode PST</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["kodepst"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Kode Status</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["kodestatus"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Tegangan Operasi</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["tegoprs"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Tanggal Operasi</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php if($rowDetail["tgloprs"]=="0000-00-00"){ }else{  echo tglindonesia($rowDetail["tgloprs"]); } ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>IMPDNS</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["impdns"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Phasa</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["phasa"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Merk</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["merk"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Tahun Buat</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["thnbuat"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Buatan</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["buatan"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Jenis</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["jenis"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Keterangan</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["keterangan"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Flag</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["flag"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Jenis Konvs</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["jeniskonsv"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Tanggal History</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php if($rowDetail["tglhistory"]=="0000-00-00"){ }else{  echo tglindonesia($rowDetail["tglhistory"]); } ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>TMS Aktif</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["tmsaktif"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Teg Operasi</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["tegoperasi"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>ID Fire Protection</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["idfireprotection"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>ID Proteksi Mekanik</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["idproteksimekanik"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>ID Online Monitoring</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["idonlinemonitoring"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Constype</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["constype"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Description</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["description"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Asset</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["asset"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Techidentno</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["techidentno"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>EQ Number</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["eqnumber"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Daya</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["daya"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Vectorx</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["vectorx"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Equipment Number</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["equipmentnumber"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>ID Funct Loc</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["idfunctloc"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Tipe</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["tipe"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Teg Prim Rated</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["tegprimrated"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Teg Sec Rated</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["tegsecrated"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Teg Prim Max</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["tegprimmax"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Teg Sec Max</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["tegsecmax"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Teg Ter Max</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["tegtermax"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Arus Prim</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["arusprim"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Arus Sec</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["arussec"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Arus Ter</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["aruster"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Vector</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["vector"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Bil</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["bil"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Sil</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["sil"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>PFWV</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["pfwv"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Suhu</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["suhu"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Suhu Naik W</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["suhunaikw"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Suhu Naik O</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["suhunaiko"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Cooling</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["cooling"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Jml Kips</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["jmlkips"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Jns Iso Kertas</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["jnsisokertas"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Kls Iso</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["klsiso"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Panjang</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["panjang"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Lebar</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["lebar"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Tinggi</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["tinggi"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Brt Minyak</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["brtminyak"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Brt Inti Bltn</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["brtintibltn"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Brt Tot</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["brttot"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Jenis Minyak</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["jnsminyak"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Jarak Roda</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["jrkroda"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Jarak As</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["jrkas"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Standard</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["standard"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Pasangan</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["pasangan"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Bilsec</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["bilsec"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Bilter</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["bilter"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>PFW Sec</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["pfwsec"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>PFW Ter</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["pfwter"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Brt Main Fitting</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["brtmainfitting"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Daya Ter</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["dayater"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Delta Teg Tap</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["deltategtap"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Jml Cooling Pump</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["jmlcoolingpump"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Jml Group Kipas</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["jmlgroupkipas"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Jml Tap</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["jmltap"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Teg Tap Bawah</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["tegtapbawah"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Teg Tap Atas</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["tegtapatas"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Teg Tap Normal</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["tegtapnormal"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Tipe Minyak</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["tipeminyak"]; ?></div>
      </div>
      <div class="row">
        <div class="col-md-5"><label>Waktu SC</label></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-6"><?php echo $rowDetail["waktusc"]; ?></div>
      </div>
    </div>
</div>
