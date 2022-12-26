<!DOCTYPE html>
<head>
    {{-- <style>
        @page  {
          margin: 0;
          size: letter; /*or width then height 150mm 50mm*/
        }
    </style> --}}
</head>
<body>
    <div>
        <center>
            <table width="100%" id="kopsurat">
                <tr>
                    <td style="width: 100%"><img src="{{ public_path('storage/logo/headsolutiva.png') }}" width="100%" height="60"></td>
                </tr>
            </table>
        </center>            
    </div>
    <div>
        <center>
            <b>SURAT PENGANTAR PSIKOTES</b><br>
            <b>PT. SOLUTIVA CONSULTING INDONESIA</b><br>
            Haery 1 Building, Jl. Kemang Selatan No.151, RT.4/RW.4, Cilandak Tim., Kec. Ps. Minggu,<br>
            Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12560
        </center>
    </div>
    <div>
        <table width="100%">
            {{-- {{ $tgl_waktu = explode(' ',$Data->jadwal) }} --}}
            <tr>
                <td width="30%" style="border:1px solid; font-size: 12px;"><b>Perushaan</b></td>
                <td width="1%" style="border:1px solid; font-size: 12px;"><b>:</b></td>
                <td width="69%" style="border:1px solid; font-size: 12px;">{{ $INFO_Organisasi[0]->nama }}</td>
            </tr>
            <tr>
                <td width="30%" style="border:1px solid; font-size: 12px;"><b>Tanggal Tes</b></td>
                <td width="1%" style="border:1px solid; font-size: 12px;"><b>:</b></td>
                <td width="69%" style="border:1px solid; font-size: 12px;">{{ explode(' ',$Data->jadwal)[0] }}</td>
            </tr>
            <tr>
                <td width="30%" style="border:1px solid; font-size: 12px;"><b>Pelaksanaan Tes</b></td>
                <td width="1%" style="border:1px solid; font-size: 12px;"><b>:</b></td>
                <td width="69%" style="border:1px solid; font-size: 12px;"></td>
            </tr>
            <tr>
                <td width="30%" style="border:1px solid; font-size: 12px;"><b>Waktu Pelaksanaan Tes</b></td>
                <td width="1%" style="border:1px solid; font-size: 12px;"><b>:</b></td>
                <td width="69%" style="border:1px solid; font-size: 12px;">{{ str_replace(':00.000','',explode(' ',$Data->jadwal)[1]) }}</td>
            </tr>
            <tr>
                <td width="30%" style="border:1px solid; font-size: 12px;"><b>Kota Pelaksanaan Tes</b></td>
                <td width="1%" style="border:1px solid; font-size: 12px;"><b>:</b></td>
                <td width="69%" style="border:1px solid; font-size: 12px;"></td>
            </tr>
            <tr>
                <td width="30%" style="border:1px solid; font-size: 12px;"><b>Jumlah Peserta Tes </b></td>
                <td width="1%" style="border:1px solid; font-size: 12px;"><b>:</b></td>
                <td width="69%" style="border:1px solid; font-size: 12px;">{{ count($INFO_KANDIDAT) }}</td>
            </tr>
        </table>
    </div>
    <div>
        <table width="100%" style="margin-top: 1em">
            <thead>
                <tr>
                    <th style="border:1px solid; font-size: 12px;"><b>No</b></th>
                    <th style="border:1px solid; font-size: 12px;"><b>Nama Peserta Tes</b></th>
                    <th style="border:1px solid; font-size: 12px;"><b>No. HP Kandidat</b></th>
                    <th style="border:1px solid; font-size: 12px;"><b>Posisi</b></th>
                    <th style="border:1px solid; font-size: 12px;"><b>Level</b></th>
                    <th style="border:1px solid; font-size: 12px;"><b>Paket Tes</b></th>
                    <th style="border:1px solid; font-size: 12px;"><b>Biaya Tes</b></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    {{ $i=1 }}
                    @foreach ($INFO_KANDIDAT as $kandidat)
                        <td style="border:1px solid; font-size: 12px;">{{ $i }}</td>
                        <td style="border:1px solid; font-size: 12px;">{{ $kandidat->namalengkap }}</td>
                        <td style="border:1px solid; font-size: 12px;">{{ $kandidat->phoneNumber }}</td>
                        {{-- @foreach ($INFO_JOB as $job )
                            @if ($kandidat->id_Tlink==$job->id) --}}
                        <td style="border:1px solid; font-size: 12px;">{{ $kandidat->nama }}</td>
                            {{-- @endif
                        @endforeach --}}
                        <td style="border:1px solid; font-size: 12px;"></td>
                        <td style="border:1px solid; font-size: 12px;"></td>
                        <td style="border:1px solid; font-size: 12px;"></td>
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>
    <br>
    <div>
        <table width="100%">
            <thead>
                <tr>
                    <th style="border:1px solid; font-size: 12px;">NO</th>
                    <th style="border:1px solid; font-size: 12px;">Posisi</th>
                    <th style="border:1px solid; font-size: 12px;">Deskripsi Pekerjaan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="border:1px solid;">1</td>
                    <td style="border:1px solid;"></td>
                    <td style="border:1px solid;"></td>
                </tr>
                {{-- <tr>
                    <td rowspan="0" style="border:1px solid;">1</td>
                    <td rowspan="0" style="border:1px solid;">&nbsp;</td>
                    <td style="border:1px solid;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border:1px solid;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border:1px solid;">&nbsp;</td>
                </tr> --}}
            </tbody>
        </table>
    </div>
    <div>
        <p><b>Pengiriman Hasil Evaluasi Psikologis dan Invoice ditujukan kepada :</b></p>
        <table width=100%>
            <tr>
                <td style="border:1px solid; font-size: 12px;" width="30%">Nama</td>
                <td style="border:1px solid; font-size: 12px;" width="70%"></td>
            </tr>
            <tr>
                <td style="border:1px solid; font-size: 12px;" width="30%">Jabatan</td>
                <td style="border:1px solid; font-size: 12px;" width="70%"></td>
            </tr>
            <tr>
                <td style="border:1px solid; font-size: 12px;" width="30%">Perusahaan</td>
                <td style="border:1px solid; font-size: 12px;" width="70%"></td>
            </tr>
            <tr>
                <td style="border:1px solid; font-size: 12px;" width="30%">Alamat</td>
                <td style="border:1px solid; font-size: 12px;" width="70%"></td>
            </tr>
            <tr>
                <td style="border:1px solid; font-size: 12px;" width="30%"><span>Email</span><br><span>(Untuk Pengiriman Soft Copy)</span></td>
                <td style="border:1px solid; font-size: 12px;" width="70%"></td>
            </tr>
        </table>
    </div>
    <div>
        <p><b>Data NPWP Perusahaan :</b></p>
        <table width=100%>
            <tr>
                <td style="border:1px solid; font-size: 12px;" width="30%">Nama Perusahaan sesuai NPWP</td>
                <td style="border:1px solid; font-size: 12px;" width="70%"></td>
            </tr>
            <tr>
                <td style="border:1px solid; font-size: 12px;" width="30%">Alamat Perusahaan sesuai NPWP</td>
                <td style="border:1px solid; font-size: 12px;" width="70%"></td>
            </tr>
            <tr>
                <td style="border:1px solid; font-size: 12px;" width="30%">Nomor NPWP</td>
                <td style="border:1px solid; font-size: 12px;" width="70%"></td>
            </tr>
        </table>
    </div>
    <div>
        <p>Demikian kami sampaikan, atas perhatian dan kerjasamanya kami ucapkan terima kasih.</p>
        <p>Hormat kami,</p>
        <br>
        <p>({{ $PIC }})</p>
    </div>
    <div>
        <center>
            <table width="100%" id="footer">
                <tr>
                    <td style="width: 100%"><img src="{{ public_path('storage/logo/footersolutiva.png') }}" width="100%" height="75"></td>
                </tr>
            </table>
        </center>            
    </div>
</body>
</html>