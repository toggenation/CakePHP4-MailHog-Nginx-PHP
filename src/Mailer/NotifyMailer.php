<?php

declare(strict_types=1);

namespace App\Mailer;

use Cake\Mailer\Mailer;
use Cake\ORM\Locator\LocatorAwareTrait;
use Cake\Queue\Mailer\QueueTrait;

/**
 * Notify mailer.
 */
class NotifyMailer extends Mailer
{
    use QueueTrait;
    use LocatorAwareTrait;
    /**
     * Mailer's name.
     *
     * @var string
     */
    public static $name = 'Notify';

    public function notify(string $email, string $name, array $vars): void
    {
        $userId = $vars['user_id'];

        $usersTable = $this->fetchTable('Users');

        $user = $usersTable->get($userId);

        $user->notified = true;

        $usersTable->save($user);

        $this
            ->setViewVars($vars)
            ->setEmailFormat('html')
            ->setTo($email)
            ->setSubject(sprintf('Welcome %s', $name));
    }
}
