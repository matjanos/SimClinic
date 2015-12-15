<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'SimClinic';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <header>
        <div class="header-image">
            <?= $this->Html->image('http://icons.iconarchive.com/icons/graphicloads/medical-health/256/eye-icon.png',['height'=>'150px']) ?>
            <h1>SimClinic</h1>
        </div>
    </header>
    <nav class="top-bar expanded" data-topbar role="navigation">
        <ul class="title-area large-3 medium-4 columns">
            <li class="name">
                <h1><a href=""><?= $this->fetch('title') ?></a></h1>
            </li>
        </ul>
        <section class="top-bar-section">
        <span class="left" style="color:white; font-size:smaller; margin-left:10px;">
            Logged as: <?= $authUser!=null?($authUser['username'].' ('.$authUser['role'].')'):'guest' ?>
        </span>
            <ul class="right">
                <li><?= $this->Html->link('Home',['controller'=>'Pages', 'action'=>'home']) ?></li>
                <li><?= $this->Html->link('Examination',['controller'=>'Examinations','action'=>'index']) ?></li>
                <li><?= $this->Html->link('Analysis',['controller'=>'Analyzes', 'action'=>'index']) ?></li>
                <li><?= $this->Html->link('Users',['controller'=>'Users','action'=>'index']) ?></li>
                <li><?= $this->Html->link('Profile',['controller'=>'Users', 'action'=>'edit', $authUser!=null?$authUser['id']:'']) ?></li>
                <li><?= $authUser!=null?$this->Html->link('Logout',['controller'=>'Users','action'=>'logout']):$this->Html->link('Login',['controller'=>'Users','action'=>'login']) ?></li>
            </ul>
        </section>
    </nav>
    <?= $this->Flash->render() ?>
    <section class="container clearfix">
        <?= $this->fetch('content') ?>
    </section>
    <footer>
    </footer>
</body>
</html>
