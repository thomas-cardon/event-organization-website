<?php

final class EventController
{
    use ControllerHelpers;

    public function seeAction($params, $post, $session)
    {        
        $id = $params[0];
        $event = Event::getById($id);

        if (!$event) {
            $this->redirect('/', array('alert' => array('message' => 'L’événement n’existe pas.', 'type' => 'red')));
        }

        View::show('event', array(
            'authentified' => $this->isAuthentified(),
            'alert' => $session['alert'] ?? null,
            'user' => $session['user'] ?? null,
            'body' => View::get('event/see', array(
                'event' => $event,
                'user' => $session['user'] ?? null,
                'donations' => Transaction::findByEventId($id)
            ))
        ));

        $_SESSION['alert'] = null;
    }

    public function donateAction($params, $post, $session) {
        $id = $params[0];
        $event = Event::getById($id);
        if (!$event) {
            $this->redirect('/', array('alert' => array('message' => 'L’événement n’existe pas.', 'type' => 'red')));
        }

        if (!$this->isAuthentified()) {
            $this->redirect('/signin', array('alert' => array('message' => 'Vous devez être connecté pour pouvoir faire un don.', 'type' => 'red')));
        }

        $user = $session['user'];

        if ($user->getRole() !== 'admin' || $user->getRole() !== 'donor') {
            $this->redirect('/', array('alert' => array('message' => 'Vous n’avez pas les droits pour faire un don.', 'type' => 'red')));
        }

        if ($post) {
            $amount = $_POST['amount'];
            $comment = !isset($post['comment']) || $post['comment'] == '' ? null : $post['comment'];

            if (!$amount) {
                $this->redirect('/event/see/' . $id, array('alert' => array('message' => 'Vous devez indiquer un montant.', 'type' => 'red')));
            }

            if ($amount < 0) {
                $this->redirect('/event/see/' . $id, array('alert' => array('message' => 'Le montant doit être positif.', 'type' => 'red')));
            }

            if ($amount > $user->getPoints()) {
                $this->redirect('/event/see/' . $id, array('alert' => array('message' => 'Le montant ne peut pas être supérieur à votre portefeuille.', 'type' => 'red')));
            }

            $created = null;

            $transaction = new Transaction($user->getId(), $event->getId(), $amount, $comment);
            $transaction->save();

            $user->setPoints($user->getPoints() - $amount);
            $user->update();

            $this->redirect('/event/see/' . $id, array('alert' => array('message' => 'Votre don a bien été pris en compte.', 'type' => 'green')));
        }

        View::show('event', array(
            'authentified' => $this->isAuthentified(),
            'alert' => $session['alert'] ?? null,
            'user' => $session['user'] ?? null,
            'body' => View::get('event/donate', array(
                'event' => $event
            ))
        ));
    }

    public function winnersAction($params, $post, $session) {
        $campaigns = Campaign::findOverCampaigns($_GET['limit'] ?? null, $_GET['offset'] ?? null);
        $events = array();

        foreach ($campaigns as $campaign) {
            $events[$campaign->getId()] = array_filter(Event::findByCampaignId($campaign->getId()), function($event) use (&$events) {
                return Vote::hasVotes($event->getId()) || true;
            });
        }

        View::show('event', array(
            'authentified' => $this->isAuthentified(),
            'alert' => $session['alert'] ?? null,
            'user' => $session['user'] ?? null,
            'body' => View::get('event/winners', array(
                'campaigns' => $campaigns,
                'events' => $events
            ))
        ));

        $_SESSION['alert'] = null;
    }

    public function allAction($params, $post, $session)
    {
        $events = Event::find($_GET['limit'] ?? 25, $_GET['offset'] ?? 0);

        View::show('event', array(
            'authentified' => $this->isAuthentified(),
            'alert' => $session['alert'] ?? null,
            'user' => $session['user'] ?? null,
            'body' => View::get('event/all', array(
                'events' => $events
            ))
        ));

        $_SESSION['alert'] = null;
    }
}
?>