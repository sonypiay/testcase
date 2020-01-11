<?php

require dirname( __DIR__ ) . '/autoload.php';

$base_url = $base_url . '/student';

$fakultasClass  = new Model\Fakultas;
$studentClass   = new Model\Students;
$getFakultas    = $fakultasClass->getAllData('select * from T_Fakultas where publish = "Publish"');
$student        = $studentClass->show( $_REQUEST['id'] );
if( ! $student ) die('Data tidak ditemukan');

$nama_lengkap = isset( $_REQUEST['nama_lengkap'] ) ? $_REQUEST['nama_lengkap'] : $student->name;
$nim 					= isset( $_REQUEST['nim'] ) ? $_REQUEST['nim'] : $student->nim;
$gender 			= isset( $_REQUEST['gender'] ) ? $_REQUEST['gender'] : $student->gender;
$tempat_lahir = isset( $_REQUEST['tempat_lahir'] ) ? $_REQUEST['tempat_lahir'] : $student->birth_place;
$tanggal 			= isset( $_REQUEST['tanggal'] ) ? $_REQUEST['tanggal'] : (new DateTime($student->dob))->format('j');
$bulan 				= isset( $_REQUEST['bulan'] ) ? $_REQUEST['bulan'] : (new DateTime($student->dob))->format('m');
$tahun 				= isset( $_REQUEST['tahun'] ) ? $_REQUEST['tahun'] : (new DateTime($student->dob))->format('Y');
$publis 			= isset( $_REQUEST['publis'] ) ? $_REQUEST['publis'] : $student->publish;
$telepon			= isset( $_REQUEST['telepon'] ) ? $_REQUEST['telepon'] : $student->phone;
$fakultas			= isset( $_REQUEST['fakultas'] ) ? $_REQUEST['fakultas'] : $student->fakultas_id;

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<!-- UIkit CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.2.6/dist/css/uikit.min.css" />
	<!-- UIkit JS -->
	<script src="https://cdn.jsdelivr.net/npm/uikit@3.2.6/dist/js/uikit.min.js"></script>
	<title>Ubah Mahasiswa</title>
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
		<div class="uk-card-title">Ubah Mahasiswa - <?php echo $student->name; ?></div>
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
				<label for="gender">Jenis Kelamin</label>
				<div class="uk-form-controls">
					<select class="uk-select" name="gender">
						<option value="L" <?php if( $gender == 'L' ) echo 'selected'; ?>>Laki - Laki</option>
						<option value="P" <?php if( $gender == 'P' ) echo 'selected'; ?>>Perempuan</option>
					</select>
				</div>
			</div>
			<div class="uk-margin">
				<label for="telepon">No. Telepon</label>
				<div class="uk-form-controls">
					<input type="text" id="telepon" class="uk-input" name="telepon" value="<?php echo $telepon; ?>">
				</div>
			</div>
			<div class="uk-margin">
				<div class="uk-grid-small" uk-grid>
					<div class="uk-width-2-5">
						<label for="tempat_lahir">Tempat Lahir</label>
						<div class="uk-form-controls">
							<input class="uk-input" type="text" id="tempat_lahir" name="tempat_lahir" value="<?php echo $tempat_lahir; ?>">
						</div>
					</div>
					<div class="uk-width-expand">
						<div class="uk-grid-small uk-child-width-auto" uk-grid>
							<div class="uk-width-1-3">
								<label for="tanggal">Tanggal Lahir</label>
								<div class="uk-form-controls">
									<select class="uk-select" id="tanggal" name="tanggal">
										<option value="">Tanggal</option>
										<?php
										for( $i = 1; $i <= 31; $i++ )
										{
											if( $i == $tanggal )
											{
												echo '<option value="' . $i . '" selected>' . $i . '</option>';
											}
											else
											{
												echo '<option value="' . $i . '">' . $i . '</option>';
											}
										}
										?>
									</select>
								</div>
							</div>
							<div class="uk-width-1-3">
								<label for="bulan">Bulan</label>
								<div class="uk-form-controls">
									<select class="uk-select" id="bulan" name="bulan">
										<option value="">Bulan</option>
										<?php
										for( $i = 1; $i <= 12; $i++ )
										{
											if( $i == $bulan )
											{
												echo '<option value="' . $i . '" selected>' . $i . '</option>';
											}
											else
											{
												echo '<option value="' . $i . '">' . $i . '</option>';
											}
										}
										?>
									</select>
								</div>
							</div>
							<div class="uk-width-1-3">
								<label for="tahun">Tahun</label>
								<div class="uk-form-controls">
									<select class="uk-select" id="tahun" name="tahun">
										<option value="">Tahun</option>
										<?php
										for( $i = 1960; $i <= date('Y'); $i++ )
										{
											if( $i == $tahun )
											{
												echo '<option value="' . $i . '" selected>' . $i . '</option>';
											}
											else
											{
												echo '<option value="' . $i . '">' . $i . '</option>';
											}
										}
										?>
									</select>
								</div>
							</div>
						</div>
					</div>
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
