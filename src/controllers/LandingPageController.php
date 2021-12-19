<?php

final class LandingPageController
{
    public function defaultAction($params, $post, $session)
    {
        User::ensureExists();
        
        View::show('landing', array(
            'authentified' => true,
            'alert' => $session['alert'] ?? null
        ));

        $_SESSION['alert'] = null;
    }
}

?>