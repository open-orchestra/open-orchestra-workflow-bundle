<?php

namespace OpenOrchestra\MediaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration as Config;

/**
 * Class MediaController
 */
class MediaController extends Controller
{
    /**
     * Send a media stored via gaufrette
     *
     * @Config\Route("/{key}", name="open_orchestra_media_get")
     * @Config\Method({"GET"})
     *
     * @return Response
     */
    public function getAction($key)
    {
        $gaufretteManager = $this->get('open_orchestra_media.manager.gaufrette');
        $fileContent = $gaufretteManager->getFileContent($key);

        $finfo = finfo_open(FILEINFO_MIME);
        $mimetype = finfo_buffer($finfo, $fileContent);
        finfo_close($finfo);

        $response = new Response();
        $response->headers->set('Content-Type', $mimetype);
        $response->headers->set('Content-Length', strlen($fileContent));
        $response->setContent($fileContent);

        return $response;
    }
}
