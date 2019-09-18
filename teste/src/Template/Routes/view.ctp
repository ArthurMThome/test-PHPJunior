<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Route $route
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Route'), ['action' => 'edit', $route->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Route'), ['action' => 'delete', $route->id], ['confirm' => __('Are you sure you want to delete # {0}?', $route->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Routes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Route'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="routes view large-9 medium-8 columns content">
    <h3><?= h($route->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Origin Route') ?></th>
            <td><?= h($route->origin_route) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Destiny Route') ?></th>
            <td><?= h($route->destiny_route) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($route->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Altonomy Route') ?></th>
            <td><?= $this->Number->format($route->altonomy_route) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($route->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($route->modified) ?></td>
        </tr>
    </table>
</div>
