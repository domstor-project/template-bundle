<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Domstor\TemplateBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
/**
 * Description of MailerPass
 *
 * @author Dmitry Anikeev <anikeev.dmitry@outlook.com>
 */ 
class MailerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
       $name = $container->getParameter('domstor.template.mailer.request.service_name');
       
       $container->setAlias('domstor.template.mailer.request', $name);
    }
}
