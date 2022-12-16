<!DOCTYPE html>
<head>
    <style>
        #listkandidat, #listkandidat td, #listkandidat th {
            border: 1px solid black;
        }
        #kopsurat{
            border-bottom: 3px solid black;
        }
        /* table, th, td {
        border: 1px solid black;
        font-size: 12px;
        } */
        
    </style>
</head>
<body>
    <div>
        <center>
            <table width="100%" id="kopsurat">
                <tr>
                    <td style="width: 10%"><img src="{{ public_path('storage/logo/hj.png') }}" width="150" height="75"></td>
                    <td>
                        <center>
                            <b><font>PT.Hexpharm Jaya Laboratories</font></b><br>
                            <b><font>JL. Jend. Ahmad Yani No.2</font></b><br>
                            <b><font>Kel. Kayu Putih, Kec. Pulo Gadung, Kota Jakarta Timur</font></b><br>
                            <b><font>Daerah Khusus Ibukota Jakarta</font></b><br>
                            <b><font>(Area PT. Bintang Toedjoe)</font></b>
                        </center>
                    </td>
                </tr>
                
            </table>
        </center>
            <p>
                Jakarta, {{ $TGL }}<br>
                Kepada Yth.<br>
                @if (count($INFO_LAB)>0)
                {{ $INFO_LAB[0]->NamaLab }}<br>
                {{ $INFO_LAB[0]->alamat }}<br><br>
                @endif
                

                <b>Up:  MCU</b><br>
                <b>Telp/e-mail:</b>
                @if (count($INFO_LAB)>0)
                {{ $INFO_LAB[0]->noTlp }}/{{ $INFO_LAB[0]->email }}
                @endif
                <br>
                Hal	:<b>Permohonan Pemeriksaan Kesehatan</b>
                <br><br>
                Dengan hormat, <br><br>
                Dengan ini kami mohon bantuan dokter untuk mengadakan pemeriksaan kesehatan terhadap calon karyawan  PT. Hexpharm Jaya Laboratories pada <b>{{ str_replace(':00.000','',$Data[0]->jadwal) }}</b>. Adapun data ybs adalah sebagai berikut :
            </p>
            <center>
                <table width="70%" id="listkandidat" style="margin-left:15%">
                    <thead>
                        <tr>
                            <th width=10%>No</th>
                            <th>Nama</th>
                            <th>Usia</th>
                            <th>Status</th>
                            <th>Calon Jabatan</th>
                            <th>Lingkungan Kerja</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{ $i=1 }}
                        @foreach ($INFO_KANDIDAT as $kandidat )
                            <tr>
                                <td>{{ $i }}
                                <td>{{ $kandidat->namalengkap }}</td>
                                <td>{{ $kandidat->umur }}</td>
                                <td>{{ $kandidat->MaritalSt }}</td>
                                <td>{{ $kandidat->nama }}</td>
                                <td></td>
                            </tr>
                            {{ $i+=1 }}
                        @endforeach
                    </tbody>
                </table>
            </center>
        <p>Pemeriksaan yang diharapkan adalah:</p>
        <ol>
            <li>Pemeriksaan Fisik Lengkap</li>
            <li>Pemeriksaan Hematologi Lengkap</li>
            <li>Pemeriksaan SGOT & SGPT</li>
            <li>Pemeriksaan Urine Rutin</li>
            <li>HBSAG & Rontgen Thorax</li>
        </ol> 
        <p>Mohon hasil tes kesehatan dikirimkan terlebih dahulu dalam bentuk <i>softcopy</i> melalui email ke <b>kierra.yuhanus@hexpharmjaya.com paling lambat H+3 setelah tes kesehatan dilaksanakan</b>.<br> 
            Hasil tes dalam bentuk hardcopy dan tagihan dapat dikirimkan menyusul ke alamat yang tertera di atas. Apabila terdapat kesalahan dalam pengiriman hasil tes kesehatan dan tagihan <b>(tidak sesuai dengan alamat di atas)</b>
            , maka kami <b>tidak akan menanggung tagihan pembayaran tersebut.</b><br><br>
            Atas perhatian dan kerjasamanya, kami ucapkan terima kasih.<br><br>
            Hormat kami,<br><br><br><br>
            <b><u>Luky Virdayanti</u></b><br>
            <b>HC Head</b>
            
        </p>
            
    </div>
</body>
</html>