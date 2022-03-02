$(document).ready(function() {
	const options = $('#productType option');
	const values = $.map(options ,function(value) {
		const array = [value.value];
		return array;
	});

	const divids = $('#input-field').children("div");
	const ids = $.map(divids ,function(value){
		const isd = [value.id]; 
		return isd;
	  });
	const opt = [];
	  for (let index = 0; index < values.length; ++index) {
		opt[values[index]] = ids[index];
	}

	$('#productType').change( function() {
		for (const key in opt) {
			if ($(this).val() == key) {
				if (opt[key]) {
					$('#input-field').children().hide();
					$('#' + opt[key]).show();
				} else {
					$('#input-field').children().hide();
				}
			}
		}
	});
});