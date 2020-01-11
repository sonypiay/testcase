<?php
require dirname( __DIR__ ) . '/autoload.php';

$fakultasClass = new Model\Fakultas;

$base_url = $base_url . '/fakultas';
$query = 'select id, title, description, publish, modify_date from T_Fakultas';

$is_publish = isset( $_REQUEST['is_publish'] ) ? $_REQUEST['is_publish'] : '';
$search			= isset( $_REQUEST['search'] ) ? $_REQUEST['search'] : '';

if( isset( $_REQUEST['filter'] ) )
{
	if( empty( $search ) && ! empty( $is_publish ) )
	{
		$query .= ' where publish = "' . $is_publish . '"';
	}
	else if( ! empty( $search ) && empty( $is_publish ) )
	{
		$query .= ' where title like "%' . $search . '%" or description like "%' . $search . '%"';
	}
	else if( ! empty( $search ) && ! empty( $is_publish ) )
	{
		$query .= ' where st.publish and ( st.name like "%' . $search . '%" or st.nim like "%' . $search . '%" )';
	}
}

$getData = $fakultasClass->getAllData( $query );
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
<!-- nav -->
<?php require dirname( __DIR__ ) . '/menu.php'; ?>
<!-- nav -->
<div class="uk-container uk-align-center uk-margin-large-top">
	<h2>Data Fakultas</h2>
	<div class="uk-margin">
		<form method="post">
			<div class="uk-grid-small" uk-grid>
				<div class="uk-width-expand">
					<div class="uk-grid-small uk-child-width-auto" uk-grid>
						<div>
							<select class="uk-select" name="is_publish">
								<option value="">-- Publikasi --</option>
								<option value="all" <?php if( isset( $_REQUEST['is_publish'] ) && $_REQUEST['is_publish'] == 'all' ) echo 'selected'; ?>>Tampilkan Semua</option>
								<option value="Publish" <?php if( isset( $_REQUEST['is_publish'] ) && $_REQUEST['is_publish'] == 'Publish' ) echo 'selected'; ?>>Publish</option>
								<option value="Not Publish" <?php if( isset( $_REQUEST['is_publish'] ) && $_REQUEST['is_publish'] == 'Not Publish' ) echo 'selected'; ?>>Not Publish</option>
							</select>
						</div>
						<div>
							<input class="uk-input" type="search" name="search" placeholder="Cari fakultas" value="<?php echo $search; ?>">
						</div>
						<div>
							<input class="uk-button uk-button-primary" type="submit" name="filter" value="Filter">
						</div>
					</div>
				</div>
				<div class="uk-width-auto">
					<a class="uk-button uk-button-primary" href="<?php echo $base_url; ?>/insert.php">Tambah Fakultas</a>
				</div>
			</div>
		</form>
	</div>
	<div class="uk-margin">
		<?php
		if( count( $getData ) == 0 )
		{
			echo '<div class="uk-alert-warning" uk-alert>Tidak ada data yang ditampilkan</div>';
			return false;
		}
		if( isset( $_REQUEST['delete'] ) && $_REQUEST['delete'] == 'success' )
		{
			echo '<div class="uk-alert-success" uk-alert>Data berhasil dihapus</div>';
		}
		?>
		<table class="uk-table uk-table-divider uk-table-hover uk-table-small uk-table-middle uk-table-striped">
			<thead>
				<tr>
					<th>Aksi</th>
					<th>Nama</th>
					<th>Keterangan</th>
					<th>Publikasi</th>
					<th>Terakhir diubah</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach( $getData as $key => $value ): ?>
					<tr>
						<td>
							<a class="uk-button uk-button-small uk-button-default" href="<?php echo $base_url . '/edit.php?id=' . $value->id; ?>">Ubah</a>
							<a onclick="onDeleteFunction(<?php echo $value->id; ?>);" class="uk-button uk-button-small uk-button-default" href="#">Hapus</a>
						</td>
						<td><?php echo $value->title; ?></td>
						<td><?php echo $value->description; ?></td>
						<td>
							<?php
								$is_publish = $value->publish === 'Publish' ? 'Ya' : 'Tidak';
								echo $is_publish;
							?>
						</td>
						<td>
							<?php
							$dateTime = new DateTime( $value->modify_date );
							echo $dateTime->format('Y/m/d H:i');
							?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
<script type="text/javascript">
	function onDeleteFunction( id )
	{
		let confirmation = confirm('Apakah anda ingin menghapus fakultas ini?');
		if( confirmation ) document.location = '<?php echo $base_url ?>/controller/delete.php?id=' + id;
	}
</script>
</body>
</html>
