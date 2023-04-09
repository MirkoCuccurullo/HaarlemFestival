<?php

class festivalController
{
public function homepage(){
    if (isset($_SESSION['current_user']) && $_SESSION['current_user']->role == '3')
        require __DIR__ . '/../view/festival/admin_festival_homepage.php';
    else
        require"../view/festival/festival_homepage.php";
}

public function tokenPage(){
    require"../view/management/getTokenPage.php";

}

    public function generateToken()
    {
        require_once __DIR__ . '/../service/apiKeyService.php';
        $apiKeyService = new apiKeyService();
        $data = [
            'usedBy' => $_POST['usedBy'],
            'purpose' => $_POST['purpose'],
        ];
        $result = $apiKeyService->createApiKey($data);
        if ($result) {
            //session_start();
            $_SESSION['message'] = "Token generated successfully";
            $_SESSION['token'] = $result->key;
            header("Location: /generateToken");
        } else {
            echo "Something went wrong";
        }
    }
}