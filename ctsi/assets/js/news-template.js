(function(wp) {
    const { wp: { hooks, blocks, data } } = window;

    hooks.addFilter(
        'blocks.registerBlockType',
        'custom/block-filter',
        (settings, name) => {
            const currentTemplate = wp.data.select('core/editor').getCurrentPost().template;
            // console.log(name)
            if (currentTemplate === 'archive.php' && name !== 'acf/interior-banner') {
                settings.supports.inserter = false;
            }
            return settings;
        }
    );

    // Re-run the filter whenever the post template changes
    wp.data.subscribe(() => {
        const currentTemplate = wp.data.select('core/editor').getCurrentPost().template;
        // console.log(currentTemplate)
        // Reapply the filter to all blocks
        wp.blocks.getBlockTypes().forEach(block => {
            wp.hooks.applyFilters('blocks.registerBlockType', block);
        });
    });

})(window.wp);