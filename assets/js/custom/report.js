$(document).ready(function() {
	const baseurl = $('.baseurl').data('baseurl');
	$('#per').change(function () {
		if ($('#per').val() == 1) {
			$('#v-bln').removeClass('collapse');
			$('#v-thn').removeClass('collapse');
		}else{
			$('#v-thn').removeClass('collapse');
			$('#v-bln').addClass('collapse');
			$('#bulan').val("");
		}
	});
});