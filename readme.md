migxElementsManager Extra for MODx Revolution
=======================================


**Author:** Bruno Perner b.perner@gmx.de [webcmsolutions.de](http://www.webcmsolutions.de)

Documentation will be available at [webcmsolutions.de]()

migxElementsManager is an Extra, based on MIGXdb export/import Elements, like Chunks, Snippets, Plugins, Templates and TVs.
It can be used to create transport-packages of MIGXdb-CMPs and all exported elements with one click.

## Installation
Install migxElementsManager by package-management.

## Loading all elements into migxElementsManager
Before starting to use migxElementsManager make sure all Elements are loaded into it.
Go into each Elements-Tab (snippets,chunks,plugins,templates,categories) and click 'Load Elements'
This should load all Elements into the grids.

## Exporting Elements to a components-directory as files
1. Go to the tab 'Categories'
2. Select a Category in the grid, which elements you want to export.
3. Make sure, you have defined a 'Package', where the elements should be exported to
4. Now you can export all Elements of that category or only a specific element-type by clicking one of the buttons

## Importing Elements from components-directories
Go to the Elements-Tab, of the element-type, which you want to import.
Click the button 'Read Elements from Component'
Put the package-name into the field 'Package' from where you want to import the elements
This does import all files, of all categories, which was exported to that components-directory.

## Creating Packages
1. Export all Elements, which you want to pack into your package, to your components-directory
2. If you want to pack also MIGX - configurations, export them also to package - Make sure the package is defined for all the MIGX-configs
3. Go to the tab 'Packages'
4. If you haven't created your package in the grid, click 'Add Package'
5. Fill in 'Package' - can be mixed upper/lower - case here, Version for example '0.5.0', Release - examples: beta1,rc1,pl
6. Add Menues, if you have any. For MIGXdb - CMPs you only need to fill Text, Parent Menue, params
Params can be like that: &configs=yourconfig1:yourpackage||yourconfig2:yourpackage - this way you don't need to import the MIGX - configurations at the other system 
7. Click 'Prepare Build' - This does collect and copy all files of your core and assets - directory to assets/mypackages/yourpackage/
8. Click 'Build' - This does create the transport-package. You will find it under core/packages