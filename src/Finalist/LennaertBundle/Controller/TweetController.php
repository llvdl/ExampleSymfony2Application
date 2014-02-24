<?php

namespace Finalist\LennaertBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Finalist\LennaertBundle\Model\TweetFormModel;

class TweetController extends Controller
{
    /**
     * @Route("/", name="_tweets_home")
     * @Template()
     */
    public function homeAction()
    {
        $tweetService = $this->getTweetService();
        $recentTweets = $tweetService->getRecentTweets();
        return ['recentTweets'=>$recentTweets];
    }

    /**
     * @Route("/tweets/{name}", name="_tweets_for_name", requirements={"name" = ".+"})
     * @Template()
     * @
     */
    public function tweetListAction($name)
    {
        $tweetService = $this->getTweetService();
        $tweets = $tweetService->getRecentTweetsForTweeter($name);
        return ['name'=>$name, 'tweets'=>$tweets];
    }

    /**
     * @Route("/tweet", name="_tweet_create")
     * @Template()
     */
    public function tweetAddAction(\Symfony\Component\HttpFoundation\Request $request)
    {
        $model = new TweetFormModel();
        $form = $this->createFormBuilder($model)
                ->add('tweeterName', 'text')
                ->add('text', 'text')
                ->add('save', 'submit')
                ->getForm();
        
        $form->handleRequest($request);
        
        if($form->isValid()) {
            $this->getTweetService()->createTweet($model->getTweeterName(), $model->getText());
            return $this->redirect($this->generateUrl('_tweets_for_name', ['name'=>$model->getTweeterName()]));
        }
        
        return ['form'=>$form->createView()];
    }

    /** @return \Finalist\TweeterCoreBundle\Service\TweetService */
    private function getTweetService() {
        return $this->get('finalist_tweeter_core.tweet_service');
    }
    
}
