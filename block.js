( function( blocks, blockEditor, element ) {
    var el = element.createElement;
    var RichText = blockEditor.RichText;
    var registerBlockType = blocks.registerBlockType;
    var updateCategories = blocks.updateCategories;

    // Ensure the custom category exists
    var customCategory = {
        slug: 'builderglut',
        title: 'Builderglut',
        icon: 'heart'
    };

    wp.domReady(function() {
        // Get the current categories
        var categories = blocks.getCategories();

        // Check if the custom category already exists
        if (!categories.some(category => category.slug === 'builderglut')) {
            // Add the custom category
            blocks.setCategories([...categories, customCategory]);
        }
    });

    // Register the block type
    registerBlockType( 'builderglut/heading', {
        title: 'Builderglut Heading',
        icon: 'heading',
        category: 'builderglut',

        attributes: {
            content: {
                type: 'string',
                source: 'html',
                selector: 'h2',
            },
        },

        edit: function( props ) {
            var content = props.attributes.content;

            function onChangeContent( newContent ) {
                props.setAttributes( { content: newContent } );
            }

            return el(
                RichText,
                {
                    tagName: 'h2',
                    className: props.className,
                    onChange: onChangeContent,
                    value: content,
                }
            );
        },

        save: function( props ) {
            return el( RichText.Content, {
                tagName: 'h2',
                value: props.attributes.content,
            } );
        },
    } );
}(
    window.wp.blocks,
    window.wp.blockEditor,
    window.wp.element
) );
