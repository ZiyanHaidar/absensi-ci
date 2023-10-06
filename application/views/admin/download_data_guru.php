<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposiion: attachment; filename=".$nama.".xls");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
</head>

<body>
    <h1>DATA PEMBAYARAN</h1>
    <table style="font-size: 14px; font-weight: bold;">
        <tr>
            <td>Email</td>
            <td>:</td>
            <td><?php echo $this->session->userdata('email') ?></td>
        </tr>
        <tr>
            <th>No</th>
            <th>Nama Guru</th>
            <th>NISN</th>
            <th>Gender</th>
            <th>Mapel</th>
            <th>Walikelas</th>
        </tr>
        <?php $no= 1; 
        foreach ($data_guru as $key) {
            $kelas = tampil_full_kelas_byid($key->id_walikelas);
            ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td>
                <?php echo $key->nama_guru?>
            </td>
            <td>
                <?php echo $key->nik ?>
            </td>
            <td>
                <?php echo $key->gender ?>
            </td>
            <td>
                <?php echo tampil_full_mapel_byid($key->id_mapel) ?>
            </td>
            <td>
                <?php echo ($kelas) ? $kelas : 'Tidak menjadi walikelas'; ?>
            </td>
        </tr>
        <?php } ?>
    </table>


</body>

</html>