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
                    <td style="width: 10%"><img src="{{ public_path('storage/logo/fima.png') }}" width="150" height="75"></td>
                    <td>
                        <center>
                            <b><font>PT. FINUSOLPRIMA (a Kalbe Company)</font></b>
                            <br>
                            <b><font>DEPARTEMEN HRD - JAKARTA</font></b>
                        </center>
                    </td>
                </tr>
                
            </table>
        </center>
            {{-- <p>
                NO &emsp;&emsp;&emsp;&emsp;:<br>
                KEPADA &emsp;&ensp;: LAB.<br>
                DARI &emsp;&emsp;&emsp;: Irene - Divisi HRD<br>
            </p> --}}
            <div style="margin-top: 1em">
                <span style="width: 15%; display: inline-block;">NO</span><span style="width: 80%; display: inline-block;">: {{ $NO_SURAT }}</span><br>
                <span style="width: 15%; display: inline-block;">KEPADA</span><span style="width: 80%; display: inline-block;">: LAB.{{ $INFO_LAB[0]->NamaLab }}</span><br>
                <span style="width: 15%; display: inline-block;">DARI</span><span style="width: 80%; display: inline-block;">: Irene - Divisi HRD</span><br>
            </div>
            <hr>
            <p>
                Bersama ini, kami mohon bantuan dari Bapak/ Ibu untuk dapat melaksanakan proses TES KESEHATAN yang dijadwalkan pada:<br>
                Terhadap kandidat kami, dengan detail sebagai berikut:
            </p>
            <center>
                <table width="70%" id="listkandidat" style="margin-left:15%">
                    <thead>
                        <tr>
                            <th width=10%>NO</th>
                            <th>NAMA</th>
                            <th>NO TLP</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i=0;$i<count($INFO_KANDIDAT);$i++)
                            <tr align="center">
                                <td>{{ $i+1 }}</td>
                                <td>{{ trim($INFO_KANDIDAT[$i]->namalengkap) }}</td>
                                @if (in_array($INFO_KANDIDAT[$i]->id,$List_id_P))
                                    @foreach ($INFO_TLP as $tlp )
                                        @if ($tlp->id_Tkandidat==$INFO_KANDIDAT[$i]->id)
                                            <td>{{ trim($tlp->phoneNumber) }}</td>  
                                        @endif
                                    @endforeach
                                @else
                                    <td></td>
                                @endif
                                {{-- @foreach ($INFO_TLP as $tlp )
                                    @if (in_array($tlp->id_Tkandidat, $List_id))
                                        @if ($tlp->id_Tkandidat==$INFO_KANDIDAT[$i]->id)
                                            <td>{{ trim($tlp->phoneNumber) }}</td>  
                                        @endif
                                    @else
                                        <td></td>
                                    @endif
                                @endforeach --}}
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </center>
            <br>
            <p>Adapun tes kesehatan yang dilakukan meliputi:</p>
            <ol>
                <li>Darah Rutin (Hb, Leuco, Diff, LED, HBsAg, SGOT, SGPT)</li>
                <li>Urine rutin (Alb, Red, Sed)</li>
                <li>Torax</li>
                <li>Pemeriksaan Fisik</li>
            </ol> 
            <p>Hasilnya mohon dikirimkan ke:</p><br>
                <center>
                    <p>PT. FINUSOLPRIMA FARMA INTERNASIONAL (Kalbe Company)<br>
                        Alamat : Kawasan Bintang Toedjoe<br>
                        Jl. Jend. Ahmad Yani No.2, RT.3/RW.13, Kayu Putih, Kec. Pulo Gadung, <br>
                        Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13210 <br>
                        UP: IRENE -  HRD FIMA <br>
                        TELP: 021-50867667 ext 8032 <br>
                        Email: irene.olivianti@fimafarma.com cc: hrd.fima@gmail.com
                    </p>
                </center>
                <br>
                <p>Untuk hasil test kesehatan mohon dapat dikirimkan melalui e-mail ke alamat di atas terlebih dahulu dan untuk  hasil test asli dapat dikirimkan menyusul via pos <br>
                    Demikian surat pengantar ini kami kirimkan untuk dapat ditindaklanjuti. Terima kasih atas perhatian dan kerja samanya.
                <br>
                <br>
                Hormat kami,<br><br><br><br>
                
                Irene Virta O
            </p>
    </div>

    <p style="page-break-after: always"></p>

    <div>
        <center>
            <table width="100%" id="kopsurat">
                <tr>
                    <td style="width: 10%"><img src="{{ public_path('storage/logo/fima.png') }}" width="150" height="75"></td>
                    <td>
                        <center>
                            <b><font>PT. KALBE FARMA TBK (BISNIS UNIT ETHICAL)</font></b>
                            <br>
                            <b><font>DEPARTEMEN HRD- CEMPAKA PUTIH</font></b>
                        </center>
                    </td>
                </tr>
                
            </table>
        </center>
        <center>
            <p>RIWAYAT KESEHATAN</p>
        </center>
        <p>I&emsp;&emsp;&emsp;&emsp;DATA PRIBADI</p>
        <table>
            <tbody>
                <tr>
                    <td width="5%">NAMA:</td>
                    <td width="5%">Reg.No:</td>
                </tr>
                <tr>
                    <td width="5%">USIA:</td>
                    <td width="5%">Instansi:</td>
                </tr>
            </tbody>
        </table>
        <p>II&emsp;&emsp;&emsp;&emsp;ANAMNESIS</p>
        <table width=50%>
            <tr>
                <td width="0.3%">a.</td>
                <td width="5%">Keluhan Saat ini :</td>
            </tr>
            {{-- 
            <tr>
                <td width="0.3%">1</td>
                <td width="5%">Pernahkah anda : </td>
                <td>Yes</td>
                <td>No</td>
                <td>Keterangan</td>
            </tr> --}}
        </table>
        <br>
        <table width=50%>
            <tr>
                <td width="0.3%">b.</td>
                <td width="5%">Riwayat</td>
            </tr>
        </table>
        <table width=70%>
            <tr>
                <td width="1%">1</td>
                <td width="40%">Pernahkah anda : </td>
                <td width=3%>Yes</td>
                <td width=3%>No</td>
                <td width=10%>Keterangan</td>
            </tr>
            <tr>
                <td width="1%">1.1</td>
                <td width="40%">Dirawat di rumah sakit ?</td>
                <td width=3%>(&emsp;)</td>
                <td width=3%>(&emsp;)</td>
                <td width=10% style="border-bottom: 1px solid black;"></td>
            </tr>
            <tr>
                <td width="1%">1.2</td>
                <td width="40%">Operasi ?</td>
                <td width=3%>(&emsp;)</td>
                <td width=3%>(&emsp;)</td>
                <td width=10% style="border-bottom: 1px solid black;"></td>
            </tr>
            <tr>
                <td width="1%">1.3</td>
                <td width="40%">Kecelakaan ?</td>
                <td width=3%>(&emsp;)</td>
                <td width=3%>(&emsp;)</td>
                <td width=10% style="border-bottom: 1px solid black;"></td>
            </tr>
            <tr>
                <td width="1%">1.4</td>
                <td width="40%">Hipertensi ?</td>
                <td width=3%>(&emsp;)</td>
                <td width=3%>(&emsp;)</td>
                <td width=10% style="border-bottom: 1px solid black;"></td>
            </tr>
            <tr>
                <td width="1%">1.5</td>
                <td width="40%">Angina, nyeri dada, demam, rematik, atau gangguan jantung lainnya ?</td>
                <td width=3%>(&emsp;)</td>
                <td width=3%>(&emsp;)</td>
                <td width=10% style="border-bottom: 1px solid black;"></td>
            </tr>
            <tr>
                <td width="1%">1.6</td>
                <td width="40%">Asma atau wheezing ?</td>
                <td width=3%>(&emsp;)</td>
                <td width=3%>(&emsp;)</td>
                <td width=10% style="border-bottom: 1px solid black;"></td>
            </tr>
            <tr>
                <td width="1%">1.7</td>
                <td width="40%">Tuberkulosis, pneumonia atau gangguan paru lainnya ?</td>
                <td width=3%>(&emsp;)</td>
                <td width=3%>(&emsp;)</td>
                <td width=10% style="border-bottom: 1px solid black;"></td>
            </tr>
            <tr>
                <td width="1%">1.8</td>
                <td width="40%">Gangguan lambung, pencernaan, darah pada faces atau muntahan, haemonhoid, hernia ?</td>
                <td width=3%>(&emsp;)</td>
                <td width=3%>(&emsp;)</td>
                <td width=10% style="border-bottom: 1px solid black;"></td>
            </tr>
            <tr>
                <td width="1%">1.9</td>
                <td width="40%">Gangguan ginjal atau saluran kemih, batu ginjal, atau infeksi saluran kemih ?</td>
                <td width=3%>(&emsp;)</td>
                <td width=3%>(&emsp;)</td>
                <td width=10% style="border-bottom: 1px solid black;"></td>
            </tr>
            <tr>
                <td width="1%">1.10</td>
                <td width="40%">Gangguan gineakologi ?	</td>
                <td width=3%>(&emsp;)</td>
                <td width=3%>(&emsp;)</td>
                <td width=10% style="border-bottom: 1px solid black;"></td>
            </tr>
            <tr>
                <td width="1%">1.11</td>
                <td width="40%">Penyakit kelamin ?</td>
                <td width=3%>(&emsp;)</td>
                <td width=3%>(&emsp;)</td>
                <td width=10% style="border-bottom: 1px solid black;"></td>
            </tr>
            <tr>
                <td width="1%">1.12</td>
                <td width="40%">Gangguan mental, depresi, percobaan bunuh diri ?</td>
                <td width=3%>(&emsp;)</td>
                <td width=3%>(&emsp;)</td>
                <td width=10% style="border-bottom: 1px solid black;"></td>
            </tr>
            <tr>
                <td width="1%">1.13</td>
                <td width="40%">Menggunakan kacamata atau lensa kontak ?</td>
                <td width=3%>(&emsp;)</td>
                <td width=3%>(&emsp;)</td>
                <td width=10% style="border-bottom: 1px solid black;"></td>
            </tr>
            <tr>
                <td width="1%">1.14</td>
                <td width="40%">Epilepsi, kesulitan bicara, kejang ?</td>
                <td width=3%>(&emsp;)</td>
                <td width=3%>(&emsp;)</td>
                <td width=10% style="border-bottom: 1px solid black;"></td>
            </tr>
            <tr>
                <td width="1%">1.15</td>
                <td width="40%">Penyakit atau trauma mata ?</td>
                <td width=3%>(&emsp;)</td>
                <td width=3%>(&emsp;)</td>
                <td width=10% style="border-bottom: 1px solid black;"></td>
            </tr>
            <tr>
                <td width="1%">1.16</td>
                <td width="40%">Kelenjar endokrin lainnya ?</td>
                <td width=3%>(&emsp;)</td>
                <td width=3%>(&emsp;)</td>
                <td width=10% style="border-bottom: 1px solid black;"></td>
            </tr>
            <tr>
                <td width="1%">1.17</td>
                <td width="40%">Gangguan telinga, hidung, pendengaran ?</td>
                <td width=3%>(&emsp;)</td>
                <td width=3%>(&emsp;)</td>
                <td width=10% style="border-bottom: 1px solid black;"></td>
            </tr>
            <tr>
                <td width="1%">1.18</td>
                <td width="40%">Arthritis, gangguan persendian, atau tulang belakang ?</td>
                <td width=3%>(&emsp;)</td>
                <td width=3%>(&emsp;)</td>
                <td width=10% style="border-bottom: 1px solid black;"></td>
            </tr>
            <tr>
                <td width="1%">1.19</td>
                <td width="40%">Hepatitis atau kuning, demam tifoid, kolera atau penyakit tropik lainnya ?</td>
                <td width=3%>(&emsp;)</td>
                <td width=3%>(&emsp;)</td>
                <td width=10% style="border-bottom: 1px solid black;"></td>
            </tr>
            <tr>
                <td width="1%">1.20</td>
                <td width="40%">Kelainan berat yang belum disebutkan diatas?</td>
                <td width=3%>(&emsp;)</td>
                <td width=3%>(&emsp;)</td>
                <td width=10% style="border-bottom: 1px solid black;"></td>
            </tr>
        </table>
        <table width=70% style="padding-top: 1.5em">
            <tr>
                <td width="1%">2</td>
                <td width="40%">Apakah Anda: </td>
                <td width=3%></td>
                <td width=3%></td>
                <td width=10%></td>
            </tr>
            <tr>
                <td width="1%"></td>
                <td width="40%">-&emsp;merokok, jika ya, berapa banyak : </td>
                <td width=3%>(&emsp;)</td>
                <td width=3%>(&emsp;)</td>
                <td width=10% style="border-bottom: 1px solid black;"></td>
            </tr>
            <tr>
                <td width="1%"></td>
                <td width="40%">-&emsp;mengkonsumsi alkohol atau obat2an? </td>
                <td width=3%>(&emsp;)</td>
                <td width=3%>(&emsp;)</td>
                <td width=10% style="border-bottom: 1px solid black;"></td>
            </tr>
        </table>
        <table width=70% style="padding-top: 1.5em">
            <tr>
                <td width="1%">3</td>
                <td width="40%">Apakah Anda alergi terhadap obat-obatan, Makanan, bahan kimia ?</td>
                <td width=3%>(&emsp;)</td>
                <td width=3%>(&emsp;)</td>
                <td width=10% style="border-bottom: 1px solid black;"></td>
            </tr>
        </table>
        <br>
        <p>Saya menyatakan informasi yang diberikan adalah sebenar-benarnya dan dapat dipergunakan oleh dokter untuk menilai kondisi kesehatan saya</p>
        <br>
        <p>............., .................20...</p>
        <br>
        <br>
        <br>
        <table width=100%>
            <tr>
                <td width=70%>dokter pemeriksa</td>
                <td>Peserta Medical Check Up</td>
            </tr>
        </table>
    </div>

    <p style="page-break-after: always"></p>
    <div>
        <center>
            <table width="100%" id="kopsurat">
                <tr>
                    <td style="width: 10%"><img src="{{ public_path('storage/logo/fima.png') }}" width="150" height="75"></td>
                    <td>
                        <center>
                            <b><font>PT. KALBE FARMA TBK (BISNIS UNIT ETHICAL)</font></b>
                            <br>
                            <b><font>DEPARTEMEN HRD- CEMPAKA PUTIH</font></b>
                        </center>
                    </td>
                </tr>
                
            </table>
        </center>
        <center>
            <p>HASIL PEMERIKSAAN FISIK</p>
        </center>
        <center>
            <p>DATA PASIEN</p>
        </center>
        <table width=100%>
            <tr>
                <td>No. Reg.	:</td>
                <td>Tinggi Badan		:</td>
            </tr>
            <tr>
                <td>Nama		: </td>
                <td>Berat Badan		:</td>
            </tr>
            <tr>
                <td>Umur		: </td>
                <td>Tekanan darah		:</td>
            </tr>
            <tr>
                <td>Alamat		:</td>
                <td>Nadi			:</td>
            </tr>
            <tr>
                <td>Perusahaan	:</td>
                <td>Anemik/ Ikterik	:</td>
            </tr>
        </table>
        <center>
            <p>STATUS LOCALIS</p>
        </center>
        <table width=100%>
            <tr>
                <td>Kepala		:</td>
                <td></td>
            </tr>
            <tr>
                <td>Leher		:</td>
                <td>Strauma		:</td>
            </tr>
            <tr>
                <td></td>
                <td>Kelenjar Limfa		:</td>
            </tr>
            <tr>
                <td></td>
                <td>JVP			:</td>
            </tr>
            <tr>
                <td>Dada		:</td>
                <td>Dinding Thorax</td>
            </tr>
            <tr>
                <td></td>
                <td>-&emsp;Diam		:</td>
            </tr>
            <tr>
                <td></td>
                <td>-&emsp;Bernafas		:</td>
            </tr>
            <tr>
                <td></td>
                <td>Paru-paru</td>
            </tr>
            <tr>
                <td></td>
                <td>-&emsp;Suara / Nafas	:</td>
            </tr>
            <tr>
                <td></td>
                <td>-&emsp;Ronchi/Wheezing	:</td>
            </tr>
            <tr>
                <td></td>
                <td>Jantung</td>
            </tr>
            <tr>
                <td></td>
                <td>-&emsp;Suara jantung	:</td>
            </tr>
            <tr>
                <td></td>
                <td>-&emsp;Irama jantung	:</td>
            </tr>
            <tr>
                <td>Perut</td>
                <td>Dinding perut		:</td>
            </tr>
            <tr>
                <td></td>
                <td>Nyeri tekan		:</td>
            </tr>
            <tr>
                <td></td>
                <td>Tumor			:</td>
            </tr>
            <tr>
                <td></td>
                <td>Hernia			:</td>
            </tr>
            <tr>
                <td></td>
                <td>Bekas operasi			:</td>
            </tr>
            <tr>
                <td></td>
                <td>Liver			:</td>
            </tr>
            <tr>
                <td></td>
                <td>Usus suara			:</td>
            </tr>
            <tr>
                <td>Anggota gerak:</td>
                <td>Tonus otot		:</td>
            </tr>
            <tr>
                <td></td>
                <td>Parese/Palayse			:</td>
            </tr>
            <tr>
                <td></td>
                <td>Tremor			:</td>
            </tr>
            <tr>
                <td></td>
                <td>Atrofi			:</td>
            </tr>
            <tr>
                <td></td>
                <td>Oedema			:</td>
            </tr>
            <tr>
                <td></td>
                <td>Deformitas			:</td>
            </tr>
            <tr>
                <td></td>
                <td>R. patologis			:</td>
            </tr>
            <tr>
                <td>Mata</td>
                <td>Visus		:</td>
            </tr>
            <tr>
                <td></td>
                <td>Buta warna		:</td>
            </tr>
            <tr>
                <td>Gigi</td>
                <td>Caries (ada / tidak)		:</td>
            </tr>
        </table>
        <p>KESIMPULAN: <br><br>
            SARAN:<br><br>
            ............., .................20... <br><br><br><br><br>
            Dokter pemeriksa
        </p>
    </div>

</body>
</html>