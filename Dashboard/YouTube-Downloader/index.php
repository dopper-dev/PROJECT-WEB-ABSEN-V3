<?php
// Konfigurasi koneksi database
$host = 'localhost'; // Isi dengan host database Anda
$user = 'root'; // Isi dengan username database Anda
$password = ''; // Isi dengan password database Anda
$dbname = 'db_absensi'; // Isi dengan nama database Anda

// Membuat koneksi ke database
$conn = mysqli_connect($host, $user, $password, $dbname);

// Memeriksa apakah koneksi berhasil
if (!$conn) {
    die('Koneksi database gagal: ' . mysqli_connect_error());
}

// Memeriksa apakah pengguna sudah memiliki session
session_start();
if (!isset($_SESSION['username'])) {
    // Jika pengguna belum memiliki session, redirect ke halaman login
    header("Location: /");
    exit();
}

// Memeriksa apakah pengguna masih aktif dalam database
$username = $_SESSION['username'];

$query = "SELECT * FROM users_db WHERE username = '$username'";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    // Jika pengguna tidak ditemukan di database, logout dan redirect ke halaman login
    session_destroy();
    header("Location: /");
    exit();
}

// Menutup koneksi database
mysqli_close($conn);
?>

<?php require './functions.php'; $error = "";?>
<!doctype html>
<html lang="ms-MY">
<head>
	<meta http-equiv="content-language" content="ms-MY" />
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
	<meta name="robots" content="index, follow"/>
	<meta name="bingbot" content="index, follow"/>
    <link rel="apple-touch-icon" sizes="180x180" href="/Assets/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/Favicon/icons8-synchronize-310.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/Favicon/icons8-synchronize-310.png">
    <link rel="manifest" href="/Assets/favicons/site.webmanifest">
    <link rel="mask-icon" href="/Favicon/icons8-synchronize-310.png" color="#5bbad5">
    <link rel="shortcut icon" href="/Favicon/icons8-synchronize-310.png">

    <title>YouTube Downloader</title>
    <link href="./site.css" rel="stylesheet">
</head>
<body>
<div class="yt-pijari-container">
    <div id="yt-pijari-header">
        <h1><a href="./"><span>YouTube</span>Downloader</a></h1>
    </div>
    <div class="yt-pijari-nav">
	    <ul>
			<li><a href="./">Home</a></li>
		    <li><a href="../">Kembali Kehalaman Awal</a></li>
		    <li><a href="#">Privacy Policy</a></li>
	    </ul>
    </div>
	
	<div style="clear:both"></div>
		
    <div id="yt-pijari-search-box">
        <h2>Unduh video dari YouTube secara gratis dan cepat, salin dan tempel tautan video.</h2>
        <form method="post" action="" id="yt-pijari-search-form">
            <input id="yt-pijari-search-text" name="video_link" type="text" placeholder="Tampal pautan YouTube..." <?php if(isset($_POST['video_link'])) echo "value='".$_POST['video_link']."'"; ?>/>
            <button id="yt-pijari-search-button" type="submit" name="submit">Download</button>
        </form>
    </div>

    <?php if($error) :?>
        <div style="color:red;font-weight: bold;text-align: center"><?php print $error?></div>
    <?php endif;?>

    <?php if(isset($_POST['submit'])): ?>
        
    <?php 
    $video_link = $_POST['video_link'];
    preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $video_link, $match);
    $video_id =  $match[1];
    $video = json_decode(getVideoInfo($video_id));
    $formats = $video->streamingData->formats;
    $adaptiveFormats = $video->streamingData->adaptiveFormats;
    $thumbnails = $video->videoDetails->thumbnail->thumbnails;
    $title = $video->videoDetails->title;
    $short_description = $video->videoDetails->shortDescription;
    $thumbnail = end($thumbnails)->url;
    ?>

    <div class="yt-pijari-content">
        <div class="yt-pijari-image">
            <img src="<?php echo $thumbnail; ?>" style="max-width:100%">
        </div>
        <div class="yt-pijari-text">
            <h2><?php echo $title; ?> </h2>
            <p><?php echo str_split($short_description, 100)[0]; ?></p>
        </div>
		
        <div style="clear:both"></div>
		
    </div>
            
    <?php if(!empty($formats)): ?>
            
    <?php if(@$formats[0]->url == ""): ?>
    <div class="yt-pijari-content">
        <div class="yt-pijari-text">
            <strong>Video yang Anda inginkan tidak dapat diproses, harap periksa apakah tautannya benar.</strong>
            <small><?php 
                    $signature = "https://yt.pijari.com?".$formats[0]->signatureCipher;
                    parse_str( parse_url( $signature, PHP_URL_QUERY ), $parse_signature );
                    $url = $parse_signature['url']."&sig=".$parse_signature['s'];
                    ?>
            </small>
        </div>
    </div>

	<?php 
    die();
    endif;
    ?>
                
    <div class="yt-pijari-result">
        <div class="yt-pijari-title">
            <h3>Lihat sebelum diunduh</h3>
        </div>
    <div class="yt-pijari-table">
        <table class="table ">
            <tr>
                <td class="caption">URL</td>
                <td class="caption">Format</td>
                <td class="caption">Kualitas</td>
                <td class="caption">Keterangan</td>
            </tr>
			
    <?php foreach($formats as $format): ?>
        <?php
            if(@$format->url == ""){
            $signature = "https://yt.pijari.com?".$format->signatureCipher;
            parse_str( parse_url( $signature, PHP_URL_QUERY ), $parse_signature );
            $url = $parse_signature['url']."&sig=".$parse_signature['s'];
            //var_dump($parse_signature);
            }else{
            $url = $format->url;
            }
    ?>
			
            <tr>
                <td><a href="<?php echo $url; ?>">Lihat</a></td>
                <td><?php if($format->mimeType) echo explode(";",explode("/",$format->mimeType)[1])[0]; else echo "Unknown";?></td>
                <td><?php if($format->qualityLabel) echo $format->qualityLabel; else echo "Unknown"; ?></td>
                <td><a class="yt-pijari-download" href="./downloader.php?link=<?php echo urlencode($url)?>&title=<?php echo urlencode($title)?>&type=<?php if($format->mimeType) echo explode(";",explode("/",$format->mimeType)[1])[0]; else echo "mp4";?>">Unduh</a> 
                </td>
            </tr>
			
    <?php endforeach; ?>
			
        </table>
    </div>
		
    <div style="clear:both"></div>
		

    </div>
                            
    <div class="yt-pijari-result sblh-kanan">
        <div class="yt-pijari-title">
            <h3>Unduh Video / Audio</h3>
        </div>
        <div class="yt-pijari-table">
            <table class="table ">
                <tr>
                    <td class="caption">Format</td>
                    <td class="caption">Kualitas</td>
                    <td class="caption">Keterangan</td>
                </tr>
    
    <?php foreach ($adaptiveFormats as $video) :?>
        <?php
            try{
                $url = $video->url;
            }catch(Exception $e){
            $signature = $video->signatureCipher;
            parse_str( parse_url( $signature, PHP_URL_QUERY ), $parse_signature );
            $url = $parse_signature['url'];
            }
        ?>

				<tr>
                    <td><?php if(@$video->mimeType) echo explode(";",explode("/",$video->mimeType)[1])[0]; else echo "Unknown";?></td>
                    <td><?php if(@$video->qualityLabel) echo $video->qualityLabel; else echo "Unknown"; ?></td>
                    <td><a class="yt-pijari-download" href="./downloader.php?link=<?php print urlencode($url)?>&title=<?php print urlencode($title)?>&type=<?php if($video->mimeType) echo explode(";",explode("/",$video->mimeType)[1])[0]; else echo "mp4";?>">Unduh</a> </td>
                </tr>
				
    <?php endforeach;?>
				
            </table>
        </div>
    </div>
	
    <?php endif; ?>
    <?php endif; ?>
	
	<div style="clear:both"></div>
	
	<div id="yt-pijari-how-to">
        <h2> </h2>
		
		<h2> </h2>
		
	</div>
	
	<div id="yt-pijari-footer">
		<p>&copy; 2023 YouTube Downloader</p>
	</div>
    </div>
</body>
</html>