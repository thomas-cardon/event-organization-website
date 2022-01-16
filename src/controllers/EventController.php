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
                'donations' => Transaction::findByEventId($id)
            ))
        ));

        $_SESSION['alert'] = null;
    }



    public function winnersAction($params, $post, $session) {
        View::show('event', array(
            'authentified' => $this->isAuthentified(),
            'alert' => $session['alert'] ?? null,
            'user' => $session['user'] ?? null,
            'body' => View::get('event/winners', array(
                'events' => array()
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