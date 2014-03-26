<?php

namespace Finalist\LennaertBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

use Finalist\LennaertBundle\Model\TweetFormModel;
use Llvdl\TweeterCoreBundle\Service\TweetService;
use Symfony\Component\Form\FormFactory;

/** @Route("/", service="lennaert.tweet.controller") */
class TweetController
{
    /** @var EngineInterface */
    private $templating;
    /** @var TweetService */
    private $tweetService;
    
    /** @var FormFactory */
    private $formFactory;
    
    public function __construct(EngineInterface $templating, FormFactory $formFactory, TweetService $tweetService) {
        $this->templating = $templating;
        $this->formFactory = $formFactory;
        $this->tweetService = $tweetService;
    }
    
    /**
     * @Route("/", name="_tweets_home")
     * @Template()
     */
    public function homeAction()
    {
        $recentTweets = $this->tweetService->getRecentTweets();
        return ['recentTweets'=>$recentTweets];
    }

    /**
     * @Route("/tweets/{name}", name="_tweets_for_name", requirements={"name" = ".+"})
     * @Template()
     * @
     */
    public function tweetListAction($name)
    {
        $tweets = $this->tweetService->getRecentTweetsForTweeter($name);
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
            $this->tweetService->createTweet($model->getTweeterName(), $model->getText());
            return $this->redirect($this->generateUrl('_tweets_for_name', ['name'=>$model->getTweeterName()]));
        }
        
        return ['form'=>$form->createView()];
    }

    public function createFormBuilder($data = null, array $options = array())
    {
        return $this->formFactory->createBuilder('form', $data, $options);
    }

}
