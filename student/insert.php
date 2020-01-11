<?php

require dirname( __DIR__ ) . '/autoload.php';

$base_url = $base_url . '/fakultas';

$nama_lengkap = isset( $_REQUEST['nama_lengkap'] ) ? $_REQUEST['nama_lengkap'] : '';
$nim 					= isset( $_REQUEST['nim'] ) ? $_REQUEST['nim'] : '';
$gender 			= isset( $_REQUEST['gender'] ) ? $_REQUEST['gender'] : '';
$tempat_lahir = isset( $_REQUEST['tempat_lahir'] ) ? $_REQUEST['tempat_lahir'] : '';
$tanggal 			= isset( $_REQUEST['tanggal'] ) ? $_REQUEST['tanggal'] : '';
$bulan 				= isset( $_REQUEST['bulan'] ) ? $_REQUEST['bulan'] : '';
$tahun 				= isset( $_REQUEST['tahun'] ) ? $_REQUEST['tahun'] : '';
$publis 			= isset( $_REQUEST['publis'] ) ? $_REQUEST['publis'] : '';
$telepon			= isset( $_REQUEST['telepon'] ) ? $_REQUEST['telepon'] : '';
$fakultas			= isset( $_REQUEST['fakultas'] ) ? $_REQUEST['fakultas'] : '';

$fakultasClass = new Model\Fakultas;
$getFakultas = $fakultasClass->getAllData(['is_publish' => 'Publish']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<!-- UIkit CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.2.6/dist/css/uikit.min.css" />
	<!-- UIkit JS -->
	<script src="https://cdn.jsdelivr.net/npm/uikit@3.2.6/dist/js/uikit.min.js"></script>
	<title>Tambah Mahasiswa Baru</title>
</head>
<body>
<div class="uk-container uk-width-3-5 uk-align-center uk-margin-large-top">
	<?php
	if( isset( $_REQUEST['action'] ) )
	{
		require __DIR__ . '/controller/insert.php';

		if( isset( $errors ) && count( $errors ) != 0 )
		{
			echo '<div class="uk-alert-danger" uk-alert>';
			echo '<ul class="uk-list">';
			foreach( $errors as $error ):
				echo '<li>' . $error . '</li>';
			endforeach;
			echo '</ul>';
			echo '</div>';
		}
	}
	?>
	<div class="uk-card uk-card-body uk-card-default">
		<div class="uk-card-title">Tambah Mahasiswa Baru</div>
		<form class="uk-form-stacked uk-margin" method="post">
			<div class="uk-margin">
				<label for="fakultas">Fakultas</label>
				<div class="uk-form-controls">
					<select class="uk-select" name="fakultas" id="fakultas">
						<option value="">-- Pilih Fakultas --</option>
						<?php
						foreach( $getFakultas as $value ):
							if( $fakultas == $value->id )
							{
								echo '<option value="' . $value->id . '" selected>' . $value->title . '</option>';
							}
							else
							{
								echo '<option value="' . $value->id . '">' . $value->title . '</option>';
							}
						endforeach;
						?>
					</select>
				</div>
			</div>
			<div class="uk-margin">
				<label for="nama_fakultas">Nama Lengkap</label>
				<div class="uk-form-controls">
					<input type="text" id="nama_lengkap" class="uk-input" name="nama_lengkap" value="<?php echo $nama_lengkap; ?>">
				</div>
			</div>
			<div class="uk-margin">
				<label for="nim">NIM</label>
				<div class="uk-form-controls">
					<input type="text" id="nim" class="uk-input" name="nim" value="<?php echo $nim; ?>">
				</div>
			</div>
			<div class="uk-margin">
				<label for="nama_fakultas">Jenis Kelamin</label>
				<div class="uk-form-controls">
					<select class="uk-select" name="gender">
						<option value="L" <?php if( $gender == 'L' ) echo 'selected'; ?>>Laki - Laki</option>
						<option value="P" <?php if( $gender == 'P' ) echo 'selected'; ?>>Perempuan</option>
					</select>
				</div>
			</div>
			<div class="uk-margin">
				<label for="nama_fakultas">Publis?</label>
				<div class="uk-form-controls">
					<select class="uk-select" name="publis">
						<option value="Publish" <?php if( $publis == 'Publish' ) echo 'selected'; ?>>Ya</option>
						<option value="Not Publish" <?php if( $publis == 'Not Publish' ) echo 'selected'; ?>>Tidak</option>
					</select>
				</div>
			</div>
			<div class="uk-margin">
				<input class="uk-button uk-button-primary" type="submit" name="action" value="Tambah">
				<a class="uk-button uk-button-default" href="<?php echo $base_url . '/'; ?>">Kembali</a>
			</div>
		</form>
	</div>
</div>
</body>
</html>
