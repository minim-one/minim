# minim

minim offers a super simple PHP Blog Management System. The code is Open Source and you're free to modify, distribute and use it for private and commercial projects.

It's ideal for simple travel blogs or publishing news. It has an easy administration interface and an automatic generated RSS feed. Themes and other modifications are fully customisable.

Installation

    Upload all files to your webserver
    Edit the config file: config/config.php
    Modify header/footer: config/header.md and config/footer.md


Blog

    Use any file transfer program to upload your files
    Upload your post to the posts, static pages for navigation to the pages directory
    Your files can be Markdown or HTML
    Files will be listed in reversed order. Number them or use a date format like Y-m-d or Ymd
    Images and files can be uploaded to the uploads directory: linked with ./uploads/yourfile.xyz
    Automatic generated RSS feed linked to your blog: https://yourdomain.com/minim/?rss
    Add meta information to your post or page:
    [meta]
    date: YYYY-mm-dd H:i:s
    title: Your Title
    tags: set,as,many,tags,as,you,want
    description: Meta description
    robots: index,follow
    [/meta]


Update

    Always keep a backup of your complete system
    Download latest version of minim: https://minim.one/downloads/?latest
    Upload everything except the config (!) directory and replace the existing files
    Check CHANGELOG.md if the config/config.php changed (happens very rarely) and edit your own config/config.php


Development

    Addons can be placed in the addons directory and enabled in config/config.php
    Administration addon for file management: https://yourdomain.com/minim/?admin
    There is a search addon. You can add the search form for example to config/foot.php
    echo'<footer><form action="./?search" method="post"><input type="search" name="item" placeholder="'.translation('Search').'" required><input type="submit" name="search" value="'.translation('Search').'"></form></footer>';
    If you want to create your own theme, just place it in themes and change the name in config (don't modify the default theme… otherwise you have one more thing to backup if you update)
    You can style the different parts of your blog individually: <body class="*"> *page, post, site
    If you want to change the HTML head or add content after footer: put it in config/head.php and config/foot.php


Security

    Enable HTTPS in .htaccess: uncomment rewrite rules
    Sensitive directories are protected by .htaccess and system files by prohibited direct access
    Change the admin password if you enable the admin addon (!)
    If you find a bug please contact me
