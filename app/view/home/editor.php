<?php
require_once '../service/editorService.php';
$editorContent = $statusMsg = '';

// If the form is submitted
if(isset($_POST['submit'])){
    $editorService = new editorService();

    // Get editor content
    $editorContent = htmlspecialchars($_POST['editor']);

    // Check whether the editor content is empty
    if(!empty($editorContent)){
        // Insert editor content in the database
        $insert = $editorService->insertHome($editorContent);

        // If database insertion is successful
        if($insert){
            $statusMsg = "The editor content has been inserted successfully.";
        }else{
            $statusMsg = "Some problem occurred, please try again.";
        }
    }else{
        $statusMsg = 'Please add content in the editor.';
    }
}
