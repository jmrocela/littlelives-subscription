(function($, Backbone, _) {

	var demo = Backbone.View.extend({
		el: '#items',
		events: {
			"click .subscribe": 'subscribe'
		},

		subscribe: function(e) {
			var el = $(e.target);

			$('#checkout').foundation('reveal', 'open', {
				closeOnBackgroundClick: true
			});
		}
	});

	var demoView = new demo();



})($, Backbone, _);