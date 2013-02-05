<?php

namespace Benji07\MainBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Benji07\MainBundle\Entity\Link;

/**
 * Tumblr Synchro Command
 */
class TumblrCommand extends ContainerAwareCommand
{
    /**
     * Configure
     */
    protected function configure()
    {
        $this->setName('benji07:tumblr');
    }

    /**
     * Execute
     *
     * @param InputInterface  $input  input
     * @param OutputInterface $output output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getEntityManager();
        $repository = $em->getRepository('Benji07MainBundle:Link');

        $url = 'http://api.tumblr.com/v2/blog/benjaminleveque.tumblr.com/posts/link';

        $offset = 0;

        $params = array(
            'api_key' => 'XQKl2FpvWhMho4NwBCegKUlHYDIUhYZ8nTmSNbuJLE8xFCDZjh',
            'offset' => $offset,
            'limit' => 1
        );

        $data = json_decode(file_get_contents($url.'?'.http_build_query($params)));

        $nbPosts = $data->response->total_posts;

        $output->writeLn('Importing '.$nbPosts);

        for ($i = 0; $i <= $nbPosts; $i+=20) {

            $params = array(
                'api_key' => 'XQKl2FpvWhMho4NwBCegKUlHYDIUhYZ8nTmSNbuJLE8xFCDZjh',
                'offset' => $i,
                'limit' => 20
            );

            $data = json_decode(file_get_contents($url.'?'.http_build_query($params)));

            foreach ($data->response->posts as $p) {

                if ($repository->findOneBy(array('tumblrId' => $p->id))) {
                    continue;
                }

                $output->writeLn($p->title);

                $link = new Link();
                $link->setTitle($p->title);
                $link->setTumblrId($p->id);
                $link->setUrl($p->url);
                $link->setCreatedAt(new \DateTime($p->date));

                $em->persist($link);
            }

            $em->flush();
        }
    }
}
