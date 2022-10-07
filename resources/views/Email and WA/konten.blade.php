<!DOCTYPE html>
<html>
	{{-- 1->sourece
	2->MCU
	3->psikotest
	4->tech test
	5->interview hr
	6->interview user
	9->offer --}}
	<head>
	<title>Suart 1</title>
</head>
<body>
	@if ($datas['jenisemail']==1)
		@if ($datas['org']=='2')
			Hi {{ $datas['nama'] }} <br>
			Greetings!<br><br>
			Thank you for applying for the role of {{ $datas['posisi'] }} at FIMA (Kalbe Group).<br><br>
			We really perceive your interest in our company, and appreciate the time and energy you put into applying to this job position. This email is to confirm your application details have been received.<br><br>
			We received a huge number of applications, so please be informed that it will take some time for us to review your application as well. You will be informed by email when we found a matching position for your stunning profile, interests, and background.<br><br>
			In the meantime you can check more about us through our Social Media (@fima.care). We also regularly post new opportunities on our job vacancy page here, so keep an eye to any position that could be an interest for you.<br><br>
			NOTE : Recruitment process in FIMA (Kalbe Group)  are free from any charge.<br><br>
			Best Regards,<br>
			Recruitment Team<br>
			PT Finusolprima Farma Internasional (FIMA)

		@else
			Hi {{ $datas['nama'] }} <br>
			Greetings!<br><br>
			Thank you for applying for the role of {{ $datas['posisi'] }} at 
			@if ($datas['org']=='1')
			PT Kalbe Farma Tbk<br>
			@elseif($datas['org']=='2')
			PT Finusolprima Farma Internasional<br>
			@elseif ($datas['org']=='3')
			PT Hexpharm Jaya Laboratories<br>	
			@endif
			<br>
			We really perceive your interest in our company, and appreciate the time and energy you put into applying to this job position.
			This email is to confirm your application details have been received.
			<br><br>
			We received a huge number of applications, so please be informed that it will take some time for us to review your application as well.
			You will be informed by email when we found a matching position for your stunning profile, interests, ang background.
			<br><br>
			In the meantime you can check more about us through our Social Media (@kalbekarir) and our Company Page (https://www.kalbe.co.id/).
			We also regularly post new opportunities on our job vacancy page here, so keep an eye to any position that could be an interest for you.
			<br><br>
			Best Regards<br>
			Talent Acquisition Team<br>
			@if ($datas['org']=='1')
			PT Kalbe Farma Tbk<br>
			@elseif($datas['org']=='2')
			PT Finusolprima Farma Internasional<br>
			@elseif ($datas['org']=='3')
			PT Hexpharm Jaya Laboratories<br>	
			@endif
			<br><br><br><hr>

			Dear {{ $datas['nama'] }} <br>
			Greetings!<br><br>

			Terima kasih telah melamar untuk posisi {{ $datas['posisi'] }} di
			@if ($datas['org']=='1')
			PT Kalbe Farma Tbk<br>
			@elseif($datas['org']=='2')
			PT Finusolprima Farma Internasional<br>
			@elseif ($datas['org']=='3')
			PT Hexpharm Jaya Laboratories<br>	
			@endif
			<br>
			Kami sangat menghargai waktu dan energi yang Anda berikan untuk melamar posisi pekerjaan ini. Melalui email ini, kami ingin menginformasikan detail lamaran Anda telah diterima.<br><br>
			Dengan banyaknya jumlah pelamar yang kami terima, mohon pengertiannya bahwa kami juga membutuhkan waktu untuk meninjau lamaran Anda. 
			Anda akan diberi informasi lebih lanjut melalui email ketika kami menemukan posisi yang cocok untuk profil, minat, dan latar belakang Anda.<br><br>
			Sembari menunggu konfirmasi,  Anda dapat memeriksa lebih lanjut tentang kami melalui Media Sosial kami (@kalbekarir) dan Halaman Perusahaan kami (https://www.kalbe.co.id/). 
			Kami juga secara teratur memposting peluang baru di halaman lowongan kerja kami, jadi pantau terus posisi apa pun yang mungkin menarik bagi Anda.<br><br>
			NOTE: Seluruh proses recruitment di PT. Hexpharm Jaya Laboratories tidak memungut biaya apapun.<br><br>
			Best Regards<br>
			Talent Acquisition Team<br>
			@if ($datas['org']=='1')
			PT Kalbe Farma Tbk<br>
			@elseif($datas['org']=='2')
			PT Finusolprima Farma Internasional<br>
			@elseif ($datas['org']=='3')
			PT Hexpharm Jaya Laboratories<br>	
			@endif
		@endif
	@elseif ($datas['jenisemail']==2)
		@if ($datas['org']=='2')
			Selamat siang,<br><br>
			Dengan ini saya informasikan bahwa Anda telah melalui tahap seleksi Wawancara PT FINUSOLPRIMA FARMA INTERNASIONAL (a Kalbe Company).<br>
			Tahap seleksi berikutnya adalah Pemeriksaan Kesehatan (MCU), adapun pelaksanaan MCU akan diadakan pada:<br><br>
			Tanggal/Waktu:{{ $datas['dateTime'] }}<br>
			Tempat:{{ $datas['namalab'] }} <br>
			Alamat:{{ $datas['alamatlab'] }} <br><br>
			<b>Catatan:</b><br>
			<b>
				<ol>
					<li>Lakukan puasa (tidak makan dan tidak minum selain air mineral) minimal 8 jam sebelum MCU.</li>
					<li>Ketika datang ke klinik, silahkan ke bagian pendaftaran dan informasikan bahwa Anda kandidat PT Fima, Kalbe Group.</li>
					<li>Apabila nantinya kandidat dinyatakan lolos dari proses MCU namun mundur dengan alasan apapun, wajib melakukan penggantian biaya MCU sebesar Rp 766.890</li>
				  </ol> 
			</b><br><br>
			<b>Mohon membalas email ini sebagai notifikasi bahwa email ini sudah diterima dengan baik dan sebagai persetujuan terkait catatan diatas</b>
			<br><br>
			Best Regards,<br>
			Recruitment Team<br>
			PT Finusolprima Farma Internasional (FIMA)
		@else
			@if ($datas['bahasa']=='IN')
				Dear {{ $datas['nama'] }}, <br>
				Greetings!<br><br>

				Terima kasih telah melamar untuk posisi [NAMA POSISI] di 
				@if ($datas['org']=='1')
				PT Kalbe Farma Tbk
				@elseif($datas['org']=='2')
				PT Finusolprima Farma Internasional
				@elseif ($datas['org']=='3')
				PT Hexpharm Jaya Laboratories	
				@endif
				<br><br>
				Bersamaan dengan email ini, kami ingin menjadwalkan Anda untuk mengikuti proses Medical Check-Up yang dilaksanakan pada:<br>
				Tanggal/waktu: {{ $datas['dateTime'] }}<br>
				Lokasi:{{ $datas['namalab'] }} <br>
				Alamat:{{ $datas['alamatlab'] }} <br><br>
				Mohon hadir tepat waktu sesuai jadwal yang telah ditentukan dan silahkan perhatikan informasi berikut:<br>
				<ol>
					<li>Membawa kartu identitas berupa Kartu Tanda Penduduk (KTP).</li>
					<li>Melakukan puasa 12 - 14 jam sebelum waktu medical check-up yang telah ditentukan.</li>
					<li>Pastikan Anda memiliki waktu tidur yang cukup dan makan sebelum waktu puasa.</li>
					<li>Jika Anda sudah sampai di klinik dan selesai mengikuti seluruh tahapan medical check-up, mohon memberikan informasi melalui WA kepada kami.</li>
				</ol>
				<br>
				Jika Anda memiliki pertanyaan, silahkan  menghubungi kami lebih lanjut. <br>
				Terima kasih!<br><br>
				NOTE: Seluruh proses recruitment di 
				@if ($datas['org']=='1')
				PT Kalbe Farma Tbk<br>
				@elseif($datas['org']=='2')
				PT Finusolprima Farma Internasional<br>
				@elseif ($datas['org']=='3')
				PT Hexpharm Jaya Laboratories<br>	
				@endif
				tidak memungut biaya apapun.<br><br>
				Best Regards<br>
				Talent Acquisition Team<br>
				@if ($datas['org']=='1')
				PT Kalbe Farma Tbk<br>
				@elseif($datas['org']=='2')
				PT Finusolprima Farma Internasional<br>
				@elseif ($datas['org']=='3')
				PT Hexpharm Jaya Laboratories<br>	
				@endif	
			@elseif ($datas['bahasa']=='ENG')
				Hello {{ $datas['nama'] }}, <br>
				Greetings!<br><br>
				Following your recruitment process in our company for the {{ $datas['posisi'] }} role at 
				@if ($datas['org']=='1')
				PT Kalbe Farma Tbk
				@elseif($datas['org']=='2')
				PT Finusolprima Farma Internasional
				@elseif ($datas['org']=='3')
				PT Hexpharm Jaya Laboratories	
				@endif
				, We would like to invite you for the Medical Check Up session ;<br>s
				Please see the following information, regarding your Medical Check Up; <br>
				Date and Time &emsp;&emsp;:  {{ $datas['dateTime'] }} <br>
				Test Duration &emsp;&ensp;&ensp;&nbsp;&nbsp;:{{ $datas['durasi'] }} <br>
				Location&emsp;&emsp;&emsp;&emsp;&ensp;&nbsp;:{{ $datas['namalab'] }} <br>
				Detail Address&emsp;&ensp;&ensp;&nbsp;:{{ $datas['alamatlab'] }} <br><br>
				<p>
					I hope the schedule is suitable for you. Related to this process, you just need to come to the Clinic mentioned above by the time that has been decided.
					<b>Please bring your identity card (KTP - Kartu Tanda Penduduk) together with you.</b> Prior to the examination, make sure you have enough time to sleep and eat well. 
					In case you have any questions, please don't hesitate to contact us. You can find our contact details below. <br><br>
					Thank you in advance and stay healthy! <br><br>
					NOTE : Recruitment process in 
					@if ($datas['org']=='1')
					PT Kalbe Farma Tbk<br>
					@elseif($datas['org']=='2')
					PT Finusolprima Farma Internasional<br>
					@elseif ($datas['org']=='3')
					PT Hexpharm Jaya Laboratories<br>	
					@endif
					are free from any charge.
				</p>
				Best Regards<br>
				Talent Acquisition Team<br>
				@if ($datas['org']=='1')
				PT Kalbe Farma Tbk<br>
				@elseif($datas['org']=='2')
				PT Finusolprima Farma Internasional<br>
				@elseif ($datas['org']=='3')
				PT Hexpharm Jaya Laboratories<br>	
				@endif
			@endif
		@endif

		
		
	@elseif ($datas['jenisemail']==3)
		@if ($datas['bahasa']=='IN')
			Dear  {{ $datas['nama'] }}, <br>
			Greetings!<br><br>
			Terima kasih telah melamar untuk posisi {{ $datas['posisi'] }} di 
			@if ($datas['org']=='1')
			PT Kalbe Farma Tbk<br>
			@elseif($datas['org']=='2')
			PT Finusolprima Farma Internasional<br>
			@elseif ($datas['org']=='3')
			PT Hexpharm Jaya Laboratories<br>	
			@endif
			<br>
			Berdasarkan hasil Interview yang sebelumnya telah Anda lalui, kami ingin mengundang Anda untuk memasuki tahap berikutnya,
			 yaitu Psikotes yang dilaksanakan secara online, yang dilaksanakan pada:<br>
			Tanggal/Waktu:{{ $datas['dateTime'] }}<br>
			Durasi:{{ $datas['durasi'] }}<br>
			Link:{{ $datas['link'] }}<br>
			PIC:{{ $datas['PIC'] }} <br><br>
			Mohon mempersiapkan hal-hal berikut demi kelancaran proses Psikotes:<br>
			<ol>
				<li>Laptop atau Komputer dengan webcam. Selama proses berlangsung, Anda diwajibkan untuk menyalakan kamera.</li>
				<li>Koneksi internet yang stabil.</li>
				<li>Berada pada lokasi dan situasi yang kondusif agar pengerjaan tes berjalan dengan lancar.</li>
			</ol><br><br>
			Untuk informasi lebih lanjut, Anda akan dihubungi oleh Person in Charge (PIC) dari vendor psikotes kami.<br><br>
			Jika ada hal-hal yang ingin ditanyakan, silahkan menghubungi kami lebih lanjut.<br>
			Terima kasih!<br>
			NOTE: Seluruh proses recruitment di 
			@if ($datas['org']=='1')
			PT Kalbe Farma Tbk
			@elseif($datas['org']=='2')
			PT Finusolprima Farma Internasional
			@elseif ($datas['org']=='3')
			PT Hexpharm Jaya Laboratories	
			@endif
			tidak memungut biaya apapun.<br><br>

			Best Regards<br>
			Talent Acquisition Team<br>
			@if ($datas['org']=='1')
			PT Kalbe Farma Tbk<br>
			@elseif($datas['org']=='2')
			PT Finusolprima Farma Internasional<br>
			@elseif ($datas['org']=='3')
			PT Hexpharm Jaya Laboratories<br>	
			@endif


		@elseif ($datas['bahasa']=='ENG')
			Hello {{ $datas['nama'] }}, <br>
			Greetings!<br><br>
			Thank you for expressing your interest applying to 
			@if ($datas['org']=='1')
			PT Kalbe Farma Tbk<br>
			@elseif($datas['org']=='2')
			PT Finusolprima Farma Internasional<br>
			@elseif ($datas['org']=='3')
			PT Hexpharm Jaya Laboratories<br>	
			@endif
			Your application to the {{ $datas['posisi'] }} position, stood us and we would like to invite you to the next recruitment process, Online Test.<br>
			This will be an Online Test, kindly please keep that in mind. As a result, you'll need to prepare for a few things in order to certify your participation in this procedure.<br>
			<ol>
				<li>A Laptop or Computer with a webcam. Turning the camera on during the test will be mandatory.</li>
				<li>A stable internet connection during the test.</li>
				<li>Comfortable room in order for you to be in your most optimal condition while doing our assessment.</li>
			</ol><br><br>
			Please see the following information, regarding your Online Test assessment;<br>
			Date and Time &emsp;&emsp;:{{ $datas['dateTime'] }}<br>
			Test Duration &emsp;&ensp;&ensp;&nbsp;&nbsp;:{{ $datas['durasi'] }}<br>
			Test Link&emsp;&emsp;&emsp;&emsp;&ensp;:{{ $datas['link'] }}<br>
			PIC&emsp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&nbsp;:{{ $datas['PIC'] }} <br><br>
			<p>
				I hope the online test schedule is suitable for you. We look forward to speaking with you. 
				In case you have any questions, please don't hesitate to contact us. You can find our contact details below.<br><br>
				Thank you in advance and stay healthy!<br><br>
				NOTE : Recruitment process in 
				@if ($datas['org']=='1')
				PT Kalbe Farma Tbk<br>
				@elseif($datas['org']=='2')
				PT Finusolprima Farma Internasional<br>
				@elseif ($datas['org']=='3')
				PT Hexpharm Jaya Laboratories<br>	
				@endif
				are free from any charge.<br><br>
			</p>
			Best Regards<br>
			Talent Acquisition Team<br>
			@if ($datas['org']=='1')
			PT Kalbe Farma Tbk<br>
			@elseif($datas['org']=='2')
			PT Finusolprima Farma Internasional<br>
			@elseif ($datas['org']=='3')
			PT Hexpharm Jaya Laboratories<br>	
			@endif
		@endif
		
	@elseif($datas['jenisemail']==4)
		{{-- techtest gak ada emailnya --}}
		@if ($datas['bahasa']=='IN')
		@elseif ($datas['bahasa']=='ENG')
		@endif
	@elseif($datas['jenisemail']==5)
		@if ($datas['bahasa']=='IN')
			Dear {{ $datas['nama'] }}, <br>
			Greetings!<br><br>
			Terima kasih telah melamar untuk posisi {{ $datas['posisi'] }} di PT. Hexpharm Jaya Laboratories!
			Kami telah meninjau materi lamaran Anda dengan saksama, dan dengan senang hati kami mengundang Anda dalam mengikuti proses interview untuk posisi tersebut. 
			Interview dilaksanakan secara online selama kurang lebih {{ $datas['durasi'] }} dan diskusi dilakukan bersama {{ $datas['PIC'] }} dari @if ($datas['org']=='1')
			PT Kalbe Farma Tbk<br>
			@elseif($datas['org']=='2')
			PT Finusolprima Farma Internasional<br>
			@elseif ($datas['org']=='3')
			PT Hexpharm Jaya Laboratories<br>	
			@endif
			<br>
			Online interview akan dilaksanakan pada:<br>
			Tanggal/Waktu:{{ $datas['dateTime'] }}<br>
			Link:{{ $datas['link'] }}<br>
			MeetingID:{{ $datas['meetingID'] }}<br>
			Passcode:{{ $datas['passcode'] }}<br>
			Breakout Room&emsp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&nbsp;:{{ $datas['breakoutroom'] }} <br><br>
			Mohon hadir tepat waktu sesuai jadwal yang telah ditentukan dan menunggu di waiting room hingga mendapatkan akses untuk bergabung ke dalam link interview.<br><br>
			Jika ada hal-hal yang ingin ditanyakan, silahkan menghubungi kami lebih lanjut.<br>
			Terima kasih!<br><br>
			NOTE: Seluruh proses recruitment di 
			@if ($datas['org']=='1')
			PT Kalbe Farma Tbk
			@elseif($datas['org']=='2')
			PT Finusolprima Farma Internasional
			@elseif ($datas['org']=='3')
			PT Hexpharm Jaya Laboratories	
			@endif
			 tidak memungut biaya apapun.<br><br>
			Best Regards<br>
			Talent Acquisition Team<br>
			@if ($datas['org']=='1')
			PT Kalbe Farma Tbk<br>
			@elseif($datas['org']=='2')
			PT Finusolprima Farma Internasional<br>
			@elseif ($datas['org']=='3')
			PT Hexpharm Jaya Laboratories<br>	
			@endif
		@elseif ($datas['bahasa']=='ENG')
			Hello {{ $datas['nama'] }}, <br>
			Greetings!<br><br>
		
			Thank you for your interest to the {{ $datas['posisi'] }} role at Kalbe Farma. We`ve reviewed your application materials carefully, 
			and we`re excited to invite you to the interview for the role! Your interview will be conducted through zoom meeting and last roughly for {{ $datas['durasi'] }} 
			You’ll be speaking with {{ $datas['PIC'] }} for 
			@if ($datas['org']=='1')
			PT Kalbe Farma Tbk
			@elseif($datas['org']=='2')
			PT Finusolprima Farma Internasional
			@elseif ($datas['org']=='3')
			PT Hexpharm Jaya Laboratories
			@endif
			 here at our company.<br><br>
			Your interview has been scheduled for :<br><br>

			Date and Time &emsp;&emsp;:{{ $datas['dateTime'] }}<br>
			Link&emsp;&ensp;&ensp;&nbsp;&nbsp;:{{ $datas['link'] }}<br>
			Meeting ID&emsp;&emsp;&emsp;&emsp;&ensp;:{{ $datas['meetingID'] }}<br>
			Passcode&emsp;&emsp;&emsp;&emsp;&ensp;:{{ $datas['passcode'] }}<br>
			Breakout Room&emsp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&nbsp;:{{ $datas['breakoutroom'] }} <br><br>
			<p>
				II hope the interview schedule is suitable for you. We look forward to speaking with you. In case you have any questions, 
				please don't hesitate to contact us. You can find our contact details below.<br><br>
				Thank you in advance and stay healthy!<br><br>
				NOTE : Recruitment process in 
				@if ($datas['org']=='1')
				PT Kalbe Farma Tbk
				@elseif($datas['org']=='2')
				PT Finusolprima Farma Internasional
				@elseif ($datas['org']=='3')
				PT Hexpharm Jaya Laboratories	
				@endif
				 are free from any charge.<br><br>
			</p>
			Best Regards<br>
			Talent Acquisition Team<br>
			@if ($datas['org']=='1')
			PT Kalbe Farma Tbk<br>
			@elseif($datas['org']=='2')
			PT Finusolprima Farma Internasional<br>
			@elseif ($datas['org']=='3')
			PT Hexpharm Jaya Laboratories<br>	
			@endif
		@endif
		
	@elseif ($datas['jenisemail']==6)
		{{-- interview user gak ada email --}}
		@if ($datas['bahasa']=='IN')
		@elseif ($datas['bahasa']=='ENG')
		@endif
	@elseif ($datas['jenisemail']==9)
		{{-- ada 2 pilh ynag mana? --}}
		@if ($datas['bahasa']=='IN')
		@elseif ($datas['bahasa']=='ENG')
		@endif
	@endif
</body>
</html>