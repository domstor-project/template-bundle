<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Domstor\TemplateBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Domstor\TemplateBundle\Form\Type\EmailRequestType;

/**
 * Description of ApiController
 *
 * @author Dmitry Anikeev <anikeev.dmitry@outlook.com>
 */
class ApiController extends FOSRestController
{

    public function postEmailRequestAction(Request $request)
    {
        $form = $this->createForm(EmailRequestType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $data = $form->getData();
            /* @var $mailer \Swift_Mailer */
            $mailer = $this->get('domstor.template.mailer.request');
            $to = $this->getParameter('domstor.template.mailer.request.to');
            $from = $this->getParameter('domstor.template.mailer.request.from');
            /* @var $templating \Symfony\Bundle\TwigBundle\TwigEngine */
            $templating = $this->get('templating');
            $message = $mailer->createMessage();
            $message
            ->setSubject('Новая заявка')
            ->setFrom($from)
            ->setBody(
                $templating->render('DomstorTemplateBundle:Email:email_request.html.twig', [
                    'name'=>$data['name'],
                    'email'=>$data['email'],
                    'phone'=>$data['phone'],
                    'message'=>$data['message']
                        
                ]),
                'text/html'
            )
            ->setTo($to)
            ;
            $mailer->send($message);
            $view = $this->view(['result' => 'success'], 200);
            $view->setFormat('json');
            return $this->handleView($view);
        }
        else if ($form->isSubmitted() && !$form->isValid())
        {
            $view = $this->view($form->getErrors(), 400);
            return $this->handleView($view);
        }
        $view = $this->view($form, 200)->setTemplate('DomstorTemplateBundle::modal.html.twig')->setTemplateVar('form')->setFormat('html');
        return $this->handleView($view);
    }

}
