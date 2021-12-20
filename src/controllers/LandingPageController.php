<?php

final class LandingPageController
{
    use ControllerHelpers;

    public function defaultAction($params, $post, $session)
    {
        User::ensureExists();
        
        View::show('landing', array(
            'authentified' => $this->isAuthentified(),
            'alert' => $session['alert'] ?? null,
            'user' => $session['user'] ?? null
        ));

        $_SESSION['alert'] = null;
    }
}
?>