Some notes taken during the conception of this demo. 

# Contrib modules & themes

## Bootstrap ecosystem

[pdureau/ui\_bootstrap](https://github.com/pdureau/ui_bootstrap) theme:

- A Drupal 8 Bootstrap4 theme using UI Patterns, UI Styles & Layout Options.
- Also considered: [nuvoleweb/bootstrap\_patterns](https://github.com/nuvoleweb/bootstrap_patterns) which is targeting Bootstrap3
- Also considered as base theme: [drupal/bootstrap](https://www.drupal.org/project/bootstrap) which is targeting Bootstrap3
- Also considered as base theme: [drupal/radix](https://www.drupal.org/project/radix) which is heavy
- Also considered as base theme: [drupal/bootstrap\_barrio](https://www.drupal.org/project/bootstrap_barrio) which is heavy too

Modules once considered, then discarded:

- [drupal/bootstrap\_library](https://www.drupal.org/project/bootstrap_library) module. The interesting part of the module can be implemented in a few lines. And stuck on Bootstrap 4.1 since April 2018.

## UI Patterns ecosystem

[drupal/ui\_patterns](https://www.drupal.org/project/ui_patterns) modules:

- Define and expose self-contained UI patterns as Drupal plugins, to ease site building.
- Also considered: [drupal/components](https://www.drupal.org/project/components) which is not exposing components as render elements and plugins
- Also considered: [drupal/sfc](https://www.drupal.org/project/sfc) which is not front-developer friendly (PHP instead of Twig).

[drupal/ui\_patterns\_layout\_builder](https://www.drupal.org/project/ui_patterns_layout_builder) module:

- Because Layout Builder does not recognize UI Pattern fields as regions, this module makes a pattern compatible with Layout Builder.
- It is necessary while editing a layout. Rendering a layout is OK without.

[pdureau/ui\_patterns\_field\_formatters](https://github.com/pdureau/ui_patterns_field_formatters) module:

- Use patterns as field formatter templates.  Only for simple use cases.

[pdureau/ui\_patterns\_entity\_links](https://github.com/pdureau/ui_patterns_entity_links) module:

- Expose entity links as Layout Builder blocks and display them with UI Patterns components.

[pdureau/ui\_patterns\_views\_style](https://github.com/pdureau/ui_patterns_views_style) module:

- ...

[drupal/ui\_patterns\_settings](https://www.drupal.org/project/ui_patterns_settings) module:

- Define settings inside your ui_patterns.yml to make your pattern configurable.
- Because some pattern fields are not supposed to be rendered. Caution! To use only with controled values like select, checkbox or boolean, not with free values like text or integer.

## Layout builder ecosystem

[pdureau/ui\_styles](https://github.com/pdureau/ui_styles) module:

- Allow site builders to select from a list of styles to apply to layout builder blocks and sections.
- Also considered: [drupal/layout\_builder\_styles](https://www.drupal.org/project/layout_builder_styles) but many issues and config-entities-based, so too site builder centric.

[drupal/field\_formatter\_range](https://www.drupal.org/project/field_formatter_range) module:

- Provides the option to display only selected range of values for multivalued entity fields.
- This unsupported module is a perfect match with Layout Builder because of the new ability to put many time the same field by display.
- [Need a patch](https://www.drupal.org/project/field_formatter_range/issues/3006712#comment-13427340). 
- Also considered: [drupal/field\_limiter](https://www.drupal.org/project/field_limiter)

[drupal/ctools](https://www.drupal.org/project/ctools) module:

- This module is a set of APIs and tools to improve the developer experience.
- We use the [entity\_view block](https://git.drupalcode.org/project/ctools/blob/8.x-3.x/src/Plugin/Block/EntityView.php) to include a view mode of the same entity inside the actual view mode to allow nested layouts.
- Also considered: drupal/layout_builder itself, which doesn't [allow layout builder sections to be nested](https://www.drupal.org/project/drupal/issues/3053145)
- Also considered: [drupal/field\_group](https://www.drupal.org/project/field_group) which doesn't work yet with Layout Bulder.
- Also considered: [drupal/mini\_layouts](https://www.drupal.org/project/mini_layouts) which is still in alpha and minimally maintained.

Modules once considered, then discarded:

- [drupal/layout\_builder\_restrictions](https://www.drupal.org/project/layout_builder_restrictions): Set which blocks and which layouts should be available for placement in Layout Builder. Would be useful to remove pattern which are not layouts. However, this module is too high-level and overkill, and we can use hook\_layout\_alter instead.
- [views\_layout](https://www.drupal.org/project/views_layout): Arrange Views results in a grid defined by a layout. Discarded because there is no looping when there are more results than regions. And because of [ViewsLayoutStyle options form doesn't display the layout configuration form.](https://www.drupal.org/project/views_layout/issues/3094017). Replaced by custom view/style plugins.


## Issues

We have met only one blocking issues when building the example pages:

- drupal:layout\_builder: [Consider supporting Layout Builder Overrides for other view modes](https://www.drupal.org/project/drupal/issues/2907413), updated 13 Feb 2020 (needed for Carousel example)


And some non-blocking ones:

- drupal:layout\_builder: [Allow layout builder sections to be nested](https://www.drupal.org/project/drupal/issues/3053145), updated 15 Jan 2020 (to avoid ctool's entity_view block and improve the site builder experience)
- ui\_patterns: [Allow grouping UI Patterns for better organization](https://github.com/nuvoleweb/ui_patterns/issues/258), updated 20 Nov 2019 (to make the distinction between nestable and 'atoms' patterns less magical)
- ui\_patterns:ui\_patterns\_layout: [Allow for Layout Builder sections to be given administrative labels](https://github.com/nuvoleweb/ui_patterns/issues/274), updated 15 Nov 2019
- drupal:views: [Views module is adding an extra div.views-element-container for no reason](https://www.drupal.org/project/drupal/issues/2721899), updated 30 Dec 2019 (it is disturbing a bit the grid)
- drupal: [Allow Plugins to specify Services via Annotation](https://www.drupal.org/project/drupal/issues/2914419), updated 17 Nov 2017 (not directly related to this project, but improve the DX a lot)
- drupal:layout\_builder: Layout Builder doesn't manage form modes
