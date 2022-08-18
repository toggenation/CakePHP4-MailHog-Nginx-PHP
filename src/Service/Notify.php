<?php

namespace App\Service;

use App\Controller\UsersController;
use App\Form\NotifyForm;
use Cake\Mailer\MailerAwareTrait;
use App\Mailer\NotifyMailer;
use Cake\Utility\Hash;
use Cake\Utility\Text;
use Cake\Validation\Validator;
use Throwable;

class Notify
{
    use MailerAwareTrait;

    public function notify(UsersController $controller)
    {
        $this->controller = $controller;

        $request = $this->controller->getRequest();

        $notifyForm = new NotifyForm();

        $users = $this->controller->paginate(
            $this->controller->Users->find('list', ['keyField' => 'id', 'valueField' => 'first_name_last_name_email']),
            [
                'limit' => 5,
                $request->getQueryParams()
            ]
        );

        if ($request->is(['POST', 'PUT'])) {

            $data =  $request->getData();

            if ($notifyForm->validate($data)) {
                $result = $this->queueNotifications($data);
                $this->controller->Flash->{$result[0]}($result[1]);
            } else {
                $notifyForm->setErrors($notifyForm->getErrors());
                $this->controller->Flash->error(Text::toList(array_values(Hash::flatten($notifyForm->getErrors()))));
            }
        }

        $this->controller->set(compact('users', 'notifyForm'));
    }
    public function queueNotifications($data)
    {
        $usersToNotify = $this->controller->Users->find()->whereInList('id', $data['users']);

        unset($data['users']);

        $ctr = 2;

        $error = '';

        try {
            foreach ($usersToNotify as $user) {
                /**
                 * @var NotifyMailer $mailer
                 */
                $mailer = $this->getMailer('Notify');

                $mailer->push(
                    'notify',
                    [
                        $user->email,
                        $user->name,
                        $data + ['user_id' => $user->id]
                    ],
                    ['X-CakePHP-Queue-Job' => 'X-Spam-Score-1000']
                );
            }
        } catch (Throwable $th) {
            $error = $th->getMessage();
        }

        if ($error) {
            return ['error',  $error];
        } else {
            return ['success', "{$usersToNotify->count()} messages sent!"];
        }
    }
}
