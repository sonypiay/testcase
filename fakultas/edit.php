<?php

require dirname( __DIR__ ) . '/autoload.php';

if( ! isset( $_REQUEST['id'] ) ) die('bad request');

$base_url = $base_url . '/fakultas';

$fakultasClass = new Model\Fakultas;
$fakultas = $fakultasClass->show( $_REQUEST['id'] );

if( ! $fakultas ) die('Data tidak ditemukan');

$nama_fakultas = isset( $_REQUEST['nama_fakultas'] ) ? $_REQUEST['nama_fakultas'] : $fakultas->title;
$keterangan = isset( $_REQUEST['keterangan'] ) ? $_REQUEST['keterangan'] : $fakultas->description;
$publis = isset( $_REQUEST['publis'] ) ? $_REQUEST['publis'] : $fakultas->publish;

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<!-- UIkit CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.2.6/dist/css/uikit.min.css" />
	<!-- UIkit JS -->
	<script src="https://cdn.jsdelivr.net/npm/uikit@3.2.6/dist/js/uikit.min.js"></script>
	<title>Ubah Fakultas</title>
</head>
<body>
<div class="uk-container uk-width-3-5 uk-align-center uk-margin-large-top">
	<?php
	if( isset( $_REQUEST['action'] ) )
	{
		require __DIR__ . '/controller/edit.php';

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
		<div class="uk-card-title">Ubah Fakultas - <?php echo $fakultas->title; ?></div>
		<form class="uk-form-stacked uk-margin" method="post">
			<div class="uk-margin">
				<label for="nama_fakultas">Nama Fakultas</label>
				<div class="uk-form-controls">
					<input type="text" id="nama_fakultas" class="uk-input" name="nama_fakultas" value="<?php echo $nama_fakultas; ?>">
				</div>
			</div>
			<div class="uk-margin">
				<label for="nama_fakultas">Keterangan</label>
				<div class="uk-form-controls">
					<textarea name="keterangan" class="uk-textarea uk-height-small"><?php echo $keterangan ?></textarea>
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
				<input class="uk-button uk-button-primary" type="submit" name="action" value="Simpan">
				<a class="uk-button uk-button-default" href="<?php echo $base_url . '/'; ?>">Kembali</a>
			</div>
		</form>
	</div>
</div>
</body>
</html>
