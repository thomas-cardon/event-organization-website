<?php

final class LandingPageController
{
    use ControllerHelpers;

    public function defaultAction($params, $post, $session)
    {   
        View::show('landing', array(
            'authentified' => $this->isAuthentified(),
            'alert' => $session['alert'] ?? null,
            'user' => $session['user'] ?? null,
            'events' => Event::find(4),
            'current_campaign' => Campaign::getCurrentCampaign(),
        ));

        $_SESSION['alert'] = null;
    }
}
?>