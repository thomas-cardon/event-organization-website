<?php

final class LandingPageController
{
    public function defaultAction($params, $post, $session)
    {
        User::ensureExists();
        
        View::show('landing', array(
            'authentified' => true,
            'alert' => $session['alert'] ?? null,
            'user' => $session['user'] ?? array( 'firstName' => 'Jane', 'lastName' => 'Doe' ) /* NULL normalement, défini pour des tests frontend */,
        ));

        $_SESSION['alert'] = null;
    }
}
?>