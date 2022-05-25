( function( api ) {

	// Extends our custom "education-base" section.
	api.sectionConstructor['education-base'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );