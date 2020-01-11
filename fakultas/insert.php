<?php

require dirname( __DIR__ ) . '/autoload.php';

$base_url = $base_url . '/fakultas';

$nama_fakultas = isset( $_REQUEST['nama_fakultas'] ) ? $_REQUEST['nama_fakultas'] : '';
$keterangan = isset( $_REQUEST['keterangan'] ) ? $_REQUEST['keterangan'] : '';
$publis = isset( $_REQUEST['publis'] ) ? $_REQUEST['publis'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<!-- UIkit CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.2.6/dist/css/uikit.min.css" />
	<!-- UIkit JS -->
	<script src="https://cdn.jsdelivr.net/npm/uikit@3.2.6/dist/js/uikit.min.js"></script>
	<title>Data Fakultas</title>
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
		<div class="uk-card-title">Tambah Fakultas Baru</div>
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
				<input class="uk-button uk-button-primary" type="submit" name="action" value="Tambah">
				<a class="uk-button uk-button-default" href="<?php echo $base_url . '/'; ?>">Kembali</a>
			</div>
		</form>
	</div>
</div>
</body>
</html>
