<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link href="/css/historyManagement.css" rel="stylesheet">
    <title>CRUD</title>
</head>
<body>

<nav class="navbar navbar-dark bg-mynav">
    <div class="container-fluid">
        <a class="navbar-brand" href="/history">History</a>
    </div>
</nav>

<div class="container">
    <div class="d-flex bd-highlight mb-3">
        <div class="me-auto p-2 bd-highlight" id="header"><h2>History Management</div>
        <button type="button" style="background-color: #3D1A78">
            <a href="/historyManagement/add" style="color:white; text-decoration:none;">Add Content</a>
        </button>
        <button type="button" name="update" style="background-color: #3D1A78; margin-left: 10px; color: white" >
            Update Content
        </button>
    </div>

    <div class="table-container">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Title</th>
                <th scope="col">Image</th>
                <th scope="col">Content</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody id="mytable">
            <?php if(isset($locations)) foreach ($locations as $location) {?>
                <tr>
                    <form action="/historyManagement" method="POST">
                        <td name="id" contenteditable="false"><input type="hidden" name="id" value="<?= $location->id ?>"><?=$location->id?></td>
                        <td name="id" contenteditable="false"><input type="text" name="title" value="<?= $location->title ?>"></td>
                        <td name="id" contenteditable="false"><input type="text" name="image" value="<?= $location->image ?>"></td>
                        <td name="id" contenteditable="false"><input type="text" name="content" value="<?= $location->content ?>"></td>
                        <td>
                            <button name="update"><i class="fas fa-edit"> </button>
                        </td>
                        <td>
                            <form action="/historyManagement" method="POST">
                                <input type="hidden" name="id" value="<?php echo $location->id ?>">
                                <button type="submit" name="delete"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </form>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>

