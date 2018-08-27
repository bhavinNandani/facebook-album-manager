<?php
if (!session_id()) {
                session_start();
}
require_once __DIR__ . '/../vendor/autoload.php';
class easy_googledrive
{
                public $credentials, $token, $instance, $initialize;
                function __construct($credentials = array())
                {
                                return $this->credentials = $credentials;
                }
                function easy_Instance()
                {
                                $client = new Google_Client();
                                return $this->instance = $client;
                }
                function easy_initialize()
                {
                                $client = $this->easy_Instance();
                                $client->setClientId($this->credentials['ClientId']);
                                $client->setClientSecret($this->credentials['ClientSecret']);
                                $client->setAccessType($this->credentials['AccessType']); // offline access
                                $client->setIncludeGrantedScopes(true); // incremental auth
                                $client->addScope(Google_Service_Drive::DRIVE);
                                $client->setRedirectUri($this->credentials['RedirectUri']);
                                return $this->initialize = $client;
                }
                function isLoggedIn()
                {
                                if (isset($_SESSION['Google_Token']) && !empty($_SESSION['Google_Token'])) {
                                                return true;
                                } else {
                                                return false;
                                }
                }
                function easy_login()
                {
                                return $this->initialize->createAuthUrl();
                }
                function easy_token()
                {
                                if (isset($_GET['code'])) {
                                                $this->initialize->authenticate($_GET['code']);
                                                $_SESSION['Google_Token'] = $this->initialize->getAccessToken();
                                                header('Location: ' . filter_var($this->credentials['RedirectUri'], FILTER_SANITIZE_URL));
                                }
                                if (isset($_SESSION['Google_Token'])) {
                                                $this->initialize->setAccessToken($_SESSION['Google_Token']);
                                }
                }
                function easy_listFiles()
                {
                                $service   = new Google_Service_Drive($this->initialize);
                                // Print the names and IDs for up to 10 files.
                                $optParams = array(
                                                'fields' => 'nextPageToken, files(id, name)'
                                );
                                $results   = $service->files->listFiles($optParams);
                                if (count($results->getFiles()) == 0) {
                                                return "No files found.\n";
                                } else {
                                                return $results->getFiles();
                                }
                }
                function checkExistence($perameter)
                {
                                foreach ($this->easy_listFiles() as $name) {
                                                if ($name->getName() == $perameter) {
                                                                return $name->getId();
                                                }
                                }
                }
                function easy_createFolder($folder)
                {
                                if ($this->checkExistence($folder) == null) {
                                                if ($this->initialize->getAccessToken()) {
                                                                $index         = 1;
                                                                $driveService  = new Google_Service_Drive($this->initialize);
                                                                $create_folder = new Google_Service_Drive_DriveFile(array(
                                                                                'name' => $folder,
                                                                                'mimeType' => 'application/vnd.google-apps.folder'
                                                                ));
                                                                $folder_id     = $driveService->files->create($create_folder, array(
                                                                                'fields' => 'id'
                                                                ));
                                                                return $folder_id->id;
                                                }
                                } else {
                                                return $this->checkExistence($folder);
                                }
                }
                function easy_createChildFolder($parent, $child)
                {
                                if ($this->checkExistence($child) == null) {
                                                if ($this->initialize->getAccessToken()) {
                                                                $index         = 1;
                                                                $driveService  = new Google_Service_Drive($this->initialize);
                                                                $create_folder = new Google_Service_Drive_DriveFile(array(
                                                                                'parents' => array(
                                                                                                $parent
                                                                                ),
                                                                                'name' => $child,
                                                                                'mimeType' => 'application/vnd.google-apps.folder'
                                                                ));
                                                                $folder_id     = $driveService->files->create($create_folder, array(
                                                                                'fields' => 'id'
                                                                ));
                                                                return $folder_id->id;
                                                }
                                } else {
                                                return $this->checkExistence($child);
                                }
                }
                function easy_upload($folder, $files)
                {
                                if ($this->initialize->getAccessToken()) {
                                                $index        = 1;
                                                $driveService = new Google_Service_Drive($this->initialize);
                                                foreach ($files as $file) {
                                                                $fileMetadata = new Google_Service_Drive_DriveFile(array(
                                                                                'name' => $index,
                                                                                'parents' => array(
                                                                                                $folder
                                                                                )
                                                                ));
                                                                $content      = file_get_contents($file);
                                                                $file         = $driveService->files->create($fileMetadata, array(
                                                                                'data' => $content,
                                                                                'mimeType' => 'image/png',
                                                                                'uploadType' => 'multipart',
                                                                                'fields' => 'id'
                                                                ));
                                                                $index++;
                                                }
                                }
                }
}
