<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Route[]|\Cake\Collection\CollectionInterface $routes
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Route'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Check Route'), ['action' => 'check']) ?></li>
    </ul>
</nav>
<div class="routes index large-9 medium-8 columns content">
    <h3><?= __('Routes') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('origin_route') ?></th>
                <th scope="col"><?= $this->Paginator->sort('destiny_route') ?></th>
                <th scope="col"><?= $this->Paginator->sort('altonomy_route') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($routes as $route): ?>
            <tr>
                <td><?= $this->Number->format($route->id) ?></td>
                <td><?= h($route->origin_route) ?></td>
                <td><?= h($route->destiny_route) ?></td>
                <td><?= $this->Number->format($route->altonomy_route) ?></td>
                <td><?= h($route->created) ?></td>
                <td><?= h($route->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $route->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $route->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $route->id], ['confirm' => __('Are you sure you want to delete # {0}?', $route->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
