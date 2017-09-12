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
use Swift_Message;

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
            $template = $this->getParameter('domstor.template.mailer.request.email_template');
            /* @var $templating \Symfony\Bundle\TwigBundle\TwigEngine */
            $templating = $this->get('templating');
            /* @var $message Swift_Message */
            $message = $mailer->createMessage();
            $message
            ->setSubject($this->getParameter('domstor.template.mailer.request.subject'))
            ->setFrom($from)
            ->setBody(
                $templating->render($template, [
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
