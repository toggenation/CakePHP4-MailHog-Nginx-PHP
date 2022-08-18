<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="users form content">
            <?= $this->Form->create($notifyForm) ?>

            <fieldset>
                <legend><?= __('Send Emails') ?></legend>
                <?= $this->Form->control('subject'); ?>
                <?= $this->Form->control('body', ['type' => 'textarea', 'cols' => 24, 'rows' => 5]); ?>
                <?php

                $this->Form->setTemplates([

                    'multicheckboxTitle' => '<legend class="ok">{{text}}</legend>',
                    'inputContainer' => '<div class="input hijames {{type}}{{required}}">{{content}}</div>',
                    'inputContainerError' => '<div class="input {{type}}{{required}} error">{{content}}{{error}}</div>',
                ]);

                echo $this->Form->control('users', [
                    'multiple' => 'checkbox',
                    'required' => false
                ]);

                ?>
            </fieldset>
            <div class="paginator">
                <ul class="pagination">
                    <?= $this->Paginator->first('<< ' . __('first')) ?>
                    <?= $this->Paginator->prev('< ' . __('previous')) ?>
                    <?= $this->Paginator->numbers() ?>
                    <?= $this->Paginator->next(__('next') . ' >') ?>
                    <?= $this->Paginator->last(__('last') . ' >>') ?>
                </ul>
                <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
            </div>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>


        </div>
    </div>
</div>