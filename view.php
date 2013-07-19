<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo $config['title'] ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="<?php echo $config['prefix'] ?>css/<?php echo $config['theme'] ?>.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $config['prefix'] ?>css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="<?php echo $config['prefix'] ?>css/styles.css" rel="stylesheet">

    <style type="text/css">
        body {
            padding-top: 60px;
            padding-bottom: 40px;
        }

        .sidebar-nav {
            padding: 9px 0;
        }

        @media (max-width: 980px) {
            .navbar-text.pull-right {
                float: none;
                padding-left: 5px;
                padding-right: 5px;
            }
        }
    </style>

    <!--<link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="../assets/ico/favicon.png">-->

</head>

<body>

<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="brand" href="#"><?php echo $config['title'] ?></a>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="span3">
            <div class="well sidebar-nav">
                <ul class="nav nav-list">
                    <?php foreach ($tree as $dir): ?>
                        <?php if ($dir['is_dir']): ?>
                            <li class="nav-header"><?php echo $dir['name'] ?></li>
                        <?php else: ?>
                            <li<?php if ($dir['path'] == $uri) echo ' class="active"' ?>><a href="<?php printf('%s%s', $config['prefix'], $dir['path']) ?>"><?php echo $dir['name'] ?></a></li>
                        <?php endif ?>
                        <?php foreach ($dir['children'] as $filename): ?>
                            <li<?php if (sprintf('%s/%s', $dir['path'], $filename['path']) == $uri) echo ' class="active"' ?>><a href="<?php printf('%s%s/%s', $config['prefix'], $dir['path'], $filename['path']) ?>"><?php echo $filename['name'] ?></a></li>
                        <?php endforeach ?>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
        <div class="span9">
            <?php echo $content ?>
        </div>
    </div>

    <hr>

    <footer>
        <p>&copy; <a href="https://github.com/alkaruno">Alexey Karunos</a> 2013</p>
    </footer>

    <link rel="stylesheet" href="<?php echo $config['prefix'] ?>lib/highlight/src/styles/<?php echo $config['highlight'] ?>.css">
    <script src="<?php echo $config['prefix'] ?>lib/highlight/src/highlight.min.js"></script>
    <script> hljs.initHighlightingOnLoad(); </script>

</div>

</body>
</html>