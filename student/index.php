<?php
require dirname( __DIR__ ) . '/autoload.php';

$studentClass = new Model\Fakultas;

$base_url = $base_url . '/student';
$query = 'select st.id, st.name, st.nim, st.gender, st.phone, st.publish, st.modify_date, fk.title from T_Student st
inner join T_Fakultas fk on st.fakultas_id = fk.id';

$is_publish = isset( $_REQUEST['is_publish'] ) ? $_REQUEST['is_publish'] : '';
$search			= isset( $_REQUEST['search'] ) ? $_REQUEST['search'] : '';

if( isset( $_REQUEST['filter'] ) )
{
	if( empty( $search ) && ! empty( $is_publish ) )
	{
		$query .= ' where st.publish = "' . $is_publish . '"';
	}
	else if( ! empty( $search ) && empty( $is_publish ) )
	{
		$query .= ' where st.name like "%' . $search . '%" or st.nim like "%' . $search . '%"';
	}
	else if( ! empty( $search ) && ! empty( $is_publish ) )
	{
		$query .= ' where st.publish = "' . $is_publish . '" and ( st.name like "%' . $search . '%" or st.nim like "%' . $search . '%" )';
	}
}

$query .= ' order by st.create_date desc';
$getData = $studentClass->getAllData( $query );
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<!-- UIkit CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.2.6/dist/css/uikit.min.css" />
	<!-- UIkit JS -->
	<script src="https://cdn.jsdelivr.net/npm/uikit@3.2.6/dist/js/uikit.min.js"></script>
	<title>Data Mahasiswa</title>
</head>
<body>
	<!-- nav -->
	<?php require dirname( __DIR__ ) . '/menu.php'; ?>
	<!-- nav -->
<div class="uk-container uk-align-center uk-margin-large-top">
  <h2>Data Mahasiswa</h2>
	<div class="uk-margin">
		<form method="post">
			<div class="uk-grid-small" uk-grid>
				<div class="uk-width-expand">
					<div class="uk-grid-small uk-child-width-auto" uk-grid>
						<div>
							<select class="uk-select" name="is_publish">
								<option value="">-- Publikasi --</option>
								<option value="Publish" <?php if( $is_publish == 'Publish' ) echo 'selected'; ?>>Publish</option>
								<option value="Not Publish" <?php if( $is_publish == 'Not Publish' ) echo 'selected'; ?>>Not Publish</option>
							</select>
						</div>
						<div>
							<input class="uk-input" type="search" placeholder="Cari nama atau nim" name="search" value="<?php echo $search; ?>">
						</div>
						<div>
							<input class="uk-button uk-button-primary" type="submit" name="filter" value="Filter">
						</div>
					</div>
				</div>
				<div class="uk-width-auto">
					<a class="uk-button uk-button-primary" href="<?php echo $base_url; ?>/insert.php">Tambah Mahasiswa</a>
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
					<th>NIM</th>
          <th>Fakultas</th>
          <th>Jenis Kelamin</th>
          <th>Telepon</th>
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
						<td><?php echo $value->name; ?></td>
						<td><?php echo $value->nim; ?></td>
            <td><?php echo $value->title; ?></td>
            <td>
              <?php
                $gender = $value->gender === 'L' ? 'Laki - Laki' : 'Perempuan';
                echo $gender;
              ?>
            </td>
            <td><?php echo $value->phone; ?></td>
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
