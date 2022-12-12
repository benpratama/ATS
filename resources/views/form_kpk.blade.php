<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
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
        .borde-l{
            border:0px;
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
                    <td style="width: 10%"><img src="{{ public_path('storage/logo/ETH.png') }}" width="150" height="75"></td>
                    <td style="text-align: right">
                        <div style="margin-right: 2px; margin-top: 2em; font-weight: bold; font-size: 1.5em;" >
                            CONFIDENTIAL
                        </div>
                    </td>
                </tr>
                
            </table>
        </center>
            <table width="100%" style="margin-top: 1em;border:1px solid">
                <tr>
                    <td style="width: 70%;border:1px solid">
                        KONFIRMASI PENERIMAAN KARYAWAN
                    </td>
                    <td style="font-size: 15px;width:3%;border:1px solid">
                        NO:
                    </td>
                    <td style="font-size: 15px;border:1px solid">XXX</td>

                </tr>
                <tr>
                    <td style="width: 70%;border:1px solid"></td>
                    <td style="font-size: 15px;width:3%;border:1px solid">
                        TGL:
                    </td>
                    <td style="font-size: 15px;border:1px solid">XXX</td>
                </tr>
            </table>
            <p>
                Pada hari ini telah diterima :
            </p>
            <ol>
                <li>
                    <div class="d-flex">
                        <span style="width: 20%; display: inline-block;">Nama</span>
                        <span style="width: 40%; display: inline-block;">:&emsp;{{ $Data->namalengkap }}</span>
                        <span>Jenis Kelamin:&emsp;{{ $Data->gender }}</span>
                    </div>
                    {{-- Nama&emsp;&emsp;&emsp;&ensp;&emsp;&emsp;&emsp;&ensp;&nbsp;:&emsp;{{ $Data->namalengkap }}&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&emsp;&emsp;&emsp;&emsp;Jenis Kelamin:&emsp;{{ $Data->gender }}</li> --}}
                <li>
                    <div class="d-flex">
                        <span style="width: 20%; display: inline-block;">Tempat/tgl.lahir</span>
                        <span>:&emsp;{{ $City->CityName }}/</span>
                        <span>{{ str_replace(" 00:00:00.000","",$Data->tglLahir)}}</span>
                    </div>
                    {{-- Tempat/tgl.lahir&emsp;&emsp;&ensp;&ensp;&nbsp;:&emsp;{{ $City->CityName }}/{{ str_replace(" 00:00:00.000","",$Data->tglLahir) }} --}}
                </li>
                <li>
                    <div class="d-flex">
                        <span style="width: 20%; display: inline-block;">Status Nikah</span>
                        <span>:&emsp;{{ $Pernikahan->MaritalSt }}</span>
                    </div>
                    {{-- Status Nikah&emsp;&emsp;&emsp;&ensp;&emsp;:&emsp;{{ $Pernikahan->MaritalSt }} --}}
                </li>
                <li>
                    <div class="d-flex">
                        <span style="width: 20%; display: inline-block;">Alamat</span>
                        <span>:&emsp;{{ $Data->alamatlengkap }}</span>
                    </div>
                    {{-- Alamat&emsp;&emsp;&emsp;&ensp;&emsp;&emsp;&emsp;&nbsp;:&emsp;{{ $Data->alamatlengkap }} --}}
                </li>
                <li>
                    <div class="d-flex">
                        <span style="width: 20%; display: inline-block;">Jabatan</span>
                        <span style="width: 40%; display: inline-block;">:&emsp;{{ $Job->nama }}</span>
                        <span>Level / Dept / Div.:&emsp;{{ $Job->golongan }}/XXX/XXX</span>
                    </div>
                    {{-- Jabatan&emsp;&emsp;&emsp;&ensp;&emsp;&emsp;&emsp;&nbsp;:&emsp;{{ $Job->nama }}&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;&nbsp;&emsp;&emsp;Level:&emsp;{{ $Job->golongan }} --}}
                </li>
                <li>
                    <div class="d-flex">
                        <span style="width: 20%; display: inline-block;">Atasan</span>
                        <span style="width: 40%; display: inline-block;">:&emsp;{{ $Detail_FPTK->namaatasanlangusng }}</span>
                        <span>0000</span>
                    </div>
                    {{-- Atasan&emsp;&emsp;&emsp;&ensp;&emsp;&emsp;&emsp;&ensp;:&emsp;{{ $Detail_FPTK->namaatasanlangusng }} --}}
                </li>
                <li>
                    <div class="d-flex">
                        <span style="width: 20%; display: inline-block;">Lokasi Kerja</span>
                        <span style="width: 40%; display: inline-block;">:&emsp;{{ $Detail_FPTK->penempatan }}</span>
                        <span>Home base:&emsp;{{ $homebase->publisher }}</span>
                    </div>
                    {{-- Lokasi Kerja&emsp;&emsp;&emsp;&ensp;&emsp;:&emsp;{{ $Detail_FPTK->penempatan }} --}}
                </li>
                <li>
                    <div class="d-flex">
                        <span style="width: 20%; display: inline-block;">Mulai bekerja</span>
                        <span>:&emsp;{{ $Detail_FPTK->tgljoin }}</span>
                    </div>
                    {{-- Mulai bekerja&emsp;&emsp;&emsp;&ensp;&ensp;&nbsp;:&emsp;{{ $Detail_FPTK->tgljoin }}</li> --}}
                <li>
                    <div class="d-flex">
                        <span style="width: 20%; display: inline-block;">Waktu Kerja</span>
                        <span>:&emsp;
                            @if ($WK_D=="on" && $WK_W=="on")
                                Senin - Jum`at: Sesuai ketentuan <br> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;Sabtu:Cabang
                            @elseif ( $WK_D=="on" && $WK_W==null)
                                Senin - Jumat: Sesuai ketentuan
                            @elseif( $WK_D==null && $WK_W=="on")
                                Sabtu:Cabang
                            @endif
                        </span>
                    </div>
                    
                    {{-- Waktu Kerja&emsp;&emsp;&emsp;&ensp;&emsp;&nbsp;:&emsp;
                    @if ($WK_D=="on" && $WK_W=="on")
                        Senin - Jum`at: Sesuai ketentuan <br> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;Sabtu:Cabang
                    @elseif ( $WK_D=="on" && $WK_W==null)
                        Senin - Jumat: Sesuai ketentuan
                    @elseif( $WK_D==null && $WK_W=="on")
                        Sabtu:Cabang
                    @endif --}}
                </li>
                
                <li>Fasilitas:</li>
                <table width="70%" id="tbl_fasilitas">
                    <thead>
                        <th width=7% style="border:0px; font-size: 15px;">Y</th>
                        <th width=7% style="border:0px; font-size: 15px;">T&emsp;**)</th>
                    </thead>
                    <tbody>
                        @if ($F_kesehatan!=null)
                        <tr>
                            <td></td>
                            <td></td>
                            <td colspan="2" style="border:0px; font-size: 15px;">Kesehatan</td>
                        </tr>
                        @endif
                        @if ($F_kost!=null)
                        <tr>
                            <td></td>
                            <td></td>
                            <td style="border:0px;font-size: 15px;"><span>Tunjangan Kost</span></td>
                            <td style="border:0px;font-size: 15px;">Rp:&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;/bln</td>
                        </tr>
                        @endif
                        @if ($F_penempatan!=null)
                        <tr>
                            <td></td>
                            <td></td>
                            <td style="border:0px;font-size: 15px;">Tunjangan Penempatan</td>
                            <td style="border:0px;font-size: 15px;">Rp:&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;/bln</td>
                        </tr>
                        @endif
                        @if ($F_kemahalan!=null)
                        <tr>
                            <td></td>
                            <td></td>
                            <td style="border:0px;font-size: 15px;">Tunjangan Kemahalan</td>
                            <td style="border:0px;font-size: 15px;">Rp:&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;/bln</td>
                        </tr>
                        @endif
                        @if ($F_sewaMotor!=null)
                        <tr>
                            <td></td>
                            <td></td>
                            <td style="border:0px;font-size: 15px;">Tunjangan sewa motor</td>
                            <td style="border:0px;font-size: 15px;">Rp:&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;/bln</td>
                        </tr> 
                        @endif
                        @if ($F_uangMakan!=null)
                        <tr>
                            <td></td>
                            <td></td>
                            <td style="border:0px;font-size: 15px;">Uang makan</td>
                            <td style="border:0px;font-size: 15px;">Rp:&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;/bln</td>
                        </tr>
                        @endif
                        @if ($F_transport!=null)
                        <tr>
                            <td></td>
                            <td></td>
                            <td style="border:0px;font-size: 15px;">Tunjangan Transport</td>
                            <td style="border:0px;font-size: 15px;">Rp:&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;/bln</td>
                        </tr>
                        @endif
                        @if ($F_makan!=null)
                        <tr>
                            <td></td>
                            <td></td>
                            <td style="border:0px;font-size: 15px;">Tunjangan Makan</td>
                            <td style="border:0px;font-size: 15px;">Rp:&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;/bln</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                <li>
                    <div class="d-flex">
                        <span style="width: 20%; display: inline-block;">Gaji</span>
                        <span style="width: 30%; display: inline-block;">:Rp</span>
                        <span>/bulan Gross</span>
                    </div>
                    {{-- Gaji:Rp&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;/bulan Gross --}}
                </li>
                <li>Kondisi-kondisi lain</li>
                    <ul>
                        @if ($Percobaan !=null)
                        <li>Masa Percobaan &emsp;&emsp;&emsp;&emsp;&emsp;&emsp; 3 bulan</li>
                        @elseif($Ikatandinas !=null)
                        <li>Ikatan Dinas &emsp;&emsp;&emsp;&emsp;&emsp;&emsp; 1 tahun</li>
                        @endif
                    </ul>
            </ol>
            <ol start="13">
                <li>Tanda tangan<br><br></li>
                <table width=100% id="tbl_ttd" style="border-collapse: collapse;">
                    <thead>
                        <th>Negosiator</th>
                        <th>Yg Bersankutan</th>
                        <th colspan="3">Department/Divisi</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="width: 16.6%;font-size: 15px;">tgl:</td>
                            <td style="width: 16.6%;font-size: 15px;">tgl:</td>
                            <td style="width: 16.6%;font-size: 15px;">tgl:</td>
                            <td style="width: 16.6%;font-size: 15px;">tgl:&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;**)</td>
                            <td style="width: 16.6%;font-size: 15px;">tgl:</td>
                            <td style="width: 16.6%;font-size: 15px;">tgl:&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;**)</td>
                        </tr>
                        <tr >
                            <td style="height: 3.5em;"></td>
                            <td style="height: 3.5em;"> </td>
                            <td style="height: 3.5em;"></td>
                            <td style="height: 3.5em;"></td>
                            <td style="height: 3.5em;"></td>
                            <td style="height: 3.5em;"></td>
                        </tr>
                        <tr style="height: 1.3em;">
                            <td style="font-size: 15px;">{{ $Negosiator }}</td>
                            <td style="font-size: 15px;">{{ $Data->namalengkap }}</td>
                            <td style="font-size: 15px;">{{ $manager }}</td>
                            <td style="font-size: 15px;">{{ $direktur }}</td>
                            <td style="font-size: 15px;">{{ $hrd_manager }}</td>
                            <td style="font-size: 15px;">{{ $hrd_direktur }}</td>
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