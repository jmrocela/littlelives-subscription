(function($, Backbone, _) {

	var demo = Backbone.View.extend({
		el: '#items',
		events: {
			"click .subscribe": 'subscribe'
		},

		subscribe: function(e) {
			var el = $(e.target);

			var checkout = $('#checkout');


			checkout.find('.price').text(el.data('price'));
			checkout.find('.description').text(el.data('type'));

			checkout.find('input[name=store_id]').val(el.data('id'));
			checkout.find('input[name=store_type]').val(el.data('type'));
			checkout.find('input[name=price]').val(el.data('price'));

			checkout.foundation('reveal', 'open', {
				closeOnBackgroundClick: true
			});
		}
	});

	var demoView = new demo();

})($, Backbone, _);