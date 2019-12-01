# site
## dynamic php site without database

You can add contents adding `txt` or `html` files in the `pages` and `posts` folders.

The files will be parsed and a page or a blog post will be added.

You can use bbcode markup language in `txt` files (still in beta), for a list of the commands you can use have a look of the `posts/Test_txt.txt` file.
bbcode files support also the code syntax highlight.

The pages are automatically added to the main menu, you can create subfolders in the `pages` directory to create menus in the main menu.

You have to create a `config.ini` file in the root folder of your site with the general configurations, you can start copying the `config-example.ini` file.

The home page is created on the basis of the `config.ini` informations.

This site creates also a bibliography page from a `bib` file, you can set the input file name in the `config.ini` file.

You can also use latex equations (using MathJax), a formula is enclosed by `$$` and an inline formula by `$`.

This code will create a responsive site using bootstrap (3.3.7)[https://getbootstrap.com/docs/3.3/getting-started/], bootstrap is not distributed with this project. By default, this code loads bootstrap from my personal webpage at Roma1 INFN, you are using this code from the same server it should work out of the box. Otherwise you can either download bootstrap locally or using the cloud version. In both the cases you have to edit the `template/header.htm` file.