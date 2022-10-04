<!DOCTYPE html>
<html>
	<style>
		/* body {text-align: center;} */
	</style>
<head>
	<title>Suart 1</title>
</head>
<body>
	@if ($datas['jenisemail']==1)
		Hi {{ $datas['nama'] }} <br><br>
		Greetings!<br>
		Thank you for applying for the role of {{ $datas['posisi'] }} at Kalbe Farma.</b><br>
		We really perceive your interest in our company, and appreciate the time and energy you put into applying to this job position.
		This email is to confirm your application details have been received.
		<br>
		We received a huge number of applications, so please be informed that it will take some time for us to review your application as well.
		You will be informed by email when we found a matching position for your stunning profile, interests, ang background.
		<br>
		In the meantime you can check more about us through our Social Media (@kalbekarir) and our Company Page (https://www.kalbe.co.id/).
		We also regularly post new opportunities on our job vacancy page here, so keep an eye to any position that could be an interest for you.
		
		<br>
		<br>
		Best Regards<br>
		Talent Acquisition Team<br>
		@if ($datas['org']=='1')
		PT Kalbe Farma Tbk<br>
		@elseif($datas['org']=='2')
		PT Finusolprima Farma Internasional<br>
		@elseif ($datas['org']=='3')
		PT Hexpharm Jaya Laboratories<br>	
		@endif
	@elseif ($datas['jenisemail']==2)
		Hello {{ $datas['nama'] }}, <br>
		Greetings!<br>
		Following your recruitment process in our company for the {{ $datas['posisi'] }} role at Kalbe Farma (Ethical), We would like to invite you for the Medical Check Up session ;<br>
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
			NOTE : Recruitment process in Kalbe Farma Ethical are free from any charge.
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
	@elseif ($datas['jenisemail']==3)
		Hello {{ $datas['nama'] }}, <br>
		Greetings!<br>
		Following your recruitment process in our company for the {{ $datas['posisi'] }} role at Kalbe Farma (Ethical), We would like to invite you for the Medical Check Up session ;<br>
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
			NOTE : Recruitment process in Kalbe Farma Ethical are free from any charge.
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
</body>
</html>