<!DOCTYPE html>
<head>
    <style>
        #listkandidat, #listkandidat td, #listkandidat th {
            border: 1px solid black;
        }
        #kopsurat{
            border-bottom: 3px solid black;
        }
        #tbl_ttd th {
            border: 1px solid black;
            font-size: 12px;
        }
        #tbl_ttd td {
            border: 1px solid black;
            font-size: 12px;
        }
        #tbl_fasilitas th {
            border: 1px solid black;
            font-size: 12px;
        }
        #tbl_fasilitas td {
            border: 1px solid black;
            font-size: 12px;
        }
        /* table, th, td {
        border: 1px solid black;
        font-size: 12px;
        }
         */
    </style>
</head>
<body>
    <div>
        <center>
            <table width="100%" id="kopsurat">
                <tr>
                    <td style="width: 10%"><img src="{{ asset('storage/logo/ETH.png') }}" width="150" height="75"></td>
                    <td style="text-align: right">
                        <div style="margin-right: 2px; margin-top: 2em; font-weight: bold; font-size: 1.5em;" >
                            CONFIDENTIAL
                        </div>
                    </td>
                </tr>
                
            </table>
        </center>
            <table width="100%" style="margin-top: 1em">
                <tr>
                    <td rowspan="2" style="width: 70%">
                        KONFIRMASI PENERIMAAN KARYAWAN
                    </td>
                    <td style="font-size: 15px;">
                        NO:
                    </td>
                </tr>
                <tr>
                    <td style="font-size: 15px;">
                        TGL:
                    </td>
                </tr>
            </table>
            <p>
                Pada hari ini telah diterima :
            </p>
            <ol>
                <li>Nama&emsp;&emsp;&emsp;&ensp;&emsp;&emsp;&emsp;&ensp;&nbsp;:&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;Jenis Kelamin:</li>
                <li>Tempat/tgl.lahir&emsp;&emsp;&ensp;&ensp;&nbsp;:</li>
                <li>Status Nikah&emsp;&emsp;&emsp;&ensp;&emsp;:</li>
                <li>Alamat&emsp;&emsp;&emsp;&ensp;&emsp;&emsp;&emsp;&nbsp;:</li>
                <li>Jabatan&emsp;&emsp;&emsp;&ensp;&emsp;&emsp;&emsp;&nbsp;:&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;Level:</li>
                <li>Atasan&emsp;&emsp;&emsp;&ensp;&emsp;&emsp;&emsp;&ensp;:</li>
                <li>Lokasi Kerja&emsp;&emsp;&emsp;&ensp;&emsp;:</li>
                <li>Mulai bekerja&emsp;&emsp;&emsp;&ensp;&ensp;&nbsp;:</li>
                <li>Waktu Kerja&emsp;&emsp;&emsp;&ensp;&emsp;&nbsp;: Senin - Jum'at: Sesuai ketentuan <br> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;Sabtu:Cabang</li>
                <li>Fasilitas:</li>
                <table width="70%" id="tbl_fasilitas">
                    <thead>
                        <th width=5%>Y</th>
                        <th width=5%>T</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td colspan="2">Kesehatan</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Tunjangan Kost</td>
                            <td>Rp:&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;/bln</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Tunjangan Penempatan</td>
                            <td>Rp:&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;/bln</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Tunjangan Kemahalan</td>
                            <td>Rp:&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;/bln</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Tunjangan sewa motor</td>
                            <td>Rp:&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;/bln</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Uang makan</td>
                            <td>Rp:&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;/bln</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Tunjangan Transport</td>
                            <td>Rp:&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;/bln</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Tunjangan Makan</td>
                            <td>Rp:&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;/bln</td>
                        </tr>
                    </tbody>
                </table>
                <li>Gaji:Rp&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;/bulan Gross</li>
                <li>Kondisi-kondisi lain</li>
                    <ul>
                        <li>Masa Percobaan &emsp;&emsp;&emsp;&emsp;&emsp;&emsp; 3 bulan</li>
                        <li>Ikatan Dinas &emsp;&emsp;&emsp;&emsp;&emsp;&emsp; 1 tahun</li>
                    </ul>
                <li>Tanda tangan<br><br></li>
                <table width=100% id="tbl_ttd">
                    <thead>
                        <th>Negosiator</th>
                        <th>Yg Bersankutan</th>
                        <th colspan="3">Department/Divisi</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="width: 16.6%">tgl:</td>
                            <td style="width: 16.6%">tgl:</td>
                            <td style="width: 16.6%">tgl:</td>
                            <td style="width: 16.6%">tgl:</td>
                            <td style="width: 16.6%">tgl:</td>
                            <td style="width: 16.6%">tgl:</td>
                        </tr>
                        <tr style="height: 3.5em;">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr style="height: 1.3em;">
                            <td></td>
                            <td>Nama Kandidat</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </ol>
            <p>
                <u>keterangan:</u><br>
                *) Homebase hanya diisi untuk Marketing <br>
                **) Y = Ya T = Tidak ,pengisian dengan x[ ] <br>
                ***) Ditandatangani apabila Level 4 E ke atas / ada penyimpangan <br>
                Catatan: Besaran gaji pokok sesuai dengan surat refensi yang didapat dari Perusahaan-perusahaan sebelumnya. Jika surat
                referensi tidak dapat dikirimkan pada HRD selambat-lambatnya satu bulan setelah tanggal bergabung maka besaran gaji pokok
                akan disesuaikan atau tidak ada penyesuaian setelah masa percobaan berakhir.
            </p>
    </div>
    {{-- <p style="page-break-after: always"></p> --}}
</body>
</html>