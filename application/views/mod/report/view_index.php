<div class="row">
	<div class="col-4">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Report berdasarkan :</h3>
			</div>
			<div class="card-body">
				<form method="POST" action="<?= base_url('report/cetak_excel'); ?>">
					<div class="form-group">
						<select name="per" id="per" class="form-control">
							<option value="">Pilih berdasarkan</option>
							<option value="1">Bulan</option>
							<option value="2">Tahun</option>
						</select>
					</div>
					<div id="v-bln" class="form-group collapse">
						<select name="bulan" id="bulan" class="form-control">
							<option value="">Bulan</option>
							<option value="01">Januari</option>
							<option value="02">Februari</option>
							<option value="03">Maret</option>
							<option value="04">April</option>
							<option value="05">Mei</option>
							<option value="06">Juni</option>
							<option value="07">Juli</option>
							<option value="08">Agustus</option>
							<option value="09">September</option>
							<option value="10">Oktober</option>
							<option value="11">November</option>
							<option value="12">Desember</option>
						</select>
					</div>
					<div id="v-thn" class="form-group collapse">
						<select name="tahun" id="tahun" class="form-control">
							<option value="">Tahun</option>
							<?php for ($i=2020; $i <= date('Y'); $i++): ?>
							<option value="<?= $i ?>"><?= $i ?></option>
							<?php endfor; ?>
						</select>
					</div>
					<div class="form-group">
						<button type="submit" id="btn-cetak" class="btn btn-success" style="width:100%">Cetak</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>