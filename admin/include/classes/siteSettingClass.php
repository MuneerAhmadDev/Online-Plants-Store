<?php

class SiteSetting
{
    private $tableName = "ops_sitesetting";

    // ================================ Getter Functions ================================

    public function getFacbook()
    {
        include_once 'database.php';

        $obj = new Database();

        $obj->select($this->tableName, "*", null, null, null, null);

        foreach ($obj->getResult() as $value)
            return $value['facebook'];
    }

    public function getWhatsapp()
    {
        include_once 'database.php';

        $obj = new Database();

        $obj->select($this->tableName, "*", null, null, null, null);

        foreach ($obj->getResult() as $value)
            return $value['whatsapp'];
    }

    public function getInstagram()
    {
        include_once 'database.php';

        $obj = new Database();

        $obj->select($this->tableName, "*", null, null, null, null);

        foreach ($obj->getResult() as $value)
            return $value['instagram'];
    }

    public function getTwitter()
    {
        include_once 'database.php';

        $obj = new Database();

        $obj->select($this->tableName, "*", null, null, null, null);

        foreach ($obj->getResult() as $value)
            return $value['twitter'];
    }

    public function getYouTube()
    {
        include_once 'database.php';

        $obj = new Database();

        $obj->select($this->tableName, "*", null, null, null, null);

        foreach ($obj->getResult() as $value)
            return $value['youtube'];
    }

    public function getAboutUs()
    {
        include_once 'database.php';

        $obj = new Database();

        $obj->select($this->tableName, "*", null, null, null, null);

        foreach ($obj->getResult() as $value)
            return $value['aboutus'];
    }

    public function getSiteLogo()
    {
        include_once 'database.php';

        $obj = new Database();

        $obj->select($this->tableName, "*", null, null, null, null);

        foreach ($obj->getResult() as $value)
            return $value['sitePic'];
    }

    public function getName()
    {
        include_once 'database.php';

        $obj = new Database();

        $obj->select($this->tableName, "*", null, null, null, null);

        foreach ($obj->getResult() as $value)
            return $value['siteName'];
    }

    public function getRecoveryEmail()
    {
        include_once 'database.php';

        $obj = new Database();

        $obj->select($this->tableName, "*", null, null, null, null);

        foreach ($obj->getResult() as $value)
            return $value['PassRecoveryEmail'];
    }

    public function getRecoveryEmailPass()
    {
        include_once 'database.php';

        $obj = new Database();

        $obj->select($this->tableName, "*", null, null, null, null);

        foreach ($obj->getResult() as $value)
            return $value['PassRecoveryEmailPass'];
    }

    // ================================ update Social Media Data Functions ================================

    public function updateSocialMediaLinks($fb, $whatsapp, $insta, $twitter, $yt)
    {
        include_once 'database.php';

        $obj = new Database();

        if ($obj->update($this->tableName, ['facebook' => $fb, 'whatsapp' => $whatsapp, 'instagram' => $insta, 'twitter' => $twitter, 'youtube' => $yt], "id = '1'"))
            return true;
        else
            return false;
    }

    // ================================ update About us Data Functions ================================

    public function updateAboutUs($data)
    {
        include_once 'database.php';

        $obj = new Database();

        if ($obj->update($this->tableName, ["aboutus" => htmlentities($data)], "id = '1'"))
            return true;
        else
            return false;
    }

    // ================================ update Stie Logo and Name Data Functions ================================

    public function updateStieLogo($path, $name)
    {
        include_once 'database.php';

        $obj = new Database();

        if ($obj->update($this->tableName, ['sitePic' => $path, "siteName" => $name], "id = '1'"))
            return true;
        else
            return false;
    }

    // ================================ Password Recovery Email Functions ================================

    public function addRecoveryEmail($email, $pass)
    {
        include_once 'database.php';

        $db = new Database();

        if ($db->update($this->tableName, ["PassRecoveryEmail" => $email, "PassRecoveryEmailPass" => $pass], "id = '1'"))
            return true;
        else
            return false;
    }
}
