<?php namespace Comms\Hub\Endpoint;

use Pckg\Api\Endpoint;

class Share extends Endpoint
{

    /**
     * @var string
     */
    protected $path = 'shares';

    public function getAll()
    {
        return $this->getAndDataResponse(null, 'shares');
    }

    public function downloadAndExtract($to)
    {
        /**
         * This is a zip, we want to save it and extract it.
         * Check for a signature?
         */
        $endpoint = dotenv('HUB_ENDPOINT');
        try {
            $content = $this->getApi()->getApi('share/' . $this->uuid . '/download')->getContent();
        } catch (\Throwable $e) {
            error_log(exception($e));
            die("not ok");
            return null;
        }
        $zipFile = $to . '.zip';
        file_put_contents($to . '.zip', $content);

        $z = new \ZipArchive();
        if (!$z->open($zipFile)) {
            return false;
        }

        $tmpDir = $to . '-tmp';
        $oldDir = $to . '-old';
        //d('extracting to ' . $tmpDir);
        $z->extractTo($tmpDir);
        $z->close();
        unlink($zipFile);
        if (is_dir($oldDir)) {
            //d('removing old dir');
            //rmdir($oldDir);
            exec('rm -rf ' . escapeshellarg($oldDir));
        }
        if (is_dir($to)) {
            //d('renaming ' . $to . ' to ' . $oldDir);
            rename($to, $oldDir);
        }
        try {
            //d('renaming ' . $tmpDir . ' to ' . $to);
            rename($tmpDir . '/build', $to);
            rename($tmpDir . '/comms.json', $to . '/comms.json');
            //d('deleting ' . $tmpDir);
            //rmdir($tmpDir);
            exec('rm -rf ' . escapeshellarg($tmpDir));
            exec('rm -rf ' . escapeshellarg($oldDir));
        } catch (\Throwable $e) {
            d(exception($e));
            return false;
        }

        return true;
    }

    public function publishItemTemplate($data)
    {
        d($data);
    }

}
