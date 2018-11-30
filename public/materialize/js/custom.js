$(document).ready(function() {
	$('.editBut').on('click', function() {
		let day = $(this).parent().parent().find('td').eq(0).text();
		$.ajax({
			url: '/admin/get-day-time',
			type: 'GET',
			data: {
				day: day
			},
			success: function(res) {
				let start = res.startTime;
				let end = res.endTime;
				$('#start').val(start);
				$('#end').val(end);
				$('#day').val(day);

				$('#modal1').modal();
				$('#modal1').modal('open');
			},
			error: function(err) {
				console.log(err);
			}
		});
	});

	$('#submit').on('click', function() {
		let start = $(this).parent().parent().find('input#start').val();
		let end = $(this).parent().parent().find('input#end').val();
		let day = $(this).parent().parent().find('input#day').val();
		$.ajax({
			url: '/admin/edit-day-time',
			type: 'GET',
			data: {
				start: start,
				end: end,
				day: day,
			},
			success: function(res) {
				if (res.success) {
					M.toast({
						html: 'Updated Successfully!'
					});
					location.reload();
				}
			},
			error: function(err) {
				console.log(err);
			}
		});
	});
});