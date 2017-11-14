<?php
/**
 * User: anikeevda
 * Date: 10.11.17
 * Time: 16:46
 */

namespace Domstor\TemplateBundle\Block\Service;

use Symfony\Bundle\AsseticBundle\Templating\AsseticHelper;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Block\Service\AbstractBlockService;
use Sonata\BlockBundle\Model\BlockInterface;
use Symfony\Component\HttpKernel\Config\FileLocator;

class SwitchLocationBlock extends AbstractBlockService
{
    protected $availableLocations;

    /**
     * @var FileLocator
     */
    protected $locator;

    public function __construct($name, EngineInterface $templating, array $availableLocations, FileLocator $locator)
    {
        parent::__construct($name, $templating);
        $this->availableLocations = $availableLocations;
        $this->locator = $locator;
    }

    public function configureSettings(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'template' => 'DomstorTemplateBundle:Block:switch_location.html.twig',
        ])
            ->setRequired('current_location')
        ;
    }

    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        $currentLocation = $blockContext->getSetting('current_location');
        $links = array();
        $links = $this->availableLocations;
        if (!array_key_exists($currentLocation, $links))
        {
            throw new \RuntimeException('Key ' . $currentLocation . ' not found in domstorlib links');
        }        
        $iterator = new \InfiniteIterator(new \ArrayIterator($links));
        while ($iterator->key()!=$currentLocation) {
            $iterator->next();
        }
        $iterator->next();
        $link['id'] = $iterator->key();
        $link['label'] = $iterator->current();

        return $this->renderResponse($blockContext->getTemplate(), [
            'link' => $link
        ]);
    }
}