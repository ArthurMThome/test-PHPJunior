<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Route[]|\Cake\Collection\CollectionInterface $routes
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Routes'), ['action' => 'index']) ?> </li>
    </ul>
</nav>
<div class="routes view large-9 medium-8 columns content">
    
    <h1>Check Route</h1>
    <?php
    echo $this->Form->create($route);
    echo $this->Form->control('origin_route');
    echo $this->Form->control('destiny_route');
    echo $this->Form->control('gasoline_price');
    echo $this->Form->button('Check');
    echo $this->Form->end();
    ?>

</div>
    
