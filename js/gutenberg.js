const noticeGutenberDescription = __('Desactive el editor Gutenberg para disfrutar de Cibeles AI','cibeles-ai');
const noticeGutenberAction = __('Haga click aquí','cibeles-ai');
( function( wp ) {
	wp.data.dispatch('core/notices').createNotice(
		'error', // Can be one of: success, info, warning, error.
		noticeGutenberDescription,
		{
			isDismissible: true, // Whether the user can dismiss the notice.
			// Any actions the user can perform.
			actions: [
				{
					url: 'https://wordpress.org/plugins/disable-gutenberg/',
					label: noticeGutenberAction
				}
			]
		}
	);
} )( window.wp );