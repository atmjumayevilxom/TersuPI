( function( api ) {

	// Extends our custom "educenter" section.
	api.sectionConstructor['educenter'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );



// Extends our custom section.
(function (api) {
    
    api.sectionConstructor['educenter-upgrade-section'] = api.Section.extend({

        // No events for this type of section.
        attachEvents: function () {},

        // Always make the section active.
        isContextuallyActive: function () {
            return true;
        }
    });

})(wp.customize);
